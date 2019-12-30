<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    //
    public function clan() {
        return $this->belongsTo('App\Clans', 'clanid');
    }
}
