<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Jasa Raharja Kanwil DKI Jakarta',
            'email' => 'admin@jrpaduka.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Unit Laka
        User::create([
            'name' => 'Unit Laka Lantas SAMSAT Jakarta Utara',
            'email' => 'unitlakajakut@jrpaduka.com',
            'password' => Hash::make('password'),
            'role' => 'unit laka',
        ]);

        // Surveyors
        $wilayah = ['Jakarta Pusat', 'Jakarta Utara', 'Jakarta Timur', 'Jakarta Barat', 'Jakarta Selatan'];
        foreach ($wilayah as $w) {
            User::create([
                'name' => 'Petugas Surveyor Wilayah ' . $w,
                'email' => 'surveyor' . str_replace(' ', '', strtolower($w)) . '@jr.com',
                'password' => Hash::make('password'),
                'role' => 'surveyor',
            ]);
        }
    }
}
