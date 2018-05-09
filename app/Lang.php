<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table ='lang';
    public $primaryKey = 'id';
    public $timestamps = false;
}
