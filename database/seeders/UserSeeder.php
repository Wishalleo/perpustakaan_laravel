<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'l',
            'password' => bcrypt('1')
        ]);
        // $user->assignRole('Admin');

        // Pegawai
        $user = User::create([
            'name' => 'Firdaus Waridil Wishal',
            'email' => 'guard@gmail.com',
            'gender'=>'l',
            'password' => bcrypt('1')
        ]);
        // $user->assignRole('Pegawai');

        // Anggota
        $user = User::create([
            'code' => 'agt-1-rpl1-2005',
            'name' => 'Ahmad Farizky',
            'email' => 'student@gmail.com',
            'gender'=>'l',
            'password' => bcrypt('1')
        ]);
        $user = User::create([
            'code' => 'agt-2-rpl1-2005',
            'name' => 'Muhammad Arifin',
            'email' => 'student2@gmail.com',
            'gender'=>'l',
            'password' => bcrypt('1')
        ]);
        // $user->assignRole('Pegawai');
    }
}
