<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Aksi dasar
        $actions = ['view', 'create', 'update', 'delete'];

        // 2. Tambah menu Role
        Menu::firstOrCreate(
            ['url' => '/admin/roles'],
            [
                'isactive' => 'Y',
                'created_by' => 1,
                'updated_by' => 1,
                'label' => 'Roles',
                'parent_id' => 7,
                'sort' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 3. Master menu
        $menus = Menu::with('parent')
            ->where('isactive', 'Y')
            ->where(function ($query) {
                $query->whereNotNull('parent_id')
                      ->orWhereDoesntHave('children');
            })
            ->orderBy('label')
            ->get();

        // 4. Buat semua permission
        foreach ($menus as $menu) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$menu}",
                    'guard_name' => 'web',
                ]);
            }
        }

        // 5. Buat role
        $superAdmin = Role::firstOrCreate(['name' => 'superadmin']);

        // 6. Assign semua permission ke admin
        $superAdmin->syncPermissions(Permission::all());

        // 7. Assign role ke user pertama & kedua (id = 1, 2)
        $user = User::whereIn('id', [1, 2])->get();
        if ($user) {
            $user->syncRoles([$superAdmin]);
        }
    }
}
