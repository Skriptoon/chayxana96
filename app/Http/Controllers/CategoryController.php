<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\DatabaseContract;
use \App\Models\Menu__category;

class CategoryController extends Controller implements DatabaseContract
{
    public function get($where = null) {
        
        $category = Menu__category::select();
        if(!is_null($where)) {
            $category = $category->where('menu', $where);
        }

        

        return $category->get();
    }
}
