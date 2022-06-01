<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PositionAmountController;
use App\Http\Controllers\CategoryController;
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
});

Route::get('/', function() {
    $position = new PositionController();
    $baner = new BanerController();
    return view('home', ['positions' => $position->getModel()->get(), 'baners' => $baner->getModel()->get()]);
})->name('home');

Route::get('/cart', function() {
    $position = new PositionController();
    $positions =array();
    $positions = [];
    if(session()->has('positions')){  
          foreach(session('positions') as $posId => $val) {
            if($val)
                $positions[] = $posId;
        }
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

Route::post('/ajax/{class}/{method}', function($class, $method, Request $request) {
    $class = 'App\Http\Controllers\\'.$class.'Controller';
    $session = new $class();
    $session->$method($request); 
});
/*
Route::post('/ajax/category/{method}', function($method, Request $request) {
    $session = new CategoryController();
    $session->$method($request); 
});*/

route::get('/test', function() {
    // создание нового cURL ресурса
$ch = curl_init();

// установка URL и других необходимых параметров
curl_setopt($ch, CURLOPT_URL, "https://paymaster.ru/api/v2/invoices");
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer 2a17d9f5ff12d8147dad6f5567eecbbde0c92923895f5ceec747a7a556b4a5cd4566c44ce44ddbaa29d0b77ba1458d155f7d", "Content-type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
    "merchantId": "01fe51c5-ea66-4052-9ed7-dfc753b49a56",
    "testMode": true,
    "invoice": {
      "description": "test payment",
      "params": {
        "BT_USR": "34"
      }
    },
    "amount": {
      "value": 10.50,
      "currency": "RUB"
    },
    "paymentMethod": "BankCard"   
  }');

// загрузка страницы и выдача её браузеру
curl_exec($ch);

// завершение сеанса и освобождение ресурсов
curl_close($ch);
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
    $cat = new App\Http\Controllers\CategoryMenuController();
    return view('menu', [
        'positions' => $position->getModel()->get(),
        'categories' => $cat->get($menuId)]);
});