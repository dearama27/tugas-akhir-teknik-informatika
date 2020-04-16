<?php

use App\UserProvider;
use Illuminate\Database\Seeder;

class UserProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProvider::create([
            'user_id'     => 1,
            'provider'    => 'facebook',
            'provider_id' => '114809286735269'
        ]);
        
        UserProvider::create([
            'user_id'     => 1,
            'provider'    => 'google',
            'provider_id' => '114810074054245796598'
        ]);
    }
}
