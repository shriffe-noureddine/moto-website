<?php
if (App::environment('production')) {
    URL::forceScheme('https');
}
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


// !! Careful, do not use a route that corresponds to a folder in the /public folder, it will produce
// a conflict saying that " the resource could not be found on the server "

use Illuminate\Support\Facades\Redirect;

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index');
//->name('home');

Route::get('/', function () {
    return view('home');
    //return redirect()->action('HomeController@index');    
});

//just to be sure the /home  is redirectedt to home
Route::get('/home', function () {
    return redirect('/');
    //return redirect()->action('HomeController@index');    
});




Route::get('/blog/create', 'NewsPostsController@create')->middleware('XssSanitizer');
Route::post('/blog', 'NewsPostsController@store')->middleware('XssSanitizer');

//Routes create just to respect the navbare

Route::get('/blog/create', 'NewsPostscontroller@create')->middleware('XssSanitizer');
Route::post('/blog', 'NewsPostscontrolle@store')->middleware('XssSanitizer');

Route::get('/offer/create', 'MotorController@create')->middleware('XssSanitizer');
Route::post('/offer', 'MotorController@store')->middleware('XssSanitizer');

//Routes for the contacts
Route::get("/contact", "Contact@contactUs")->middleware('XssSanitizer');
Route::get("/aboutus", "Contact@aboutUs")->middleware('XssSanitizer');

// route for error handling
Route::get("/error", "UsersController@errorControl");



//test to disclose the test view to users is can be use to define the admin route

Route::get('/testing/navigation', 'TestController@navigation');
Route::get('/testing/data', 'TestController@data');
Route::get('/testing/ajax', 'TestController@ajaxIndex');
Route::post('/testing/ajax', 'TestController@ajax');
Route::put('/testing/ajax', 'TestController@ajax');
Route::delete('/testing/ajax', 'TestController@ajax');

//Route::delete('/motors/delete/{id}', 'MotorController@destroy');
Route::resource('/motors', 'MotorController')->middleware('XssSanitizer');
Route::resource('/news', 'NewsPostsController')->middleware('XssSanitizer');
Route::resource('/users', 'UsersController')->middleware('XssSanitizer');
Route::get('/logout2register', 'UsersController@logout2register');

// Testing
Route::get('/testing/api/scryfall', 'TestControllerAPI@testScryfallAPI');
Route::get('/testing/api/pixabay', 'TestControllerAPI@testPixabayAPI');
Route::get('/testing/downloader/pixabay', 'TestControllerAPI@pixabayDownloader');
Route::get('/testing/api/freeforex', 'TestControllerAPI@testfreeforexAPI');
Route::get('/testing/api/chuckNorris', 'TestControllerAPI@chuckNorrisAPI');
Route::get('/testing/api/currentDateTime', 'TestControllerAPI@currentDateTime');



