<div align="center"  style="border:1px dashed#000 ">
    @if($res)
       当前登录用户：<b style="color:red;"> {{$res}}!!!</b><button class="outlogin">退出登录</button>
    @else
        还未登录哟！！
    @endif

    <h3>竞猜列表</h3>
    <a href="{{url('index')}}">返回添加比赛</a>
{{--    <span><b></b>VS <b></b></span>  <button>1</button><br><br>--}}
    <table>

@foreach($data as $d)
        <tr>
            <td><h5>{{$d->qiudui1}}</h5></td>
            <td><h4>VS</h4></td>
            <td><h5>{{$d->qiudui2}}</h5></td>
            <td>
            @if($tt > $d->outtime)
                <button class="but" id="{{$d->id}}">查看结果</button>
            @else
                <button class="but1" id="{{$d->id}}">参与竞猜</button>
            @endif
            </td>
            <td><button class="but2" id="{{$d->id}}">控制该场比赛</button></td>
        </tr>
@endforeach
    </table>



</div>
<script src="/jquery-3.3.1.min.js"></script>
<script>
    $(function(){
        $('.but1').click(function(){
            var id = $(this).attr('id');
            location.href="{{url('canyu')}}?id="+id;
        })
        $('.but').click(function(){
            var id = $(this).attr('id');
            location.href="{{url('chengj')}}?id="+id;
        })
        $('.but2').click(function(){
            var id = $(this).attr('id');
            location.href="{{url('kongzhi')}}?id="+id;
        })

    })
        $('.outlogin').click(function(){
                location.href='outlogin';
        })

</script>