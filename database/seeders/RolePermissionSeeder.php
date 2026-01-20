<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Role menggunakan RoleEnum
        $roleAdmin = Role::firstOrCreate(['name' => RoleEnum::ADMIN->value]);

        // 2. Buat Permission
        // Permission::create(['name' => 'lihat laporan']);
        // Permission::create(['name' => 'transaksi']);

        // 3. Assign Permission ke Role (Opsional)
        // $roleAdmin->givePermissionTo('lihat laporan');
        // $roleKasir->givePermissionTo('transaksi');

        // 4. Buat User Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('password123')
            ]
        );
        $admin->assignRole($roleAdmin);
    }
}
