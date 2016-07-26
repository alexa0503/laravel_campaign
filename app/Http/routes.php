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
Route::get('/_locale/{locale?}/{url?}', function ($locale = 'en', $url = null) {
    Session::set('locale.language',$locale);
    $cookie = cookie()->forever('locale', $locale);
    if( $url != null){
        return redirect(base64_decode($url))->withCookie($cookie);
    }
    elseif(Session::has('locale.redirect_uri')){
        return redirect(Session::get('locale.redirect_uri'))->withCookie($cookie);
    }
    else{
        return redirect('/')->withCookie($cookie);
    }

});
Route::get('/',function(){

});
Route::controller('api', 'ApiController');
Route::get('admin/login', 'Admin\AuthController@getLogin');
Route::post('admin/login', 'Admin\AuthController@postLogin');
Route::any('admin/logout', function(){
    Auth::guard('admin')->logout();
    return redirect('admin/login');
});
Route::group(['middleware' => ['menu', 'auth:admin']], function () {
    Route::get('/admin', 'AdminController@index')->name('admin_dashboard');
    Route::get('/admin/account', 'AdminController@account')->name('admin_account');


    Route::post('admin/store/order', 'Admin\StoreController@order')->name('admin.store.order');
    Route::resource('admin/store', 'Admin\StoreController');

    Route::post('admin/province/order', 'Admin\ProvinceController@order')->name('admin.province.order');
    Route::resource('admin/province', 'Admin\ProvinceController');

    Route::post('admin/city/order', 'Admin\CityController@order')->name('admin.city.order');
    Route::resource('admin/city', 'Admin\CityController');

    Route::resource('admin/user', 'Admin\UserController');
});
Route::get('/admin/install', function () {
    if (0 == App\Admin::count()) {
        $user = new \App\Admin();
        $user->name = 'admin';
        $user->email = 'wanga503@outlook.com';
        $user->password = bcrypt('admin@2016');
        $user->save();
    }
    return redirect('admin/login');
});
