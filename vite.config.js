import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import collectModuleAssetsPaths from './vite-module-loader.js';

const basePaths = [
    'resources/sass/app.scss',
    'resources/js/app.js',
    'resources/js/chart-config.js',
];

// Collect asset paths from all enabled modules before Vite starts
const allPaths = await collectModuleAssetsPaths(basePaths, 'Modules');

export default defineConfig({
    plugins: [
        laravel(allPaths),
    ],
});
