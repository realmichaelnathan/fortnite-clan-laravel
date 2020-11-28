<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Clans extends Model
{
    //
    protected $fillable = ['name', 'description','picture','discord','website','twitter','facebook','youtube','instagram','userid', 'bumps'];

    public function total_votes() {
        return $this->hasMany('App\Votes', 'clanid')->count();
    }

    // Expects a date, returns all rows with a created date greater than the date provided.
    public function views_by_day($date) {
        return $this->hasMany('App\Views', 'clanid')->where('created_at','>',$date)->groupBy('date')->orderBy('date', 'desc');
    }

    public function owner() {
        return $this->belongsTo('App\User', 'userid');
    }

    public function votes() {
        return $this->hasMany('App\Votes', 'clanid')->with('user');
    }

    public function platform() {
        return $this->belongsToMany('App\Platform');
    }

    public function region() {
        return $this->belongsToMany('App\Region');
    }

}
