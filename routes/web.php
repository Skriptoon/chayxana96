<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PositionAmountController;
use App\Http\Controllers\CategoryController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    $position = new PositionController();
    return view('home', ['positions' => $position->getModel()->get()]);
})->name('home');

Route::get('/cart', function() {
    $position = new PositionController();
    $positions =array();
    $positions = [];
    foreach(session('positions') as $posId => $val) {
        if($val)
            $positions[] = $posId;
    }
    return view('cart', ['positions' => $position->getModel()->whereIn('menu__positions.id', $positions)->get()]);
})->name('cart');

Route::get('/delivery', function() {
    return view('delivery');
})->name('delivery');

Route::get('/contacts', function() {
    return view('contacts');
})->name('contacts');

Route::get('/delivery', function() {
    return view('delivery');
})->name('delivery');

Route::post('/ajax/session/{method}', function($method, Request $request) {
    $session = new PositionAmountController();
    $session->$method($request); 
});


/******* Должно быть в конце **********/
Route::get('/{menu}', function($menu) {
    $position = new PositionController();
    $category = new CategoryController();

    switch($menu) {
        case('chayhana'):
            $menuId = 1;
            break;
        case('panasia'):
            $menuId = 2;
            break;
        case('mangal'):
            $menuId = 3;
            break;
    };
    return view('menu', ['positions' => $position->getModel()->get(), 'categories' => $category->getModel()->where('menu', $menuId)->get()]);
});