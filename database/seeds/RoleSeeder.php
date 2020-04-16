<?php

use App\TrusCRUD\Core\Models\AccessRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AccessRole::create([
            "name" => "Super Admin",
            "description" => "Top Level User",
            "uuid" => Str::uuid()
        ]);

        AccessRole::create([
            "name" => "Admin Delivery",
            "description" => "",
            "uuid" => Str::uuid()
        ]);

        AccessRole::create([
            "name" => "Driver",
            "description" => "",
            "uuid" => Str::uuid()
        ]);
        AccessRole::create([
            "name" => "Admin Finance",
            "description" => "",
            "uuid" => Str::uuid()
        ]);

        AccessRole::create([
            "name" => "Manager Operational",
            "description" => "",
            "uuid" => Str::uuid()
        ]);

    }
}
