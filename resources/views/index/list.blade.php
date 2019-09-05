
        <table border="1">
            <tr>
                <td>编号</td>
                <td>文章标题</td>
                <td>文章分类</td>
                <td>文章重要性</td>
                <td>是否显示</td>
                <td>添加日期</td>
                <td>显示图片</td>
                <td>操作</td>
            </tr>
@foreach($data as $dd)
            <tr>
                <td>{{$dd->id}}</td>
                <td>{{$dd->name}}</td>
                <td>
            @if($dd->cate == 1)
                    手机促销
            @elseif($dd->cate == 2)
                    3G咨询
            @else
                    站内快讯
            @endif
                </td>
                <td>
            @if($dd->imp == 1)
                普通
            @elseif($dd->imp == 2)
                置顶
            @endif
                </td>
                <td>
            @if($dd->state == 1)
                👍
            @elseif($dd->state == 2)
                ❌
            @endif
                </td>
                <td>
                    {{date('Y-m-d H:i:s' , $dd->add_time)}}
                </td>
                <td><img width="80px" height="50px" src="{{asset('storage').'/'.$dd->img}}" alt=""></td>
                <td>
                    <a href="{{url('delete')}}?id="{{$dd->id}}>❎</a> <!--删除-->
                    <a href="{{url('update')}}?id="{{$dd->id}}>📃</a> <!--修改-->
                </td>
            </tr>
@endforeach
        </table>