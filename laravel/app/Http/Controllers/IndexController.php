<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    /**
     * 头
     *
     * @param  Request  $request
     * @return Response
     */
    public function index()
    {
        $rst = User::where('user_name' ,session('username'))->first();

        return Helper::ajax($rst);
    }
}
