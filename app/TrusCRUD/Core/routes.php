<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;

Route::namespace('\App\TrusCRUD\Core\Controllers')->group(function() {

    Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('auth.provider');
    Route::get('/callback/{provider}', 'SocialController@callback');
});

Route::middleware(["auth", CheckPermission::class])->group(function() {
    
    Route::get('/error/{code}', 'RedirectController@error')->name('error');
    Route::get('/dashboard',    'HomeController@index')->name('dashboard');

    //Route for files
    
    Route::namespace('\App\TrusCRUD\Core\Controllers')->group(function() {
        
        //Profile
        Route::get('/profile',          'GeneralController@profile')->name('profile');

        //Notification
        Route::get('/notification',         'NotificationController@notification')->name('notification');
        Route::post('/notification',        'NotificationController@notification_json')->name('notification_json');
        Route::post('/notification/read',   'NotificationController@notification_mark_as_read')->name('notification_read');
        
        //Files
        Route::resource('files', 'FilesController');
        
        Route::prefix('access/role')->group(function () {
        
            Route::get    ('/',                     'AccessRoleController@index')->name("role.index");
            Route::get    ('/all',                  'AccessRoleController@all')->name("role.all");
            Route::get    ('/form',                 'AccessRoleController@form')->name("role.create");
            Route::get    ('/form/{UUID}',          'AccessRoleController@form')->name("role.edit");
            Route::delete ('/{UUID}',               'AccessRoleController@delete')->name("role.delete");
            Route::get    ('/{UUID}',               'AccessRoleController@detail')->name("role.detail");
        
            Route::post   ('/form',                 'AccessRoleController@save')->name("role.save");
            Route::post   ('/set_persmission',      'AccessRoleController@set_persmission')->name("permissions.role.set");
        
        });
        
        Route::prefix('access/menu')->group(function () {
        
            Route::get    ('/',                'AccessMenuController@index')->name("menu.index");
            Route::get    ('/all',             'AccessMenuController@all')->name("menu.all");
            Route::get    ('/form',            'AccessMenuController@form')->name("menu.create");
            Route::get    ('/form/{UUID}',     'AccessMenuController@form')->name("menu.edit");
            Route::delete ('/{UUID}',          'AccessMenuController@delete')->name("menu.delete");
            Route::get    ('/{UUID}',          'AccessMenuController@detail')->name("menu.detail");
        
            Route::post   ('/form',             'AccessMenuController@save')->name("menu.save");
            Route::patch  ('/form',             'AccessMenuController@save_nested')->name("menu.patch");
        });
        
        Route::post   ('users/upload_avatar',   'UsersController@upload_avatar')->name('users.upload_avatar');
        Route::resource('users', 'UsersController');
        // Route::prefix('users')->group(function () {
        //     Route::get    ('/',                'UsersController@index')->name("users.index");
        //     Route::get    ('/all',             'UsersController@all')->name("users.all");
        //     Route::get    ('/form',            'UsersController@form')->name("users.form");
        //     Route::get    ('/form/{UUID}',     'UsersController@form')->name("users.edit");
        //     Route::delete ('/{UUID}',          'UsersController@delete')->name("users.delete");
        //     Route::post   ('/form',            'UsersController@save')->name('users.save');
        //     Route::post   ('/upload_avatar',   'UsersController@upload_avatar')->name('users.upload_avatar');
        // });

        Route::prefix('settings')->group(function () {
            Route::get    ('/',           'SettingsController@account')->name("setting.account");
            Route::get    ('/security',   'SettingsController@security')->name("setting.security");
            Route::get    ('/appearance', 'SettingsController@appearance')->name("setting.appearance");
    
            Route::get    ('/logging',    'SettingsController@logging')->name("setting.logging");
        });

        //Begin Route tc_generator
        Route::resource('generator', 'GeneratorController');
        //End Route tc_generator
    });

});