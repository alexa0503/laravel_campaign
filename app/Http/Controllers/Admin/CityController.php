<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $province = $request->input('province');
        $provinces = App\Province::orderBy('order_no','asc')->get();
        $cities = App\City::where('province_id',$province)->orderBy('order_no','asc')->get();
        return view('cms.city.index', [
            'cities'=>$cities,
            'provinces'=>$provinces,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = App\Province::orderBy('order_no','asc')->get();
        return view('cms.city.create',[
            'provinces'=>$provinces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'province' => 'required|exists:provinces,id',
            'order_no' => 'required|numeric',
        ]);
        $city = new App\City();
        $city->title = $request->input('title');
        $city->province_id = $request->input('province');
        $city->order_no = $request->input('order_no');
        $city->save();
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = App\City::findOrFail($id);
        $provinces = App\Province::orderBy('order_no','asc')->get();
        return view('cms.city.edit',[
            'city'=>$city,
            'provinces'=>$provinces,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'province' => 'required|exists:provinces,id',
            'order_no' => 'required|numeric',
        ]);
        $city = App\City::findOrFail($id);
        $city->title = $request->input('title');
        $city->province_id = $request->input('province');
        $city->order_no = $request->input('order_no');
        $city->save();
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = App\Store::where('city_id',$id)->count();
        if($count > 0){
            return ['ret'=>1001,'msg'=>'城市下含有店铺,无法删除'];
        }
        else{
            App\City::destroy($id);
            return ['ret'=>0];
        }
    }
    //
    public function order(Request $request)
    {
        $order_no = json_decode($request->input('order_no'),true);
        foreach( $order_no as $k=>$v){
            $province = App\City::find($v['id']);
            $province->order_no = $k+1;
            $province->save();
        }
        return ['ret'=>0];
    }
}
