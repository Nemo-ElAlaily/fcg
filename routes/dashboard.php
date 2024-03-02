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

define('ADMIN_PAGINATION_COUNT', 10);


// Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', 'DashboardController@index')->name('index');

    Route::get('site_settings/{id}', 'SiteSettingsController@generalShow')->name('settings.site.show');
    Route::put('site_settings/{id}', 'SiteSettingsController@generalUpdate')->name('settings.site.update');

    /* Pages Routes */
    Route::resource('pages', 'PageController');
    /* end of Pages Routes */

    /* categories Routes */
    Route::resource('categories', 'CategoryController');
    /* end of categories Routes */

    /* branches Routes */
    Route::resource('branches', 'BranchController');
    /* end of branches Routes */

    /* partners Routes */
    Route::resource('partners', 'PartnerController');
    /* end of partners Routes */

    /* clients Routes */
    Route::resource('clients', 'ClientController');
    /* end of clients Routes */

    /* certificates Routes */
    Route::resource('certificates', 'CertificateController');
    /* end of certificates Routes */

    /* services Routes */
    Route::resource('services', 'ServiceController');
    /* end of services Routes */

    /* pmo Routes */
    Route::resource('offices', 'ProjectManagementOfficeController');
    /* end of pmo Routes */

    /* projects Routes */
    Route::resource('projects', 'ProjectController');
    /* end of projects Routes */

    /* contact-forms Routes */
    Route::resource('contact', 'ContactController');
    /* end of contact-forms Routes */

    /* sliders Routes */
    Route::resource('sliders', 'SliderController');
    /* end of sliders Routes */

});
