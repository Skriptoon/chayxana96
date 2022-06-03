<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BanerController;

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

Route::domain('admin.localhost')->group(function() {
    Route::get('/', function() {
        return view('admin.home');
    })->name('admin');

    Route::get('/category', function() {
        $category = new App\Http\Controllers\CategoryAdminController();
        return view('admin.category', ['categories' => $category->get()]);
    })->name('admin_category');

    Route::get('/position', function() {
        $category = new App\Http\Controllers\CategoryAdminController();
        $position = new App\Http\Controllers\PositionAdminController();
        return view('admin.position', 
        ['categories' => $category->get(),
        'positions' => $position->get()]);
    })->name('admin_position');;
});

Route::get('/', function() {
    $position = new App\Http\Controllers\PositionMenuController();
    $baner = new BanerController();
    return view('home', ['positions' => $position->get()->get(), 'baners' => $baner->getModel()->get()]);
})->name('home');

Route::get('/cart', function() {
    $position = new App\Http\Controllers\PositionMenuController();
    $positions =array();
    $positions = [];
    if(session()->has('positions')){  
          foreach(session('positions') as $posId => $val) {
            if($val)
                $positions[] = $posId;
        }
    }
    return view('cart', ['positions' => $position->get()->whereIn('menu__positions.id', $positions)->get()]);
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

Route::post('/ajax/{class}/{method}', function($class, $method, Request $request) {
    $class = 'App\Http\Controllers\\'.$class.'Controller';
    $session = new $class();
    $session->$method($request); 
});

/******* Должно быть в конце **********/
Route::get('/{menu}', function($menu) {
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

    $position = new App\Http\Controllers\PositionMenuController();
    $category = new App\Http\Controllers\CategoryMenuController();

    return view('menu', [
        'positions' => $position->get($menuId),
        'categories' => $category->get($menuId)]);
});