<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Priviliges;
class Subcategory extends Model
{
    protected $table ='subcategory';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function wordsets()
    {
        return $this->hasMany('App\WordSet');
    }
    public function priviliges()
    {
        return $this->hasMany('App\Priviliges');
    }
    public function dupa($id)
    {
        return false;
    }
}
