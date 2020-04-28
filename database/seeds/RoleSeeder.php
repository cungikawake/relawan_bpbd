<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'private', 'public', 'default'];
        for ($i=0; $i <= count($roles); $i++) {
            foreach ($roles as $role) {
                $role = new Role;
                $role->role_name = $roles[$i];
                $role->save();
                $i+=1;
            }
        }
    }
}
