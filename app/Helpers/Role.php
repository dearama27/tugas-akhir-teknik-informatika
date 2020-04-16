<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * Class Role
 */
class Role {

    /**
     * For every "Route Name" that is passed, it doesn't need a Role to run it
     */
    protected static $bypass = [
        //Route Name
        "users.upload_avatar"
    ];

    public static function getAction($role_id, $menu_id, $action) {

        $get = DB::table('access_role_to_menus')
        ->where('access_role_id', '=', $role_id)
        ->where('access_menu_id', '=', $menu_id)
        ->where('access_action_suffix', '=', $action)->get();
        return $get->count();
    }

    public static function getMenu($role_id, $parent_id=0) {

        $get = DB::table('access_role_to_menus AS prm')->distinct()
        ->select([
            "menu.id",
            "menu.title",
            "menu.url",
            "menu.icon",
            "menu.route_name",
            "menu.order",
        ])
        ->join('access_menus AS menu', 'menu.id', "=", "prm.access_menu_id")
        // ->orderBy('menu.order', 'asc')
        ->where('prm.access_role_id', '=', $role_id)
        ->where("menu.parent_id", "=", $parent_id)
        // ->groupBy('menu.id')
        ->get();

        return $get->sortBy('order');
    }

    public static function getRecursive($role_id, $parent_id=0) {
        $html    = "";
        $getMenu = self::getMenu($role_id, $parent_id);

        if($getMenu->count() == 0) {
            return false;
        }

        foreach($getMenu as $menu) {

            $check = self::getRecursive($role_id, $menu->id);
            // $url  = route($menu->route_name);
            $url  = $menu->route_name != '' ? route($menu->route_name):'#';

            if(!$check) {
                $html .= '
                <li class="nav-item">
                    <a href="'.$url.'" class="nav-link">
                    <i class="nav-icon '. (isset($menu->icon) ? $menu->icon:'fa fa-chevron-circle-right') .'"></i>
                    <p>'.$menu->title.'</p>
                    </a>
                </li>
                ';
            } else {
                $html .= '
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon '.$menu->icon.'"></i>
                        <p>
                        '.$menu->title.'
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        '.$check.'
                    </ul>
                </li>
                ';
            }
        }

        return $html;
    }

    static function buildMenu($role) {

        $value = Cache::remember('menu-'.$role, 60*27*7, function () use($role) {
            $menu = Role::getRecursive($role, 0);
    
            return $menu;
        });

        return $value;
    }

    static function isAllow($action) {
        $role_id    = Auth::user()->access_role_id;
        $current    = Route::currentRouteName();

        if(in_array($current, self::$bypass)) {
            return true;
        }
        $base_route = explode(".", $current)[0];
        // dd([$current, $base_route, $action, $role_id]);

        $get = DB::table('access_role_to_menus AS prm')
        ->join('access_menus AS menu', 'menu.id', "=", "prm.access_menu_id")
        ->where('prm.access_role_id', $role_id)
        ->where('menu.route_name', 'LIKE', "$base_route%")
        ->where('prm.access_action_suffix', $action)
        ->get();

        $c = $get->count();

        if(Auth::user()->isSuper()) {
            return true;
        } else {
            return $c > 0 ? true:false;
        }
    }
}
