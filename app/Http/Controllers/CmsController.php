<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
//use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.dashboard');
    }


    /**
     * 账户管理
     */
    public function users($openid =null)
    {
        if( null != $openid){
            $users = DB::table('users')->where('openid',$openid)->paginate(20);
        }
        else{
            $users = DB::table('users')->paginate(20);
        }
        return view('cms.users', ['users' => $users]);
    }
    public function voices($id = null)
    {
        if( null != $id){
            $voices = DB::table('voice')->where('voice_id',$id)->paginate(20);
        }
        else{
            $voices = DB::table('voice')
            ->join('users','voice.user_openid', '=', 'users.openid')
            ->paginate(20);
        }
        return view('cms.voices', ['voices' => $voices]);
    }
    public function destroyVoice($id)
    {
        DB::table('voice')->where('id',$id)->delete();

        return ['ret' => 0, 'msg' => ''];
    }
    public function infos()
    {
        $infos = DB::table('infos')->paginate(20);
        return view('cms.infos', ['infos' => $infos]);
    }
    public function likes()
    {
        $likes = DB::table('likes')->paginate(20);
        return view('cms.likes', ['likes' => $likes]);
    }
    /**
     *账户管理
     */
    public function account()
    {
        return view('cms.account');
    }
    public function accountPost(Requests\AccountFormRequest $request)
    {
        //var_dump($request->user()->id);
        $user = \App\User::find($request->user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('cms.logout');
        //var_dump($request->input('password'));
    }
    public function userLogs()
    {
        return;
    }
}
