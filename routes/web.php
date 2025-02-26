<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminkaController;
use Illuminate\Http\Request;


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

Route::get('/', [MainController::class, 'Main_Page']) -> name('main');

Route::post('contact-form', [MainController::class, 'Send_Mail']);

Route::get('/post/{cat}/{name}', [MainController::class, 'Post_Detail']);

Route::get('/post', [MainController::class, 'Post_Page']) -> middleware('auth') -> name('posts');

Route::get('/post/{cat}', [MainController::class, 'Post_Cat']) ->whereAlphaNumeric('cat');

Route::get('/registr', [MainController::class, 'Registration_Page']) -> name('registration');

Route::post('registration', [MainController::class, 'Registration']);

Route::post('go_out', [MainController::class, 'Go_Out']);

Route::get('/auth', [MainController::class, 'Auth_Page']) -> name('auth');

Route::post('/auth_form', [MainController::class, 'Auth_Form']);

// для админки
Route::get('/adminka', [AdminkaController::class, 'Admin_Page']) -> middleware('auth') -> middleware('check.role') -> name('admin');

Route::post('/delete_post', [AdminkaController::class, 'Delete_Post']) -> middleware('auth') -> middleware('check.role');

Route::post('/add_post', [AdminkaController::class, 'Add_Post']) -> middleware('auth') -> middleware('check.role');

Route::post('/update_post', [AdminkaController::class, 'Update_Post']) -> middleware('auth') -> middleware('check.role');

Route::get('/post_api', [AdminkaController::class, 'Post_Api']) -> middleware('auth');

Route::post('/cat_api', [AdminkaController::class, 'Cat_Api']) -> middleware('auth');

Route::post('/add_cat', [AdminkaController::class, 'Add_Cat']) -> middleware('auth') -> middleware('check.role');

Route::get('/users_list', [AdminkaController::class, 'Users_Page']) -> middleware('auth') -> middleware('check.role') -> name('users_list');

Route::post('/users_api', [AdminkaController::class, 'Users_Api']) -> middleware('auth') -> middleware('check.role');

Route::post('/update_user', [AdminkaController::class, 'Update_User']) -> middleware('auth') -> middleware('check.role');

Route::post('/delete_cat', [AdminkaController::class, 'Delete_Cat']) -> middleware('auth') -> middleware('check.role');
// для админки

// Route::get('/test', function(Request $request){
//     dump($request->user()->role);
// });