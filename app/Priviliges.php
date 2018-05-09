<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priviliges extends Model
{
    protected $table ='priviliges';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\Users','user_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory','subcategory_id');
    }
}
