<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function() {
    return "Hello Programmer Zaman Now!";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function() {
    return "404 by Adriyansyah";
});

Route::get('/products/{id}', function($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function($userId = '404') {
    return "User $userId";
})->name('user.detail');

Route::get('/product/{id}', function($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/product-redirect/{id}', function($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});