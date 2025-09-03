<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestationsSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("prestations")->updateOrInsert([
            'user_id'=> '1',
            'service_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
