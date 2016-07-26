<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','province_id','order_no'];
    public function stores()
    {
        return $this->hasMany('App\Store');
    }
}
