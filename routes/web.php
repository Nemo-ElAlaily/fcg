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

define('FRONT_PAGINATION_COUNT', 12);


Route::get('/', 'FrontController@index')->name('index');
Route::get('/about-us', 'FrontController@about')->name('about');
Route::get('/services', 'FrontController@services')->name('services');
Route::get('/service-projects/{slug}', 'FrontController@serviceProjects')->name('service.projects');
Route::get('/contact-us', 'FrontController@contact')->name('contact');
Route::post('/contact-us', 'FrontController@postContact')->name('post.contact');
Route::get('/all-projects', 'FrontController@projects')->name('projects');
Route::get('/awarded-projects', 'FrontController@awardedProjects')->name('awarded.projects');
Route::get('/all-categories', 'FrontController@categories')->name('categories');
Route::get('/projects/{slug}', 'FrontController@categoryProjects')->name('category.projects');
Route::get('/all-projects/{slug}/', 'FrontController@singleProject')->name('single.project');


Auth::routes();
