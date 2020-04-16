<?php

use App\TrusCRUD\Core\Models\AccessRoleToMenu;
use App\TrusCRUD\Core\Models\AccessAction;
use App\TrusCRUD\Core\Models\AccessMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionAction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessAction::create(["name" => "Show", "supfix"   => "show"]);
        AccessAction::create(["name" => "List", "supfix"   => "index"]);
        AccessAction::create(["name" => "Insert", "supfix" => "create"]);
        AccessAction::create(["name" => "Update", "supfix" => "update"]);
        AccessAction::create(["name" => "Delete", "supfix" => "delete"]);
        AccessAction::create(["name" => "Print", "supfix" => "print"]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Dashboard",
            "description"   => "",
            "route_name"    => "dashboard",
            "url"           => "/dashboard",
            "icon"          => "fas fa-home",
            "actions"       => '["show","index"]',
            "order"         => 1,
        ]);


        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Product",
            "description"   => "",
            "route_name"    => "product.index",
            "url"           => "/product",
            "icon"          => "fas fa-tags",
            "actions"       => '["show","index","create"]',
            "order"         => 2,
        ]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Customer",
            "description"   => "",
            "route_name"    => "customer.index",
            "url"           => "/customer",
            "icon"          => "fas fa-users",
            "actions"       => '["show","index","create"]',
            "order"         => 3,
        ]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Order",
            "description"   => "",
            "route_name"    => "order.index",
            "url"           => "/order",
            "icon"          => "fab fa-opencart",
            "actions"       => '["show","index","create"]',
            "order"         => 4,
        ]);

        AccessMenu::create([ //5
            "uuid"          => Str::uuid(),
            "title"         => "SPKB",
            "description"   => "",
            "route_name"    => "",
            "url"           => "#",
            "icon"          => "fab fa-buffer",
            "actions"       => '["show","index","create"]',
            "order"         => 5,
        ]);

        AccessMenu::create([ //6
            "uuid"          => Str::uuid(),
            "title"         => "Daftar SPKB",
            "parent_id"     => 5,
            "description"   => "",
            "route_name"    => "spkb.index",
            "url"           => "/spkb",
            "icon"          => "fab fa-buffer",
            "actions"       => '["show","index","create"]',
            "order"         => 6,
        ]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Pengiriman",
            "parent_id"     => 5,
            "description"   => "",
            "route_name"    => "delivery.index",
            "url"           => "/delivery",
            "icon"          => "fas fa-truck-moving",
            "actions"       => '["show","index","create"]',
            "order"         => 7,
        ]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Laporan Pengiriman",
            "description"   => "",
            "route_name"    => "report.index",
            "url"           => "/report",
            "icon"          => "fa fa-copy",
            "actions"       => '["show","index","create"]',
            "order"         => 8,
        ]);

        AccessMenu::create([ //1
            "uuid"          => Str::uuid(),
            "title"         => "Distribution Center",
            "description"   => "",
            "route_name"    => "distribution_center.index",
            "url"           => "/distribution_center",
            "icon"          => "fas fa-people-carry",
            "actions"       => '["show","index","create"]',
            "order"         => 2,
        ]);

        for($i = 1; $i <= 10; $i++) {
            AccessRoleToMenu::create([
                "access_action_suffix" => "show",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "index",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "create",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
        }

        //Admin Delivery
        AccessRoleToMenu::create([
            "access_action_suffix" => "index",
            "access_menu_id" => 5,
            "access_role_id" => 2,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "show",
            "access_menu_id" => 5,
            "access_role_id" => 2,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "index",
            "access_menu_id" => 6,
            "access_role_id" => 2,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "create",
            "access_menu_id" => 6,
            "access_role_id" => 2,
        ]);

        //Driver
        AccessRoleToMenu::create([
            "access_action_suffix" => "show",
            "access_menu_id" => 5,
            "access_role_id" => 3,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "index",
            "access_menu_id" => 7,
            "access_role_id" => 3,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "create",
            "access_menu_id" => 7,
            "access_role_id" => 3,
        ]);

        //Admin Finance
        AccessRoleToMenu::create([
            "access_action_suffix" => "index",
            "access_menu_id" => 8,
            "access_role_id" => 4,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "create",
            "access_menu_id" => 8,
            "access_role_id" => 4,
        ]);
        
        //Manager Operational
        AccessRoleToMenu::create([
            "access_action_suffix" => "index",
            "access_menu_id" => 8,
            "access_role_id" => 4,
        ]);
        AccessRoleToMenu::create([
            "access_action_suffix" => "create",
            "access_menu_id" => 8,
            "access_role_id" => 4,
        ]);
    }
}
