<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
        protected $guarded = array('id');
        //追記は以下
        public static $rules = array(
            'title' => 'required',
            'body' => 'required',
        );

        //追記PHP/Laravel18
        // Historyモデルに関連付け
        public function histories()
        {
             return $this->hasMany('App\History');
        }

}
