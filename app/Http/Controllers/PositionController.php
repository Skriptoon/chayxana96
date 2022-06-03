<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Database;
use \App\Models\Menu__position;
use \App\Models\Menu__sort;
use Illuminate\Support\Facades\DB;


abstract class PositionController extends Controller {

    public function get() {

        $positions = Menu__position::select();

        return $positions;
    }
    
    public function getSort() {
        $sort = Menu__sort::where('type', 'position')->first();
        
        return $sort;
    }
}
