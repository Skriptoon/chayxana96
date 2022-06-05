<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function get($page) {
        return Page::where('page', $page)->first();
    }

    public function save(Request $request) {
        Page::updateOrInsert(['id' => $request->id],
        ['code' => $request->text]);
    }
}
