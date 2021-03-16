<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('urls')->insertGetId(
            [
                'name' => 'https://ru.hexlet.io',
                'created_at' => Carbon::now()->toString(),
                'updated_at' => Carbon::now()->toString()
            ]
        );
    }
}
