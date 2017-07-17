<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                [
                    'username'	    => 'morestudio',
                    'email'         => 'admin@morestudio.co.th',
                    'password'      => bcrypt('12345678'),
                    'role'          => 'Admin',
                    'created_at'    => new Datetime(),
                    'updated_at'    => new Datetime(),
                ],
                [
                    'username'	    => '1111111111111',
                    'email'         => '',
                    'password'      => bcrypt('12345678'),
                    'role'          => 'Student',
                    'created_at'    => new Datetime(),
                    'updated_at'    => new Datetime(),
                ]
            ]
        );
    }
}
