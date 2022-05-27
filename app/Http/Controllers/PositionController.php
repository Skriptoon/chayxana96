<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Database;
use \App\Models\Menu__position;
use Illuminate\Support\Facades\DB;


class PositionController extends Controller implements Database {


    /*public function save() {
        
    }*/

    public function getModel() {

        $positions = Menu__position::select(DB::raw('`menu__positions`.*, `menu__categories`.`menu`'))
        ->join('menu__categories', 'menu__positions.id_category', '=', 'menu__categories.id');

        return $positions;
    }
}
