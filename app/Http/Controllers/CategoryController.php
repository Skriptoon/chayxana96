<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CategoryController extends Controller
{
    protected string $modelCategory = '\App\Models\Menu__category';
    protected string $modelSort = '\App\Models\Sort';

    protected function sort($categories, $menu = null) {
        $sort = $this->modelSort::where('type', 'category')->first();

        $sort = json_decode($sort->sort);

        $sortCategory = [];
        for($i = 0; $i < count($sort); $i++) {
            for($k = 0; $k < count($sort[$i]); $k++) {
                if(isset($categories[$sort[$i][$k]])) {
                    $sortCategory[$i][] = $categories[$sort[$i][$k]];
                }
            }
        }

        foreach($categories as $key => $val) {
            if(!in_array($key, $sort[$val->menu - 1]))
                $sortCategory[$val->menu - 1][] = $val;
        }

        if(isset($menu))
            return $sortCategory[$menu - 1];

        return $sortCategory;
    }
}
