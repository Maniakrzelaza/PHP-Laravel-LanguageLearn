<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table ='results';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\Users','user_id');
    }
    public function wordset()
    {
        return $this->belongsTo('App\WordSet','word_set_id');
    }

}
