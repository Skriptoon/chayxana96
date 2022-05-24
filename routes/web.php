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
    return view('home', ['positions' => $position->get()]);
});

Route::get('/chayhana', function() {
    $position = new PositionController();
    $category = new CategoryController();
    return view('menu', ['positions' => $position->get(1), 'menu' => 1, 'categories' => $category->get(1)]);
})->name('chayhana');

Route::get('/panasia', function() {
    $position = new PositionController();
    $category = new CategoryController();
    return view('menu', ['positions' => $position->get(2), 'menu' => 2, 'categories' => $category->get(2)]);
})->name('panasia');

Route::get('/mangal', function() {
    $position = new PositionController();
    $category = new CategoryController();
    return view('menu', ['positions' => $position->get(3), 'menu' => 3, 'categories' => $category->get(3)]);
})->name('mangal');

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

