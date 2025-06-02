<?php

namespace Database\Seeders;

use App\Models\Reference;
use App\Models\ReferenceDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refMenu = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Icon Menu',
            'description'   => 'Icon Menu',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-cog',
                'name' => 'Cog',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-cube-transparent',
                'name' => 'Cube Transparent',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-clipboard-document-list',
                'name' => 'Clipboard List',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-archive-box',
                'name' => 'Archive Box',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-wrench-screwdriver',
                'name' => 'Wrench Screwdriver',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-newspaper',
                'name' => 'News Paper',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refMenu->id,
                'value' => 'heroicon-o-briefcase',
                'name' => 'Jobs',
            ],
        ]);

        $refSocialMedia = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Social Media',
            'description'   => 'Social Media',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refSocialMedia->id,
                'value' => 'facebook',
                'name' => 'Facebook',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refSocialMedia->id,
                'value' => 'twitter-x',
                'name' => 'Twitter X',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refSocialMedia->id,
                'value' => 'instagram',
                'name' => 'Instagram',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refSocialMedia->id,
                'value' => 'linkedin',
                'name' => 'Linkedin',
            ]
        ]);

        $refGallery = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Gallery Group',
            'description'   => 'Gallery Group',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refGallery->id,
                'value' => 'All',
                'name' => 'All',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refGallery->id,
                'value' => 'Gathering',
                'name' => 'Gathering',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refGallery->id,
                'value' => 'Syukuran',
                'name' => 'Syukuran',
            ]
        ]);

        $refCategories = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Category Level',
            'description'   => 'Category untuk produk',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refCategories->id,
                'value' => '1',
                'name' => 'Category 1',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refCategories->id,
                'value' => '2',
                'name' => 'Category 2',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refCategories->id,
                'value' => '3',
                'name' => 'Category 3',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refCategories->id,
                'value' => '4',
                'name' => 'Category 4',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refCategories->id,
                'value' => '5',
                'name' => 'Category 5',
            ],
        ]);

        $refJobNature = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Job Nature',
            'description'   => 'Sifat Pekerjaan',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobNature->id,
                'value' => 'Full Time',
                'name' => 'Full Time',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobNature->id,
                'value' => 'Part Time',
                'name' => 'Part Time',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobNature->id,
                'value' => 'Contract',
                'name' => 'Contract',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobNature->id,
                'value' => 'Internship',
                'name' => 'Internship',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobNature->id,
                'value' => 'Probation',
                'name' => 'Probation',
            ],
        ]);

        $refJobType = Reference::create([
            'created_by'    => 1,
            'updated_by'    => 1,
            'name'          => 'Job Type',
            'description'   => 'Tipe Pekerjaan',
        ]);

        ReferenceDetail::insert([
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Fresh Graduate',
                'name' => 'Fresh Graduate',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Experienced',
                'name' => 'Experienced',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Entry Level',
                'name' => 'Entry Level',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Mid Level',
                'name' => 'Mid Level',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Senior Level',
                'name' => 'Senior Level',
            ],
            [
                'created_by'    => 1,
                'updated_by'    => 1,
                'references_id' => $refJobType->id,
                'value' => 'Intern',
                'name' => 'Intern',
            ],
        ]);
    }
}
