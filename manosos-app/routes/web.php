<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
 
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

Route::get('/', function () { return view('welcome');});
Route::get('/login', [LoginController::class, 'show_login'])->name('login');
Route::post('/send_login', [LoginController::class, 'send_data']);
Route::post('/sign_in', [LoginController::class, 'sign_in']);
Route::get('/log_out', [LoginController::class, 'log_out']);
Route::get('/profile', [ProfileController::class, 'home'])->name('profile');
Route::get('/get_tasks', [TaskController::class, 'get_tasks']);
Route::get('/get_tasks_all', [TaskController::class, 'get_tasks_all']);
Route::get('/get_tasks_closed', [TaskController::class, 'get_tasks_closed']);
Route::get('/get_tasks_closed_all', [TaskController::class, 'get_tasks_closed_all']);
Route::post('/add_task', [TaskController::class, 'add_task']);
Route::post('/update_tasks', [TaskController::class, 'update_tasks']);
Route::post('/delete_task', [TaskController::class, 'delete_task']);




