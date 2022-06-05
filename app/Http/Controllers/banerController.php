<?php

namespace App\Http\Controllers;

use App\Contracts\Database;
use \App\Models\Banner;

class BanerController extends Controller
{
    public function get() {
        return Banner::get();
    }
}
