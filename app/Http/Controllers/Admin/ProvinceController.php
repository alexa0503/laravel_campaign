<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = App\Province::orderBy('order_no','asc')->get();
        return view('cms.province.index', [
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
        return view('cms.province.create');
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
            'order_no' => 'required|numeric',
        ]);
        $province = new App\Province();
        $province->title = $request->input('title');
        $province->order_no = $request->input('order_no');
        $province->save();
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
        $province = App\Province::findOrFail($id);
        return view('cms.province.edit',['province'=>$province]);

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
            'order_no' => 'required|numeric',
        ]);
        $province = App\Province::findOrFail($id);
        $province->title = $request->input('title');
        $province->order_no = $request->input('order_no');
        $province->save();
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
        $count = App\City::where('province_id',$id)->count();
        if($count > 0){
            return ['ret'=>1001,'msg'=>'省份下含有城市,无法删除'];
        }
        else{
            App\Province::destroy($id);
            return ['ret'=>0];
        }
    }
    //
    public function order(Request $request)
    {
        $order_no = json_decode($request->input('order_no'),true);
        foreach( $order_no as $k=>$v){
            $province = App\Province::find($v['id']);
            $province->order_no = $k+1;
            $province->save();
        }
        return ['ret'=>0];
    }
}
