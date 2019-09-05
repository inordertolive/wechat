<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TrainController extends Controller
{
     public function __construct()
{
    $this->redis = new \Redis();
    $this->redis->connect('127.0.0.1','6379');
}
    public function index()
    {
        $start = request()->get('start');   //出发地
        $out = request()->get('out');       //到达地
        $where = [];
        if($start or $out){
                $this->redis->incr('adminnum');
        $start = $start??'';
        $out = $out??'';
            if($start){
                $where[] = [
                    'start','like',"%$start%"
                ];
            };
            if($out){
                $where[] = [
                    'out','like',"%$out%"
                ];
            };
        $num = $this->redis->get('adminnum');    //获取搜索次数
        $data = DB::table('adminp')->where($where)->get();
            if($num == 5){
                $this->redis->set('data',"$data");
            }
            if($num > 5){
                $data = $this->redis->get('data');
                $data = json_decode($data);
            }
        }else{
            $data = DB::table('adminp')->get();
            $num = $this->redis->get('adminnum');    //获取搜索次数
        }
        return view('train/index',['data'=>$data,'num'=>$num,'start'=>$start,'out'=>$out]);
    }
    /**
     * 清空redis
     */
    public function init(){
        $this->redis->delete('adminnum');
    }
    public function adddiaoyan()
    {
        $data = request()->all();
        dd($data);
    }


}
