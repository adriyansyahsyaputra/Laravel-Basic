<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Middleware\ContohMiddleware;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;

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
    return view('hello', [
        "name" => "adriyansyah"
    ]);
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

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);

// untuk mengambil semua array input
Route::post('/input/hello/array', [InputController::class, 'helloArray']);

Route::post('/input/type', [InputController::class, 'inputType']);

Route::post('/input/filter/Only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);

Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::get('/response/type/view', [ResponseController::class, 'responseView']);
Route::get('/response/type/json', [ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
            ->name("redirect-hello");
Route::get('/redirect/named', function() {
    // return route('redirect-hello', ['name' => 'Adriyansyah']);
    return URL::route('redirect-hello', ['name' => 'Adriyansyah']);
});

Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::get('/middleware/api', function() {
    return "OK";
})->middleware(['contoh:PZN,401']);

Route::get('/middleware/group', function() {
    return "GROUP";
})->middleware(['pzn']);

Route::get('/url/action', function() {
    return URL::action([FormController::class, 'form'], []);
});
Route::get('/form', [FormController::class, 'form']);
Route::get('/form', [FormController::class, 'submitForm']);

Route::get('/url/current', function() {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function() {
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function() {
    report(new Exception("Sample Error"));
    return "OK";
});