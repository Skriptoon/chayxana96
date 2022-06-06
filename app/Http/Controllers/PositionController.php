<?php

namespace App\Http\Controllers;

use \App\Models\Menu__position;
use \App\Models\Menu__sort;


abstract class PositionController extends Controller {

    protected string $modelPositions = '\App\Models\Menu__position';
    protected string $modelSort = '\App\Models\Sort';

    protected function sort($positions, $menu = null) {
        $sort = $this->modelSort::where('type', 'position')->first();

        $sort = json_decode($sort->sort);

        $sortPosition = [];
        for($i = 0; $i < count($sort); $i++) {
            for($k = 0; $k < count($sort[$i]); $k++) {
                if(isset($positions[$sort[$i][$k]])) {
                    $sortPosition[$i][] = $positions[$sort[$i][$k]];
                }
            }
        }

        foreach($positions as $key => $val) {
            if(array_search($key, $sort[$val->menu - 1]) === false)
                $sortPosition[$val->menu - 1][] = $val;
        }

        if(isset($menu))
            return $sortPosition[$menu - 1];
        return $sortPosition;
    }

}
