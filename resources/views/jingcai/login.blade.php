<form action="logindo" method="post">
    @csrf
    <h3>登录</h3>
    账号<input type="text" value="" name="user"><br>
    密码 <input type="password" value="" name="pwd"><br>
    <input type="submit" value="登录">
</form>