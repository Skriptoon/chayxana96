<?php

namespace App\Http\Controllers;

use App\Contracts\Database;
use Illuminate\Http\Request;
use \App\Models\Baner;
use Illuminate\Support\Facades\DB;

class banerController extends Controller implements Database
{
    public function getModel() {
        $baner = Baner::select();
        
        return $baner;
    }
}
