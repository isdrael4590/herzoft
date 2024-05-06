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
            'show_rendimiento',
            'show_test',
            'show_notifications',
            //Products
            'access_products',
            'create_products',
            'show_products',
            'edit_products',
            'delete_products',
            //Product Categories
            'access_product_categories',
            //Barcode Printing
            'print_barcodes',
            'access_reports',
            //Settings
            'access_settings',
            //Units
            'access_units',

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

            //ZONA NO ESTERIL
            'access_zne_area',
            'access_testbds',
            'create_testbds',
            'show_testbds',
            'edit_testbds',
            'delete_testbds',
            'print_testbds',
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
            'access_almacen_area',

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
