<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\card;
use App\user;
use App\Services;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Helper\Helper;

class CardController extends Controller
{

    /**
     * 抽卡牌
     *
     * @param  Request  $request
     * @return Response
     */
    public function searchcard($type)
    {
        if ($type == 1) {
            $data = card::where('status', 1)->where('level', '<', 2)->get()->toArray();
        } elseif ($type == 2) {
            $data = card::where('status', 1)->where('level', '>', 1)->get()->toArray();
        } elseif ($type == 3) {
            $data = card::where('status', 1)->where('level', '=', 3)->get()->toArray();
        }

        $arr = array();
        foreach ($data as $key => $value) {
            $arr[$value['id']] = $value['probability'];
        }

        //抽取随机卡牌的ID
        $rid = Services\Helper::get_rand($arr);

        $rst = array();
        foreach ($data as $key => $value) {
            if ($value['id'] == $rid) {
                $rst['id'] = $value['id'];
                $rst['name'] = $value['name'];
                $rst['initial_attack'] = $value['initial_attack'];
                $rst['initial_defense'] = $value['initial_defense'];
                $rst['initial_blood'] = $value['initial_blood'];
                $rst['initial_energy'] = $value['initial_energy'];
                $rst['img'] = $value['img'];
            }
        }

        return Services\Helper::ajax(array('success'=>true ,'data'=>$rst));
    }

}
