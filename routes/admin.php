<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'admin', 'prefix'=>'adminpanel', 'as'=>'admin.'], function() {
    Route::any('/', 'AuthController@login')->name('login');
    Route::any('/forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
    Route::any('/reset-password/{token}', 'AuthController@resetPassword')->name('reset-password');
    Route::post('/ckeditor-upload', 'CmsController@upload')->name('ckeditor-upload');
    Route::any('/401', 'AuthController@unauthorizedAccess')->name('401');    // Unauthorized access

    Route::group(['middleware' => 'backend'], function () {
        Route::get('/dashboard', 'AccountController@dashboard')->name('dashboard');
        Route::any('/profile', 'AccountController@profile')->name('profile');
        Route::post('/account/delete-uploaded-image', 'AccountController@deleteUploadedImage')->name('delete-uploaded-image');
        Route::any('/change-password', 'AccountController@changePassword')->name('change-password');
        Route::any('/generate-slug', 'AccountController@generateSlug')->name('generate-slug');
        Route::any('/logout', 'AuthController@logout')->name('logout');

        Route::group(['middleware' => 'admin'], function () {
            Route::any('/website-settings', 'AccountController@websiteSettings')->name('website-settings');

            Route::group(['prefix' => 'state', 'as' => 'state.'], function () {
                Route::get('/list', 'StatesController@list')->name('list');
                Route::post('/ajax-list-request', 'StatesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'StatesController@add')->name('add');
                Route::post('/add-submit', 'StatesController@add')->name('add-submit');
                Route::get('/edit/{id}', 'StatesController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'StatesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'StatesController@status')->name('change-status');
                Route::get('/delete/{id}', 'StatesController@delete')->name('delete');
                Route::post('/delete-uploaded-image', 'StatesController@deleteUploadedImage')->name('delete-uploaded-image');
                Route::get('/sort', 'StatesController@sort')->name('sort');
                Route::post('/save-sort', 'StatesController@saveSort')->name('save-sort');
                Route::get('/sort-city/{id}', 'StatesController@sortCity')->name('sort-city');
                Route::post('/save-sort-city/{id}', 'StatesController@saveSortCity')->name('save-sort-city');
                Route::post('/bulk-actions', 'StatesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'city', 'as' => 'city.'], function () {
                Route::get('/list', 'CitiesController@list')->name('list');
                Route::post('/ajax-list-request', 'CitiesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'CitiesController@add')->name('add');
                Route::post('/add-submit', 'CitiesController@add')->name('add-submit');
                Route::get('/edit/{id}', 'CitiesController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'CitiesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'CitiesController@status')->name('change-status');
                Route::get('/delete/{id}', 'CitiesController@delete')->name('delete');
                Route::post('/delete-uploaded-image', 'CitiesController@deleteUploadedImage')->name('delete-uploaded-image');
                // Route::get('/sort', 'CitiesController@sort')->name('sort');
                // Route::post('/save-sort', 'CitiesController@saveSort')->name('save-sort');
                Route::get('/sort-season/{id}', 'CitiesController@sortSeason')->name('sort-season');
                Route::post('/save-sort-season/{id}', 'CitiesController@saveSortSeason')->name('save-sort-season');
                Route::post('/bulk-actions', 'CitiesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'pickleballCourt', 'as' => 'pickleballCourt.'], function () {
                Route::get('/list', 'PickleballCourtsController@list')->name('list');
                Route::post('/ajax-list-request', 'PickleballCourtsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'PickleballCourtsController@add')->name('add');
                Route::post('/add-submit', 'PickleballCourtsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'PickleballCourtsController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'PickleballCourtsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'PickleballCourtsController@status')->name('change-status');
                Route::get('/delete/{id}', 'PickleballCourtsController@delete')->name('delete');
                Route::post('/bulk-actions', 'PickleballCourtsController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'video', 'as' => 'video.'], function () {
                Route::get('/list', 'VideosController@list')->name('list');
                Route::post('/ajax-list-request', 'VideosController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'VideosController@add')->name('add');
                Route::post('/add-submit', 'VideosController@add')->name('add-submit');
                Route::get('/edit/{id}', 'VideosController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'VideosController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'VideosController@status')->name('change-status');
                Route::get('/delete/{id}', 'VideosController@delete')->name('delete');
                Route::post('/bulk-actions', 'VideosController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
                Route::get('/', 'BannersController@list')->name('list');
                Route::post('ajax-list-request', 'BannersController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'BannersController@add')->name('add');
                Route::post('/add-submit', 'BannersController@add')->name('add-submit');
                Route::get('/edit/{id}', 'BannersController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'BannersController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'BannersController@status')->name('change-status');
                Route::get('/delete/{id}', 'BannersController@delete')->name('delete');
                Route::get('/sort', 'BannersController@sort')->name('sort');
                Route::post('/save-sort', 'BannersController@saveSort')->name('save-sort');
                Route::post('/bulk-actions', 'BannersController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'promoCode', 'as' => 'promoCode.'], function () {
                Route::get('/list', 'PromoCodesController@list')->name('list');
                Route::post('/ajax-list-request', 'PromoCodesController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'PromoCodesController@add')->name('add');
                Route::post('/add-submit', 'PromoCodesController@add')->name('add-submit');
                Route::get('/edit/{id}', 'PromoCodesController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'PromoCodesController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'PromoCodesController@status')->name('change-status');
                Route::get('/delete/{id}', 'PromoCodesController@delete')->name('delete');
                Route::post('/bulk-actions', 'PromoCodesController@bulkActions')->name('bulk-actions');
            });

            Route::group(['prefix' => 'player', 'as' => 'player.'], function () {
                Route::get('/', 'PlayersController@list')->name('list');
                Route::post('ajax-list-request', 'PlayersController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/edit/{id}', 'PlayersController@edit')->name('edit');
                Route::any('/edit-submit/{id}', 'PlayersController@edit')->name('edit-submit');
                Route::get('/view/{id}', 'PlayersController@view')->name('view');
                Route::get('/status/{id}', 'PlayersController@status')->name('change-status');
                Route::get('/delete/{id}', 'PlayersController@delete')->name('delete');
                Route::post('/bulk-actions', 'PlayersController@bulkActions')->name('bulk-actions');
                Route::any('/ajax-city-wise-region', 'PlayersController@ajaxCityWiseRegion')->name('ajax-city-wise-region');
                Route::any('/ajax-region-wise-preferred-home-court-and-league', 'PlayersController@ajaxRegionWisePreferredHomeCourtAndLeague')->name('ajax-region-wise-preferred-home-court-and-league');
            });

            Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
                Route::get('/', 'CmsController@list')->name('list');
                Route::post('ajax-list-request', 'CmsController@ajaxListRequest')->name('ajax-list-request');
                Route::get('/add', 'CmsController@add')->name('add');
                Route::post('/add-submit', 'CmsController@add')->name('add-submit');
                Route::get('/edit/{id}', 'CmsController@edit')->name('edit');
                Route::post('/edit-submit/{id}', 'CmsController@edit')->name('edit-submit');
                Route::get('/status/{id}', 'CmsController@status')->name('change-status');
                Route::get('/delete/{id}', 'CmsController@delete')->name('delete');
                Route::post('/delete-uploaded-image', 'CmsController@deleteUploadedImage')->name('delete-uploaded-image');
            });
            
        });

    });

});


