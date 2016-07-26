<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Carbon\Carbon;
use App;

class ApiController extends Controller
{
    public function getCities()
    {

        /*
        foreach($data as $v){
            $data1 = [
                'title'=>$v['city1'],
                'order_no'=>0,
            ];
            App\Province::firstOrCreate($data1);
            $province = App\Province::where('title',$v['city1'])->first();

            $data1 = [
                'title'=>$v['name'],
                'address'=>$v['address'],
                'city_id'=>$city->id,
                'order_no'=>0,
            ];
            App\Store::firstOrCreate($data1);
        }
        */

        $provinces = App\Province::orderBy('order_no','ASC')->get();
        $result = [];
        foreach($provinces as $province){
            $cities = [];
            foreach($province->cities as $city){
                $cities[$city->id] = $city->title;
            }
            $result[$province->id] = [
                'title'=>$province->title,
                'cities'=>$cities,
            ];
        }
        return $result;
    }
    public function getStores(Request $request,$city)
    {
        $stores = App\Store::where('city_id',$city)->orderBy('order_no','ASC')->get();
        return $stores;
    }
}
