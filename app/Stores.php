<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = ['store_name', 'location'];
    public function post_details(){
        return $this->hasMany('App\PostDetails');
    }
}
