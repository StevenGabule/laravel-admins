<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Editor'],
            ['name' => 'Viewer']
        ]);
    }
}
