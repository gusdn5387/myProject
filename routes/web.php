<?php

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
    $view = view('index');
    $view->greeting = "Hey~";
    $view->name = 'LOL';
    // $greeting = 'Hello';

    // return view('index')->with('greeting', $greeting);

    // return view('index')->with([
    //     'greeting' => 'Good Morning^^/',
    //     'name' => 'BBB'
    // ]);

    // return view('index', [
    //     'greeting' => 'Hi~',
    //     'name'     => 'OAO'
    // ]);
    return $view; 
});

Route::get('/2', function() {
    $items = [
        'Apple',
        'Banana'
    ];

    return view('index2', compact('items'));
});

Route::get('/master', function() {
    return view('master');
});

Route::get('/3', 'IndexController@index');

Route::resource('posts', 'PostsController');
// Route::get('posts', [
//     'as'   => 'posts.index',
//     'uses' => 'PostsController@index'
//     function() {
//         return view('posts.index');
//     }
// ]);

Route::resource('posts.comments', 'PostsCommentController');

Route::get('auth', function() {
    $credentials = [
        'email' => 'john@example.com',
        'password' => 'password'
    ];

    if(! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    return redirect('protected');
});

Route::get('auth/logout', function() {
    Auth::logout();

    return 'See you again~';
});

Route::get('protected', function() {
    if(! Auth::check()) {
        return 'Illegal access !!! Get out of here~';
    }

    return 'Welcome back, '.Auth::user()->name;
});