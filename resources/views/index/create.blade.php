<html>
<head>
    <title>考试添加</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{url('addad')}}" method="post" enctype="multipart/form-data">
@csrf

<table border="1" cellpadding="0">
    <tr>
        <td>文章标题</td>
        <td><input name="name" id="name" type="text" ></td>
    </tr>
    <tr>
        <td>文章分类</td>
        <td>
            <select name="cate" id="">
                <option value="1">手机促销</option>
                <option value="2">3g咨询</option>
                <option value="3">站内快讯</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>文章重要性 </td>
        <td>
            <input type="radio"  name="state" value="1">普通
            <input type="radio" name="state" value="2">置顶
        </td>
    </tr>
    <tr>
        <td>是否显示</td>
        <td>
            <input value="1" class="" name="imp" type="radio">显示
            <input value="2" name="imp" type="radio">不显示
        </td>
    </tr>
    <tr>
        <td>文章作者</td>
        <td><input name="zuozhe" id="zuozhe" type="text"></td>
    </tr>
    <tr>
        <td>作者email</td>
        <td><input name="zuoemail" id="zuoemail" type="text"></td>
    </tr>
    <tr>
        <td>关键字</td>
        <td><input name="guanjian" id="guanjian" type="text"></td>
    </tr>
    <tr>
        <td>网页描述</td>
        <td><textarea name="read" id="read" cols="30" rows="10"></textarea></td>
    </tr>
    <tr>
        <td>上传文件</td>
        <td><input type="file" id="img" name="img"></td>
    </tr>
    <tr>
        <td><input type="submit" id="1sub" value="确定"></td>
        <td><input type="reset" value="重置"></td>
    </tr>

</table>
</form>
</body>
</html>
<script src="/jquery-3.3.1.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('#sub').click(function(){
            var name = $('#name').val();   //获取文章标题值
            var zuozhe = $('#zuozhe').val();   //获取文章标题值
            var zuoemail = $('#zuoemail').val();   //获取文章作者
            var guanjian = $('#guanjian').val();
            var read = $('#read').val();
            var cate = $("select").val();   //获取文章分类值
            var state = $('input[name="state"]:checked').val();   //文章重要性
            var imp = $('input[name="imp"]:checked').val();   //是否显示
            var status = true;
            var tt = /^[0-9a-zA-Z_\u4e00-\u9fa5]+$/;
                if(name == ''){
                    alert('文章标题不能为空');
                    status =  false;
                }else if(cate == undefined){
                    alert('文章分类为必选');
                    status = false;
                }else if(state == null){
                    alert('文章重要性为必选');
                    status = false;
                }else if(imp == null){
                    alert('请选择文章是否显示');
                    status =  false;
                }else if(!tt.test(name)){
                    alert('文章标题必须为汉字，请重新输入');
                    status = false;
                }else{
                    $.ajax({
                        data:{name:name},
                        async:false,
                        type:'post',
                        dataType:'json',
                        url:"check",
                        success:function(msg){
                            if(msg == 0){
                                status = true;
                            }else{
                                alert('数据库重复，请重新输入');
                                status = false;
                            }
                        }
                    })
                }
                if(status == false){
                    return false;
                }
        })
    })
</script>