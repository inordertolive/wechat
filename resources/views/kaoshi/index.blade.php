<form action="login" method="post">
    @csrf
    账号 <input type="text" name="name"><br>
    密码 <input type="text" name="pwd"><br>
    <input type="submit" value="登录">
</form>