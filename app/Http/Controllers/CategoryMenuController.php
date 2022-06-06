<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CategoryController;

class CategoryMenuController extends CategoryController
{
    public function get($menu = null) {
        $category = $this->modelCategory::where('menu', $menu)->get();

        $categories = [];
        foreach($category as $item) {
            $categories[$item->id] = $item;
        }

        return $this->sort($categories, $menu);
    }
}
