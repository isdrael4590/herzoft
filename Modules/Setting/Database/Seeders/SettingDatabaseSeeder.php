<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name' => 'herZoft Gruop',
            'company_email' => 'isdrael4590@gmail.com',
            'company_phone' => '0998484190',
            'notification_email' => 'isdrael4590@gmail.com',
            'footer_text' => 'herZoft 2024 || Developed by <strong><a target="_blank" href=#">Fernando Jácome</a></strong>',
            'company_address' => 'Ecuador, Santiago de Pillaro'
        ]);
    }
}
