<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user) {
            // ADMIN
            if ($user->id === 1) {
                $newRole = new Role();
                $newRole->name = 'admin';
                $newRole->user_id = $user->id;
                $newRole->save();
            }
            // OTHER USER
            else {
                $newRole = new Role();
                $newRole->name = 'user';
                $newRole->user_id = $user->id;
                $newRole->save();
            }
        }
    }
}
