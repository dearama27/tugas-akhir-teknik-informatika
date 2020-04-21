<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Super Admin',
            'phone'             => '085717453300',
            'access_role_id'    => 1,
            'email'             => 'admin@mail.com',
            'password'          => bcrypt('12345'),
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Dea Anggi Rahmawati',
            'phone'             => '085777777777',
            'access_role_id'    => 2,
            'email'             => 'admin.delivery@mail.com',
            'password'          => bcrypt('12345'),
        ]);

        //Driver
        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Achmad Fauzi',
            'phone'             => '087887878788',
            'access_role_id'    => 3,
            'email'             => 'driver1@mail.com',
            'password'          => bcrypt('12345'),
        ]);
        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Supriatno',
            'phone'             => '087887878788',
            'access_role_id'    => 3,
            'email'             => 'driver2@mail.com',
            'password'          => bcrypt('12345'),
        ]);
        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Darussalam',
            'phone'             => '087887878788',
            'access_role_id'    => 3,
            'email'             => 'driver3@mail.com',
            'password'          => bcrypt('12345'),
        ]);
        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Udin',
            'phone'             => '087887878788',
            'access_role_id'    => 3,
            'email'             => 'driver4@mail.com',
            'password'          => bcrypt('12345'),
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Euis Diana',
            'phone'             => '087887878788',
            'access_role_id'    => 4,
            'email'             => 'finance@mail.com',
            'password'          => bcrypt('12345'),
        ]);
        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Theresia',
            'phone'             => '08168877263',
            'access_role_id'    => 5,
            'email'             => 'manops@mail.com',
            'password'          => bcrypt('12345'),
        ]);

    }
}
