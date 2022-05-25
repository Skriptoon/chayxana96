<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\DatabaseContract;
use \App\Models\Menu__category;

class CategoryController extends Controller implements DatabaseContract
{
    public function getModel() {
        
        $category = Menu__category::select();

        

        return $category;
    }
}
