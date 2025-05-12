<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sysconfig;

class SysConfigBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'TAS',
                'name'          => 'PANEL_TITLE'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'storage/logos/favicon.ico',
                'name'          => 'FAVEICON'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => '50px',
                'name'          => 'LOGO_HEIGHT'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'storage/logos/logo.png',
                'name'          => 'LOGO'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'Asia/Jakarta',
                'name'          => 'TIMEZONE'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5325.4814161270115!2d106.8746948!3d-6.1316489999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1fd65e315457%3A0xae919023d8db827a!2sPT.%20Tri%20Anugerah%20Surya!5e1!3m2!1sen!2sid!4v1739891713558!5m2!1sen!2sid',
                'name'          => 'MAP_LOCATION'
            ],
        ];

        Sysconfig::insert($data);
    }
}
