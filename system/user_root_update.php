<?php 
// 连接数据库
$link = mysqli_connect('localhost','root','lpk19961224','system');
// 设定字符集  
mysqli_set_charset($link ,'utf8');
$username = $_POST['username'];
// echo $username;
// $id = (int) $_POST['id'];
if ($_POST['password'] || $_POST['userroot']) {
    $password = $_POST['password'];
    $userroot = $_POST['userroot'];
    
    // echo "$password";
    // echo "$userroot";
    //此处root是字符串类型，要用引号
    $query = "update user set password=$password,root='$userroot' where username = '$username'";
} else {
    echo '<script>alert("修改成功");location.href="user.php";</script>';
}
// echo "$query";
$result = mysqli_query($link, $query);
// var_dump($result);
if ($result) {
	echo '<script>alert("修改成功");location.href="user.php";</script>';
}
