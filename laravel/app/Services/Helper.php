<?php

namespace App\Services;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/25
 * Time: 1:47
 */

class Helper
{
    public static function ajax($data)
    {
        header("Access-Control-Allow-Origin: *");
        return json_encode($data);
    }

    /**
     * 随机取值
     *
     * @param  array(1=>50,2=>30,3=>20)
     * @return result
     */
    public static  function get_rand($proArr) {

        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
//        print_r($proSum);
//        echo ':';
        ////概率数组循环
        foreach ($proArr as $key => $proCur) {

        $randNum = mt_rand(1, $proSum);
        //echo '随机数:'.$randNum .'概率'.$proCur.'====' ;

            //随机数小于等于总基数
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
       }

    unset ($proArr);
    return $result;
    }

    /**
     * 获取概率
     *
     * @param  $num
     * @return result
     */
    public static function get_proportion($num)
    {
        $proportion = array(
            '1' =>  98,
            '2' =>  95,
            '3' =>  90,
            '4' =>  80,
            '5' =>  70,
            '6' =>  50,
            '7' =>  45,
            '8' =>  43,
            '9' =>  41,
            '10' =>  40,
            '11' =>  37,
            '12' =>  35,
            '13' =>  33,
            '14' =>  32,
            '15' =>  29,
            '16' =>  27,
            '17' =>  25,
            '18' =>  23,
            '19' =>  20,
            '20' =>  18,
         );

        if ($num <= 20) {
            return $proportion[$num];
        } else {
            return 15;
        }
    }

}