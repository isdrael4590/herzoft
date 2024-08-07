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
            'create_user_management',
            'edit_user_management',
            'delete_user_management',

            //Reportes. 
            'access_reports',
            'create_reports',
            'edit_reports',
            'print_reports',
            'delete_reports',


            //roles
            'access_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            //Dashboard
            'show_total_stats',
            'show_test',
            'show_test_bd',
            'show_test_bd_overview',
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
            // units
            'access_informat_units',
            'create_units',
            'show_units',
            'edit_units',
            'delete_units',
            // lotes
            'access_informat_lotes',
            'create_lotes',
            'show_lotes',
            'edit_lotes',
            'delete_lotes',

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
            'access_preparationDetails',
            'create_preparationDetails',
            'show_preparationDetails',
            'edit_preparationDetails',
            'delete_preparationDetails',

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
            'create_labelqr_discharges',

            //ZONA ESTERIL LIMPIA
            'access_esteril_area',
            'access_discharges',
            'create_discharges',
            'show_discharges',
            'edit_discharges',
            'delete_discharges',
            'print_discharges',
            'access_release_cycle',
            // ZONA ALMACEN 
            'access_almacen_area',
            'access_expeditions',
            'create_expeditions',
            'show_expeditions',
            'print_expeditions',
            'edit_expeditions',
            'delete_expeditions',
            'access_stocks',
            'create_stocks',
            'show_stocks',
            'edit_stocks',
            'delete_stocks',
            'access_stockManual',
            'create_stockManual',
            'show_stockManual',
            'edit_stockManual',
            'delete_stockManual',

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
