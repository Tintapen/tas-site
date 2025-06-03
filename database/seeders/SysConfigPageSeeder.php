<?php

namespace Database\Seeders;

use App\Models\Sysconfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SysConfigPageSeeder extends Seeder
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
                'value'         => '5',
                'name'          => 'PAGE_CAREER',
                'description'   => 'Default paging size for Career'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => '12',
                'name'          => 'PAGE_PRODUCT',
                'description'   => 'Default paging size for Product'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => '6',
                'name'          => 'PAGE_NEWS',
                'description'   => 'Default paging size for News'
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'value'         => 'asc',
                'name'          => 'ORDER_MILESTONE',
                'description'   => 'Ascending sort by -> asc / Descending sort by -> desc'
            ],
        ];

        Sysconfig::insert($data);
    }
}
