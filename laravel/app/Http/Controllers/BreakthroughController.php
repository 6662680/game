<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\Http\Requests;
use Symfony\Component\Console\Helper\Helper;

class BreakthroughController extends Controller
{

    /**
     * 抽卡牌
     *@param  $id
     * @param  $id
     * @return Response
     */
    public function start($id, $num)
    {
        $proportion = Services\Helper::get_proportion($num);

        $randNum = mt_rand(1, 100);
        //echo '随机数:'.$randNum .'概率'.$proportion.'结果' ;

        //随机数小于等于总基数

        if ($randNum <= $proportion) {
            $result = true;
        } else {
            $result = false;
        }
        return Services\Helper::ajax(array('success' => $result));
    }

}
