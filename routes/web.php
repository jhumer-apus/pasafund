<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Post\PostController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function() {
        return redirect('/posts/all');
    })->name('posts.index');

    Route::get('/my-posts', function() {
        return redirect('/posts/my-posts/all');
    })->name('posts.my-posts');

    Route::prefix('posts')->group(function (){
        Route::get('/{type}', [PostController::class, 'index']);
        Route::post('/add', [PostController::class, 'add']);
        Route::put('/update', [PostController::class, 'update']);
        Route::delete('/delete/{id}', [PostController::class, 'delete']);

        Route::get('/my-posts/{type}', [PostController::class, 'myPosts']);
    });
});
