<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert(array(
            ['name' => 'admin'],
            ['name' => 'employee'],
            ['name' => 'customer']
        ));
    }
}
