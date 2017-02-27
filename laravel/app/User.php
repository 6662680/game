<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'user';
    public $timestamps = false; //不使用updated_at和created_at
}
