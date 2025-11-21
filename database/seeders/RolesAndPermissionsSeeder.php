<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // <-- Import User

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Permission
        Permission::firstOrCreate(['name' => 'manage users']);

        // 2. Buat Role
        $role_admin = Role::firstOrCreate(['name' => 'admin']);
        $role_superadmin = Role::firstOrCreate(['name' => 'super admin']);

        // 3. Berikan Permission ke Role
        // Admin TIDAK dapat 'manage users'
        // Super Admin BISA 'manage users'
        $role_superadmin->givePermissionTo('manage users');

        // (Opsional) Berikan role ke user pertama (biasanya user ID 1)
        $user = User::first();
        if ($user) {
            $user->assignRole($role_superadmin);
        }
    }
}