<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionMenuController extends PositionController
{
    public function get($menu = null) {
        $position = $this->modelPositions::select(DB::raw('`menu__positions`.*, `menu__categories`.`menu`'))
        ->join('menu__categories', 'menu__positions.id_category', '=', 'menu__categories.id');

        if(isset($menu)) {
            $position = $position->where('menu__categories.menu', $menu)->get();


            $positions = [];
            foreach($position as $item) {
                $positions[$item->id] = $item;
            }

            return $this->sort($positions, $menu);
        } else {;
            return $position->get();
        }
    }

    public function getIN($positions) {
        return $this->modelPositions::whereIn('menu__positions.id', $positions)->get();
    }
}
