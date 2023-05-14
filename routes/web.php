<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\FallbackController;

//dodaj ovaj namespace
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
/*
Route::get('/', function () {
    //dd(config('services.mailgun.domain'));
    return view('welcome');
});

//get
Route::get('/blog', [postsController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [postsController::class, 'show'])->name('blog.show'); //single id
//post
Route::get('/blog/create', [postsController::class, 'create'])->name('blog.create');
Route::post('/blog', [postsController::class, 'store'])->name('blog.store');
//update patch
Route::get('/blog/edit/{id}', [postsController::class, 'edit'])->name('blog.edit');
Route::patch('/blog/{id}', [postsController::class, 'update'])->name('blog.update');
//delete
Route::delete('/blog/{id}', [postsController::class, 'destroy'])->name('blog.destroy');
*/
Route::prefix('blog')->group(function () {
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/{id}', [PostsController::class, 'show'])->name('blog.show');

    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
    Route::patch('/{id}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{id}', [PostsController::class, 'destroy'])->name('blog.destroy');
});
//fallbackRoute
Route::fallback(FallbackController::class);


//multiply http verbs
//Route::match(['GET','POST'],'blog',[postsController::class, 'index']);
//Route::any('blog',[postsController::class, 'index']);

//simple return view
//ne radi
//Route::view('/blog','blog.index', ['name' => 'code with Uros']);


//pravljenje autmotski svih route za sve metode u postsControleru
//Route::resource('blog', postsController::class);


//route for invoke method

Route::get('/', homeController::class);
