<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        // Predefined status values
        $statuses = ['active', 'booked', 'booking', 'deactivate', 'pending'];

        // Insert statuses into the table
        foreach ($statuses as $status) {
            DB::table('status')->insert([
                'status_name' => $status,

            ]);
        }
    }
}
