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

Route::get('posts', function() {
    $posts = App\Post::with('user')->paginate(10);

    return view('posts.index', compact('posts'));
});

Route::resource('posts.comments', 'PostsCommentController');

Route::get('home', [
    'middleware' => 'auth',
    function() {
        return 'welcome back, '.Auth::user()->name;
    }
]);

Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('auth/register', 'Auth\RegisterController@register');

Route::get('mail', function() {
    $to = 'ssejung0828@gmail.com';
    $subject = 'Studying sending email in Laravel';
    $data = [
        'title' => 'Hi there',
        'body'  => 'This is the body of an email message',
        'user'  => App\User::find(1)
    ];
    
    return Mail::send('emails.welcome', $data, function($message) use($to, $subject) {
        $message->to($to)->subject($subject);
    });
});