<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'team';
    static function getTeaMById($team_id){
         return self::where('id',$team_id)->value('team_name');
    }
}
