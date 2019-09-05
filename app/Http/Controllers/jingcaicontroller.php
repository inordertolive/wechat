<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class jingcaicontroller extends Controller
{
    public function __construct()
    {
        $this->redis = new \redis();
        $this->redis->connect('127.0.0.1','6379');
        $this->res = $this->redis->get('loginuser');
        $this->ii = $this->redis->get('loginid');
    }

    public function index()
    {
        return view('jingcai/index');
    }
    public function addqiudui()
    {
        $data = request()->all();

        unset($data['_token']);
//        dd($data);
        if($data['qiudui1'] == $data['qiudui2']){
            echo "<script>alert('球队不能相同');history.back(-1);</script>";
            die;
        }
        $res = DB::table('qiudui')->insert($data);
        if($res){
            echo "<script>alert('竞猜添加成功');location.href='jingcailist';</script>";
        }else{
            echo "<script>alert('添加失败');history.back(-1);</script>";
        }
    }
    public function jingcailist()
    {
        $data = DB::table('qiudui')->get();
        $tt = date('H:i',time());
//        $res = $this->redis->get('loginuser');
        return view('jingcai/jingcailist',['data'=>$data,'tt'=>$tt,'res'=>$this->res]);
    }
    public function canyu(){
        $id = request()->get('id');
        $data = DB::table('qiudui')->where('id',$id)->first();
        return view('jingcai/canyulist',['data'=>$data]);
    }
    public function jingcaidd()
    {
        $id = request()->post('id');
        $qid = request()->post('qid');
        $lid = $this->redis->get('loginid');
        $data['q_id'] = $qid;
        $data['jieguo'] = $id;
        $data['lid'] = $lid;
        $res = DB::table('jingcai')->insert($data);
        if($res){
            echo json_encode(['fond'=>'竞猜成功','code'=>1]);
        }else{
            echo json_encode(['fond'=>'竞猜失败','code'=>2]);
        }
    }
    public function chengj()
    {
        $id = request()->get('id');
//        dd($this->ii);
        $data = DB::table('jingcai')->join('qiudui','jingcai.q_id','=','qiudui.id')->where('jingcai.lid',$this->ii)->where('jingcai.q_id',$id)->first();
//            dd($data);
        return view('jingcai/chengj',['dd'=>$data,'res'=>$this->res]);
    }
    public function kongzhi(){
        $id = request()->get('id');
        $data = DB::table('qiudui')->where('id',$id)->first();
        return view('jingcai/kongzhi',['data'=>$data]);
    }
    /**
     * 后台比赛控制
     */
    public function kongzhido()
    {
        $id = request()->post('id');
        $qid = request()->post('qid');
//        $data['q_id'] = $qid;
        $data['adjieguo'] = $id;

        $res = DB::table('jingcai')->where('q_id',$qid)->update($data);

        if($res){
            echo json_encode(['fond'=>'成功','code'=>1]);
        }else{
            echo json_encode(['fond'=>'失败','code'=>2]);
        }
    }
    public function login()
    {
        return view('jingcai/login');
    }
    public function logindo()
    {
        $data = request()->all();
        $res = DB::table('qiuduiadmin')->where('user',$data['user'])->first();
        if($res){
                //数据库有值时
            if($data['pwd'] == $res->pwd){
                //密码正确
                $data['loginuser'] = $res->user;
                $this->redis->set('loginuser',$res->user);
                $this->redis->set('loginid',$res->id);
//                $rr = DB::table()->where()->update();
                echo "<script>alert('登录成功，本页面不会自动跳转，请点击确定');location.href='jingcailist'</script>";

            }else{
                echo "<script>alert('密码错误');location.href='login'</script>";
            }
        }else{
            echo "<script>alert('数据库找不到该用户，请确认用户名是否正确');location.href='login'</script>";
        }
    }

    public function init()
    {
        dd($this->redis->get('loginid'));
    }
    public function outlogin()
    {
        $res1 = $this->redis->delete('loginuser');
        $res2 = $this->redis->delete('loginid');
        if($res1 && $res2){
            echo "<script>alert('推出成功');location.href='jingcailist'</script>";
        }
    }
}
