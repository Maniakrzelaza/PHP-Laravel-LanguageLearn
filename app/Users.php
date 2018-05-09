<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Priviliges;

class Users extends Model
{
    protected $table ='users';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function results()
    {
        return $this->hasMany('App/Results');
    }
    public function priviliges()
    {
        return $this->hasMany('App\Priviliges');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function hasPrivilige($id,$sid)
    {
        $temp=Priviliges::all()->where('user_id',$id)->where('subcategory_id',$sid);
        if(count($temp)==0){return false;}
        else
        {return true;}
    }
    public function isItUsersSet($id,$wordSetId)
    {
        $temp=WordSet::all()->where('user_id',$id)->where('id',$wordSetId);
        if(count($temp)==0){return false;}
        else
        {return true;}
    }
}
