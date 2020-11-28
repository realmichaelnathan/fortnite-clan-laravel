<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Region extends Model
{
    public function clan() {
        return $this->belongsToMany('App\Clans');
    }
}
