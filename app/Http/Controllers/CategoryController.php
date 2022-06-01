<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Menu__sort;

abstract class CategoryController extends Controller
{
    private $modelCategory = '\App\Models\Menu__category';
    
    protected function get() {
        $category = $this->modelCategory::select();
        
        return $category;
    }

    protected function getSort() {
        $sort = Menu__sort::where('type', 'category')->first();
        
        return $sort;
    }
}
