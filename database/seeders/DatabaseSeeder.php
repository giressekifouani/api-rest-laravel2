<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('users')->truncate();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'telephone'=>'76 986 38 9',
            'role'=>'client',
        ]);

        $this->call([
            ServicesSedder::class,
        ]);

        $this->call([
            PrestationsSedder::class,
        ]);
    }
}
