<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Meilisearch\Client;

class SetupMeilisearchIndexes extends Command
{
    protected $signature   = 'meilisearch:setup';
    protected $description = 'Configura atributos filtrables y de búsqueda en Meilisearch para el índice receptions';

    public function handle(): int
    {
        $this->info('Configurando índice "receptions" en Meilisearch...');

        try {
            $client = app(Client::class);
            $index  = $client->index('receptions');

            // Atributos en los que se puede buscar texto
            $index->updateSearchableAttributes([
                'reference',
                'product_names',
                'product_codes',
                'delivery_staff',
                'operator',
                'area',
            ]);

            // Atributos en los que se puede filtrar (rangos, igualdad)
            $index->updateFilterableAttributes([
                'area',
                'status',
                'updated_at_timestamp',
                'updated_at_date',
            ]);

            // Atributos por los que se puede ordenar
            $index->updateSortableAttributes([
                'updated_at_timestamp',
            ]);

            $this->info('Índice configurado correctamente.');
            $this->newLine();
            $this->comment('Ahora indexa los datos existentes con:');
            $this->comment('  php artisan scout:import "Modules\Reception\Entities\Reception"');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Error conectando a Meilisearch: ' . $e->getMessage());
            $this->warn('Asegúrate de que Meilisearch esté corriendo y MEILISEARCH_HOST esté configurado en .env');

            return self::FAILURE;
        }
    }
}
