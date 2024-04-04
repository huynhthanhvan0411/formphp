<?php
// error
//<!--1. chưa định nghĩa biến lần đầu sẽ báo lỗi khi chạy -->

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = $_REQUEST['username'] ;
    $password = $_REQUEST['password'];
    echo "username" . $_REQUEST['username'] . "<br>";
    echo "password" . $_REQUEST['password'] . "<br>";
}
?>
<html>

<head>

</head>

<body>
    <form action="" method="POST">
        Username:
        <br>
        <input type="text" name="username" id="username"><br>
        E-password:
        <br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>