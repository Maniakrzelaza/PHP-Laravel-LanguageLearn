<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordSet extends Model
{
    protected $table ='word_set';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    public function results()
    {
        return $this->hasMany('App\Results');
    }
}
