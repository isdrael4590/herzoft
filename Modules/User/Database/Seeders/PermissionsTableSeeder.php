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
            'show_production',
            'show_types_rumed',
            'show_result_biologic',
            'show_production_areas',
            'show_notifications',
            //Products
            'access_products',
            'create_products',
            'show_products',
            'edit_products',
            'delete_products',
            'access_product_categories',
            'create_importproducts',
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
            'print_receptionsticket',
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
            'access_reprocess',
            'create_reprocess',
            'show_reprocess',
            'edit_reprocess',
            'delete_reprocess',

            //ZONA NO ESTERIL
            'access_zne_area',
            'access_testbds',
            'create_testbds',
            'show_testbds',
            'edit_testbds',
            'delete_testbds',
            'print_testbds',

            'access_testvacuums',
            'create_testvacuums',
            'show_testvacuums',
            'edit_testvacuums',
            'delete_testvacuums',
            'print_testvacuums',


            // generacion de etiquetas
            'access_labelqrs',
            'create_labelqrs',
            'create_labelqrshpo',
            'show_labelqrs',
            'edit_labelqrs',
            'delete_labelqrs',
            'print_labelqrs',
            'edit_labelqrDetails',
            'delete_labelqrDetails',
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

            // descarga detalles 
            'edit_dischargeDetails',
            'delete_dischargeDetails',

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

            // roles admin
            'access_admin',
            'create_admin',
            'show_admin',
            'edit_admin',
            'delete_admin',
            'print_admin',

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
