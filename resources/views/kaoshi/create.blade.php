<form action="adddiaoyan" method="post">
    @csrf
    调研项目：<input type="text" value="php常用技术调研" name="diaoyan">
    <input type="button" id="but" value="添加调研">

    <div class="dd1" style="display:none;">
        调研问题：<input type="text" value="你在公司使用的php框架是什么" ><br>
        问题选项：<input type="radio" name="wenti" value="1">单选 <input type="radio" name="wenti" value="2">复选 <br>
        <input type="button" class="but2" value="添加问题"><br>
    </div>
{{--    单选的情况--}}
    <div class="dd2" style="display:none;">
        你在公司使用的php框架是什么 <br>
        <input type="radio"  name="dan" value="laravel">：<input type="text" value="laravel"><br>
        <input type="radio"  name="dan" value="Yii2.0">：<input type="text" value="Yii2.0"><br>
        <input type="radio"  name="dan" value="thinkPHP">：<input type="text" value="thinkPHP"><br>
        <input type="radio"  name="dan" value="CI">：<input type="text" value="CI"><br>
        <input type="submit" value="保存信息">

    </div>
{{--    复选的情况--}}
    <div class="dd3" style="display:none;">
        你认为现在需要学习的技术是什么 <br>
        <input type="checkbox"  name="fu[]" value="直播技术">：<input type="text" value="直播技术"><br>
        <input type="checkbox"  name="fu[]" value="框架">：<input type="text" value="框架"><br>
        <input type="checkbox"  name="fu[]" value="API">：<input type="text" value="API"><br>
        <input type="checkbox"  name="fu[]" value="架构">：<input type="text" value="架构"><br>
        <input type="submit"  value="保存信息">
    </div>
</form>


<script src="/jquery-3.3.1.min.js"></script>
<script>
            $(function(){
                $('#but').click(function(){
                    $('.dd1').slideDown(2000);
                })

                $('.but2').click(function(){
                    var wenti = $("[name='wenti']:checked").val();
                    if(wenti == 1){
                        $('.dd2').slideDown(2000);
                        $('.dd3').slideUp(2000);
                    }else if(wenti == 2){
                        $('.dd3').slideDown(2000);
                        $('.dd2').slideUp(2000);
                    }else{
                        alert('有问题，重新选');
                        return false;
                    }
                })
            })
</script>