<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::auth();
//登录登出
Route::get('cms/login', 'Auth\AuthController@getLogin');
Route::post('cms/login', 'Auth\AuthController@postLogin');
Route::get('cms/logout', 'Auth\AuthController@logout');
//屏蔽注册路由
Route::any('register', function(){

});
//Route::get('/register', 'Auth\AuthController@getRegister');
//Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/', 'CmsController@index');
Route::get('cms', 'CmsController@index');
Route::get('cms/users', 'CmsController@users');
Route::get('cms/users/{openid}', 'CmsController@users');
Route::get('cms/voices', 'CmsController@voices');
Route::get('cms/voices/{id}', 'CmsController@voices');
Route::delete('cms/voice/delete/{id}', 'CmsController@destroyVoice');
Route::get('cms/infos', 'CmsController@infos');
Route::get('cms/likes', 'CmsController@likes');
Route::get('cms/account', 'CmsController@account');
Route::post('cms/account', 'CmsController@accountPost');

Route::get('cms/user/logs', function(){
    return;
});
//初始化后台帐号
Route::get('cms/account/install', function () {
    if (0 == \App\Admin::count()) {
        $user = new \App\Admin();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin123');
        $user->save();
    }

    return redirect('/');
});
