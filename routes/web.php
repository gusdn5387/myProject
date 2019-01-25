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
    // $view = view('index');
    // $view->greeting = "Hey~";
    // $view->name = 'LOL';
    // return $view; 
    return App\Post::findOrFail(100);
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

Route::post('posts', function(\Illuminate\Http\Request $request) {
    $rule = [
        'title' => ['required'],
        'body' => ['required', 'min:10']
    ];

    $validator = Validator::make($request->all(), $rule);

    if($validator->fails()) {
        return redirect('posts/create')->withErrors($validator)->withInput();
    }

    return 'Valid & proceed to next job ~';
});

Route::get('posts/create', function() {
    return view('posts.create');
});

// Route::get('home', [
//     'middleware' => 'auth',
//     function() {
//         return 'welcome back, '.Auth::user()->name;
//     }
// ]);

// Route::get('auth/login', 'Auth\LoginController@showLoginForm');
// Route::post('auth/login', 'Auth\LoginController@login');
// Route::get('auth/logout', 'Auth\LoginController@logout');

// Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
// Route::post('auth/register', 'Auth\RegisterController@register');

Route::get('auth', function () {
    $credentials = [
        'email'    => 'john@example.com',
        'password' => 'password'
    ];

    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    Event::fire('user.login', [Auth::user()]);

    var_dump('Event fired and continue to next line...');

    return;
});

Event::listen('user.login', function($user) {
    // var_dump('"user.log" event catched and passed data is:');
    // var_dump($user->toArray());
    $user->last_login = (new DateTime)->format('Y-m-d H:i:s');

    return $user->save();
});

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