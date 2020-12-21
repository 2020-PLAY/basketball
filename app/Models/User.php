<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user';
    public $timestamps = false;

    //更具id找姓名
    static function getNameById($id){
      return self::where('id',$id)->value('user_name');
    }

}
