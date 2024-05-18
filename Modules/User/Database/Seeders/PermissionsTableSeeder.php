<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //User Mangement
            'edit_own_profile',
            'access_user_management',
            //Dashboard
            'show_total_stats',
            'show_test',
            'show_test_bd',
            'show_test_vacuum',
            'show_production',
            'show_production_steam',
            'show_production_hpo',
            'show_result_biologic',
            'show_biologic_steam',
            'show_biologic_hpo',
            'show_notifications',
            //Products
            'access_products',
            'create_products',
            'show_products',
            'edit_products',
            'delete_products',
            'access_product_categories',
            //Barcode Printing
            'print_barcodes',
            'access_reports',
            //Settings
            'access_settings',
            //Units
            'access_informats_units',

            // insumos
            'access_informats',
            'create_informats',
            'show_informats',
            'edit_informats',
            'delete_informats',

            // Institucion
            'access_Informat_institutes',
            'create_institutes',
            'show_institutes',
            'edit_institutes',
            'delete_institutes',
            // Equipos
            'access_informat_machines',
            'create_machines',
            'show_machines',
            'edit_machines',
            'delete_machines',
            // areas
            'access_informat_areas',
            'create_areas',
            'show_areas',
            'edit_areas',
            'delete_areas',

            //Reception
            'access_dirty_area',
            'access_reception_area',
            'access_receptions',
            'create_receptions',
            'show_receptions',
            'delete_receptions',
            'print_receptions',
            'edit_receptions',
            'show_wash_area',
            'create_wash_area',
            'access_wash_area',
            'delete_wash_area',
            'edit_wash_area',
            'create_reception_preparations',
            
            // PREAPARACION
            'access_preparations',
            'create_preparations',
            'show_preparations',
            'edit_preparations',
            'delete_preparations',

            //ZONA NO ESTERIL
            'access_zne_area',
            'access_testbds',
            'create_testbds',
            'show_testbds',
            'edit_testbds',
            'delete_testbds',
            'print_testbds',

            // generacion de etiquetas
            'access_labelqrs',
            'create_labelqrs',
            'show_labelqrs',
            'edit_labelqrs',
            'delete_labelqrs',
            'print_labelqrs',

            //ZONA ESTERIL LIMPIA
            'access_ze_area',
            'access_discharges',
            'create_discharges',
            'show_discharges',
            'edit_discharges',
            'delete_discharges',
            'print_discharges',
            'access_release_cycle',
            // ZONA ALMACEN 
            'access_almacen_area',
            'create_expeditions',
            'show_expeditions',
            'edit_expeditions',
            'delete_expeditions',
            'create_stocks',
            'show_stocks',
            'edit_stocks',
            'delete_stocks',

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create([
            'name' => 'Admin'
        ]);

        $role->givePermissionTo($permissions);
        $role->revokePermissionTo('access_user_management');
    }
}
