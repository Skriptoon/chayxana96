<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionMenuController extends PositionController
{
    public function get($menu = null) {
        $position = parent::get()->select(DB::raw('`menu__positions`.*, `menu__categories`.`menu`'))
        ->join('menu__categories', 'menu__positions.id_category', '=', 'menu__categories.id');

        if(isset($menu)) {
            $position = $position->where('menu__categories.menu', $menu)->get();
            $sort = $this->getSort();
            $sort = json_decode($sort->sort)[$menu - 1];

            $positions = [];
            foreach($position as $item) {
                $positions[$item->id] = $item;
            }
            
            $sortPosition = [];
            for($i = 0; $i < count($sort); $i++) {
                if(isset($positions[$sort[$i]])) {
                    $sortPosition[] = $positions[$sort[$i]];
                } 
            }

            foreach($positions as $key => $val) {
                if(array_search($key, $sort) === false)
                    $sortPosition[] = $val;
            }
        } else {;
            return $position;
        }

        return $sortPosition;
    }
}
