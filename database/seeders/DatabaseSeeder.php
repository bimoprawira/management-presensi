<?php

namespace Database\Seeders;

use App\Models\HrAdmin;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create HR Admin
        HrAdmin::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);

        // Create Sample Employee
        Karyawan::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'jabatan' => 'Staff IT',
            'tanggal_bergabung' => now()->subYear()
        ]);
    }
}