<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function set(Request $request) {

        if(session()->has('positions')) {
            $positions = $this->get('positions');   
        }

        $positions[$request->id] = $request->amount;

        session()->put('positions', $positions);
    }

    public function get($key = null) {
        
        if(is_null($key)) {
            $session = session()->all();
        } else {
            $session = session($key);
        }
        return $session;
    }
}
