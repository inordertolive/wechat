<style>
    *{
        list-style:none;
    }
    .page-link{
        border:0; margin:8; padding:8; font-size:8px;  /* savers */ float:left;
        border:solid 1px blur; margin-right:2px; color:green;
    }
    a{
        text-decoration:none;
    }
</style>
<form action="{{url('12306/index')}}" method="get">
    <input type="text" name="start" value="{{$start}}">出发地
    <input type="text" name="out" value="{{$out}}">到达地
    <input type="submit" value="搜索">
    <input type="reset" value="重置">
</form>
<table border="1">
    搜索次数{{$num}}
    <tr align="center">
        <td>出发地</td>
        <td>到达地</td>
        <td>价格</td>
        <td>张数</td>
        <td></td>
    </tr>
@foreach($data as $dd)
    <tr>
        <td width="100" align="center">{{$dd->start}}</td>
        <td width="100" align="center">{{$dd->out}}</td>
        <td width="100" align="center">{{$dd->money}}</td>
        <td width="100" align="center" class="num" num="{{$dd->num}}">
    @if($dd->num <= 100)
        无票
    @else
        有票
    @endif
        </td>
        <td width="100" align="center"><button class="but" >预定</button></td>
    </tr>
@endforeach
</table>

<script src="/jquery-3.3.1.min.js"></script>
<script>
        $(function(){
            $('.num').each(function(){
                var num = $(this).attr('num');
                console.log(num);
                if(num == 0){
                    $(this).next().find('.but').attr('disabled',true);
                }else{
                    $(this).next().find('.but').attr('disabled',false);

                }
            });

        })
</script>