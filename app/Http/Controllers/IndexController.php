<?php


namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 返回一个视图页面，添加
     */
    public function create()
    {
        return view('index/create');
    }
    /*
     * 检查标题是否重复
     */
    public function check()
    {
        $name = request()->post('name');
        // dd($name);
        $res = DB::table('kaoshi')->where('name',$name)->count();
        echo $res;

    }
    public function addad(Request $request)
    {
        $data = request()->all();
            $request->validate(
                [
                    'name' => 'required|unique:kaoshi',                    ///\p{Han}/u    |regex:/^[0-9a-zA-Z_\u4e00-\u9fa5]+$/
                    'cate' => 'required',
                    'state' => 'required',
                    'imp' => 'required',
                ],
                [
                    'name.required' => '文章标题不能为空',
//                    'name.alpha_dash' => '标题必须为汉字,数字，字母，以及下划线',
                    'name.unique' => '数据库已存在',
//                    'name.regex' => '标题必须为汉字,数字，字母，以及下划线',
                    'cate.required' => '文章分类必选',
                    'state.required' => '文章重要性必选',
                    'imp.required' => '是否显示必选',
                ]
            );
            $path = $request->file('img')->store('images');
            $data['img'] = $path;
            $data['add_time'] = time();
            unset($data['_token']);
//            dump($data);
            $res = DB::table('kaoshi')->insert($data);
            if($res){
                echo "<script>alert('添加成功');window.location.href='list'</script>";
            }else{
                echo "<script>alert('添加失败');history.back(-1)</script>";
            }
    }
    public function list()
    {
        $data = DB::table('kaoshi')->get();
//        dump($data);
        return view('index/list',['data'=>$data]);
    }

}