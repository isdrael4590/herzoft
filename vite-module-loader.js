import fs from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';

// __dirname is not available in ES modules — derive it from import.meta.url
const __dirname = path.dirname(fileURLToPath(import.meta.url));

async function collectModuleAssetsPaths(paths, modulesPath) {
    modulesPath = path.join(__dirname, modulesPath);

    const moduleStatusesPath = path.join(__dirname, 'modules_statuses.json');

    try {
        // Read modules_statuses.json
        const moduleStatusesContent = await fs.readFile(moduleStatusesPath, 'utf-8');
        const moduleStatuses = JSON.parse(moduleStatusesContent);

        // Read module directories
        const moduleDirectories = await fs.readdir(modulesPath);

        for (const moduleDir of moduleDirectories) {
            // Skip macOS metadata and hidden entries
            if (moduleDir.startsWith('.')) {
                continue;
            }

            // Only process modules that are enabled (status is true)
            if (moduleStatuses[moduleDir] !== true) {
                continue;
            }

            const viteConfigPath = path.join(modulesPath, moduleDir, 'vite.config.js');

            try {
                const stat = await fs.stat(viteConfigPath);

                if (stat.isFile()) {
                    // Import the module-specific Vite configuration
                    const moduleConfig = await import(viteConfigPath);

                    if (Array.isArray(moduleConfig.paths)) {
                        paths.push(...moduleConfig.paths);
                    }
                }
            } catch {
                // Module has no vite.config.js — skip silently
            }
        }
    } catch (error) {
        console.error(`Error reading module statuses or module configurations: ${error}`);
    }

    return paths;
}

export default collectModuleAssetsPaths;
