<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\user;
use App\Services;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        Input::get('test');
        echo 222;die();
        if (!strlen($username) > 11 || !strlen($password) > 11) {
            return Services\Helper::ajax(array('success'=>false ,'msg'=>'用户名或密码过长'));
        }

        $data = user::where('user_name', $username)->first();

        if (empty($data->id)) {
            return Services\Helper::ajax(array('success'=>false ,'msg'=>'账号不存在'));
        }

        if ($data->user_name == $username && $data->password == md5($password)) {
            return Services\Helper::ajax(array('success'=>true , 'msg' => session('username')));
        } else {
            return Services\Helper::ajax(array('success'=>false ,'msg'=>'用户名或密码错误'));
        }
    }
}
