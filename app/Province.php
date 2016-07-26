<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','order_no'];
    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
