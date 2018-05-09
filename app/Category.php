<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='category';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }
}
