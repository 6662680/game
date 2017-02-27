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
use App\user;
use App\Services;
use Illuminate\Http\Request;
/**
 * 注册用户
 *
 * @param  Request  $request
 * @return Response
 */
Route::get('registered/{username}/{password}', function ($username, $password) {

    if (!strlen($username) > 11 || !strlen($password) > 11) {
        return Services\Helper::ajax(array('success'=>false ,'msg'=>'用户名或密码过长'));
    }

    $data = App\user::where('user_name', $username)->first();

    if (!empty($data->id)) {
        return Services\Helper::ajax(array('success'=>false ,'msg'=>'账号已存在'));
    } else {
        $model = new user;
        $model->user_name = $username;
        $model->password = md5($password);
        $model->save();

        return Services\Helper::ajax(array('success'=>true, 'msg' => '注册成功'));
    }
});

/**
 * 用户登陆
 *
 * @param  Request  $request
 * @return Response
 */
Route::get('login/{username}/{password}', function ($username, $password , Request $request) {

    if (!strlen($username) > 11 || !strlen($password) > 11) {
        return Services\Helper::ajax(array('success'=>false ,'msg'=>'用户名或密码过长'));
    }

    $data = App\user::where('user_name', $username)->first();

    if (empty($data->id)) {
        return Services\Helper::ajax(array('success'=>false ,'msg'=>'账号不存在'));
    }

    if ($data->user_name == $username && $data->password == md5($password)) {

        $request->session()->put('username', $username);
        return Services\Helper::ajax(array('success'=>true , 'msg' => session('username')));
    } else {
        return Services\Helper::ajax(array('success'=>false ,'msg'=>'用户名或密码错误'));
    }
});


/**
 * 首页
 */
Route::get('/','IndexController@index');

/**
 * 抽卡牌
 */
Route::get('searchcard/{type}','CardController@searchcard');

/**
 * 装备强化
 */
Route::get('breakthrough/{id}/{num}','BreakthroughController@start');




