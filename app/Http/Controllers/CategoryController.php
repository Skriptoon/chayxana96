<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Database;
use \App\Models\Menu__order;

class CategoryController extends Controller
{
    private $modelCategory = '\App\Models\Menu__category';
    
    protected function get() {
        $category = $this->modelCategory::select();
        
        return $category;
    }

    public function updateSort(Request $request) {
        $sort = Menu__sort::updateOrInsert(
            ['type' => 'category'],
            ['sort' => $request->sort]
        );
    }

    protected function getSort() {
        $sort = Menu__sort::where('type', 'category')->first();
        
        return $sort;
    }
}
