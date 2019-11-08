<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserLists;
use App\ListDetails;

class UserLists extends Model
{
    public function list_details()
    {
        return $this->hasMany('App\ListDetails');
    }
}
