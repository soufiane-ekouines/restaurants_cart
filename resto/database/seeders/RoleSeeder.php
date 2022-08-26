<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
           [ 'designation' => 'Developer'],
           [ 'designation' => 'Admin'],
            ['designation' => 'Employer']
        ];
        foreach($data as $role)
        {
            Role::create($role);
        }
    }
}
