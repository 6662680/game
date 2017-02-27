<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'card';
    public $timestamps = false; //不使用updated_at和created_at
}
