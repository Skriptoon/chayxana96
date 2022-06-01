<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CategoryController;

class CategoryMenuController extends CategoryController
{
    public function get($menu = null) {
        $category = parent::get()->where('menu', $menu)->get();
        
        $sort = $this->getSort();
        $sort = json_decode($sort->sort)[0];

        $categories = [];
        foreach($category as $item) {
            $categories[$item->id] = $item; 
        }

        $sortCategory = [];
        for($i = 0; $i < count($sort); $i++) {
            if(isset($categories[$sort[$i]])) {
                $sortCategory[] = $categories[$sort[$i]];
            } 
        }

        foreach($categories as $key => $val) {
            if(array_search($key, $sort) === false)
                $sortCategory[] = $val;
        }

        return $sortCategory;
    }
}
