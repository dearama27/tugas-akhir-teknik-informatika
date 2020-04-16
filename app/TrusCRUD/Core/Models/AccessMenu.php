<?php

namespace App\TrusCRUD\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessMenu extends Model
{

    function getMenu($parent_id) {
        try {
            $get = DB::table('access_menus AS menu')
            ->distinct()->select([
                "menu.id",
                "menu.title",
                "menu.url",
                "menu.icon",
                "menu.order",
            ])
            // ->groupBy('menu.id')
            // ->orderBy('menu.order', 'asc')
            ->where("menu.parent_id", "=", $parent_id)
            ->get();
    
            return $get->sortBy('order');
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }

    public function getRecursive($parent_id=0) {
        $html = "";
        $getMenu = $this->getMenu($parent_id);

        if($getMenu->count() == 0) {
            return false;
        }

        foreach($getMenu as $menu) {

            $check = $this->getRecursive($menu->id);
            if(!$check) {
                $html .= '
                <li class="dd-item" data-id="'.$menu->id.'">
                    <div class="dd-handle">
                        <a href="'.$menu->url.'" class="">
                        <i class="'. (isset($menu->icon) ? $menu->icon:'fa fa-chevron-circle-right') .'"></i> '.$menu->title.'
                        </a>
                    </div>
                </li>
                ';
            } else {
                $html .= '
                <li class="dd-item" data-id="'.$menu->id.'">
                    <div class="dd-handle">
                        <a href="#" class="">
                            <i class="'.$menu->icon.'"></i> '.$menu ->title.'
                        </a>
                    </div>
                    <ol class="dd-list">
                        '.$check.'
                    </ol>
                </li>
                ';
            }
        }

        return $html;
    }
}
