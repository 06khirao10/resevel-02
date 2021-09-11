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
    return view('welcome');
});

Route::get('login', 'User\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'User\Auth\LoginController@showLoginForm');

Route::get('register', 'User\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'User\Auth\RegisterController@showRegistrationForm');

Route::post('logout', 'User\Auth\LoginController@logout')->name('logout');

Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login');

Route::get('admin/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('admin/register', 'Admin\Auth\RegisterController@register');

Route::get('/', 'UserController@home')->name('home');
Route::get('/next-month', 'UserController@nextMonth')->name('nextMonth');
Route::get('password-edit', 'UserController@passwordEdit')->name('user.passwordEdit');
Route::put('password-update', 'UserController@passwordUpdate')->name('user.passwordUpdate');
Route::get('/admin/users', 'UserController@adminIndex')->name('admin.users.index');


Route::get('reservations', 'ReservationController@index')->name('user.reservations');
Route::get('reservations/create', 'ReservationController@create')->name('reservations.create');
Route::post('reservations/store', 'ReservationController@store')->name('reservations.store');
Route::get('thanks', 'ReservationController@thanks')->name('reservations.thanks');
Route::delete('reservations/destroy/{reservation}', 'ReservationController@destroy')->name('reservations.destroy');
Route::get('reservations', 'ReservationController@index')->name('user.reservations');
Route::get('/admin', 'ReservationController@adminHome')->name('admin.home');
Route::get('/admin/reservations', 'ReservationController@adminIndex')->name('admin.reservations');
Route::get('/admin/reservations/edit', 'ReservationController@adminEdit')->name('admin.reservations.edit');
Route::put('/admin/reservations/update', 'ReservationController@adminUpdate')->name('admin.reservations.update');


Route::get('/admin/schedules', 'ScheduleController@edit')->name('admin.schedules');
Route::post('/admin/schedules/store', 'ScheduleController@store')->name('admin.schedules.store');


Route::get('/admin/password-edit', 'AdminController@passwordEdit')->name('admin.passwordEdit');
Route::put('/admin/password-update', 'AdminController@passwordUpdate')->name('admin.passwordUpdate');
