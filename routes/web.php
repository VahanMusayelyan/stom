<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});


Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login')->name('login');
Route::get('register', function () {
    return view('register');
});
Route::get('login', function () {
    return view('login');
});
Route::get('login/{website}', 'LoginController@redirectToProvider');
Route::get('login/{website}/callback', 'LoginController@handleProviderCallback');

Route::get('/employees/administrators', 'EmployeeController@admin');
Route::get('/employees/doctors', 'EmployeeController@doctor');
Route::get('logout', 'LoginController@logout');
Route::get('admin', 'AdminController@index')->name("admin");
Route::post('/ajax-post', 'AjaxController@index');
Route::post('/ajax-post-list', 'AjaxController@show');
Route::post('/ajax-post-user', 'AjaxController@user');
Route::post('/ajax-post-preview', 'AjaxController@preview');
Route::post('/ajax-post-admin', 'AjaxController@admin');
Route::post('/ajax-post-doctor', 'AjaxController@doctor');
Route::post('/ajax-post-refadmin', 'AjaxController@refadmin');
Route::post('/ajax-post-refdoctor', 'AjaxController@refdoctor');
Route::post('/ajax-post-statdoctor', 'AjaxController@statdoctor');
Route::post('/ajax-post-statadmin', 'AjaxController@statadmin');
Route::get('/organizations/{id}/destroy', 'OrganizationController@destroy');
Route::get('/employees/{id}/destroy', 'EmployeeController@destroy');
Route::resource('/organizations', 'OrganizationController');
Route::resource('/employees', 'EmployeeController');
Route::resource('/specializations', 'SpecializationController');
Route::any('/statistics-doctor', 'StatisticController@index')->name('statistics_doctor');
Route::any('/statistics-admin', 'StatisticController@admin');
Route::post('/statistics-admin-add', 'StatisticController@adminstatadd');
Route::get('/statistics-admin-add', 'StatisticController@admin');
Route::post('/statistics-doctor-add', 'StatisticController@doctorstatadd');
Route::get('/statistics-doctor-add', 'StatisticController@index');
Route::any('/statistics-specialization', 'StatisticController@specialization');
Route::any('/indicators-doctor', 'IndicatorController@index');
Route::any('/indicators-admin', 'IndicatorController@admin');
Route::any('/indicators-specialization', 'IndicatorController@specialization');
Route::get('/reference-doctor', 'ReferenceController@index');
Route::get('/reference-admin', 'ReferenceController@admin');
Route::post('/reference-list', 'ReferenceController@showreference');
Route::get('/reference-list', 'ReferenceController@list_ref');
Route::get('/reference', 'ReferenceController@list_ref');
Route::get('/users', 'AdminController@users');
Route::get('/users/{id}', 'AdminController@showuser');

Route::get('/email', 'MailController@veryfy');

