<?php

namespace App\Http\Middleware;

use Closure;

class userligin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $res = $redis->get('loginuser');

        if($res == false){
            echo "<script>alert('您还没登录，请先登录');location.href='login'</script>";
            die;
        }
        return $next($request);
    }
}
