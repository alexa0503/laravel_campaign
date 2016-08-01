<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = $request->input('city');
        $province = $request->input('province');
        $provinces = App\Province::orderBy('order_no','asc')->get();
        $cities = App\City::where('province_id',$province)->orderBy('order_no','asc')->get();
        return view('cms.store.index', [
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
        return view('cms.store.create',[
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
            'address' => 'required|max:200',
            'city' => 'required|exists:cities,id',
            'order_no' => 'required|numeric',
        ]);
        $store = new App\Store();
        $store->title = $request->input('title');
        $store->address = $request->input('address');
        $store->city_id = $request->input('city');
        $store->order_no = $request->input('order_no');
        $store->save();
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
        $store = App\Store::findOrFail($id);
        return view('cms.store.edit',[
            'store'=>$store,
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
            'address' => 'required|max:200',
            'city' => 'required|exists:cities,id',
            'order_no' => 'required|numeric',
        ]);
        $store = App\Store::findOrFail($id);
        $store->title = $request->input('title');
        $store->address = $request->input('address');
        $store->city_id = $request->input('city');
        $store->order_no = $request->input('order_no');
        $store->save();
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
        App\Store::destroy($id);
        return ['ret'=>0,'msg'=>''];
    }
}
