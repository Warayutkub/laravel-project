<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class AuthUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authusers')->insert(array(
            ['username' => 'admin', 'email' => '' , 'level' => 1],
            ['username' => 'user1', 'email' => '' , 'level' => 2],
            ['username' => 'cust1', 'email' => '' , 'level' => 3],
        ));
    }
}
