<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Define roles
        $roles = ['Admin', 'User'];

        // Insert roles into the table
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role_name' => $role,
                
            ]);
        }
    }
}
