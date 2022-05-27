<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Database;
use \App\Models\Menu__category;

class CategoryController extends Controller implements Database
{
    public function getModel() {
        
        $category = Menu__category::select();
        
        return $category;
    }
}
