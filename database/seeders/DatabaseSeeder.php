<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $superAdmin = Role::create(['name' => 'super admin']);
        Role::create(['name' => 'admin']);

        // $permissions = [
        //     'view',
        //     'create',
        // ];

        // foreach ($permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // $superAdmin->syncPermissions($permissions);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('sikorekmy.id'),
        ]);


        $user->assignRole($superAdmin);
        // $user->syncPermissions($permissions);
        // $this->call(SaldoAwalSeeder::class);
    }
}
