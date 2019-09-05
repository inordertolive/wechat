<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KaoshiController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View前台展示页面
     */
    public function __construct()
    {
        $this->redis = new \redis();
        $this->redis->connect('127.0.0.1','6379');
    }

    public function index()
    {
        return view('kaoshi/index');
    }

    /**
     * 用户登录
     */
    public function login()
    {
        $data = request()->all();
//        dd($data);
        $date = DB::table('user1')->where('name',$data['name'])->first();
        if($date){
            if($date->pwd == $data['pwd']){
                $this->redis->set('loginuser',$data['name']);
                return redirect()->action('KaoshiController@create');
            }else{
                echo "<script>alert('密码错误');history.back(-1);</script>";
            }
        }else{
                echo "<script>alert('找不到该用户');history.back(-1);</script>";
        }
    }

    /**
     * 添加调研项目
     */
    public function create()
    {
            return view('kaoshi/create');
    }

    public function adddiaoyan()
    {
        $data = request()->all();
        unset($data['_token']);
        $res = DB::table('diaoyan')->insert($data);
        if($res){
            return redirect()->action('KaoshiController@list');
        }
    }
}
