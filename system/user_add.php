<?php
// 连接数据库
$link = mysqli_connect('localhost','root','lpk19961224','system');
// 设定字符集  
mysqli_set_charset($link ,'utf8');
//此处加@目的是屏蔽报错信息
@$id = (int) $_POST['id'];
$name=$_POST['addname'];
$pwd=$_POST['addpassword'];
$pwdconfirm=$_POST['addpassword2'];
$adduserroot=$_POST['addusergroup'];
if($name==''){
    echo"<script>alert('你的用户名不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($pwd==''){
    echo"<script>alert('你的密码不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($pwd != $pwdconfirm){
    echo"<script>alert('你输入的两次密码不一致，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
$query = "insert into user(username,password,root)values('$name', $pwd, '$adduserroot')";
$query_select = "select * from user where username='$name'";

$result_select = mysqli_query($link, $query_select);

// var_dump($result);
if(mysqli_fetch_assoc($result_select)){
    echo "<script>alert('您输入的用户名已存在,请重新输入！');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}else{
	$result = mysqli_query($link, $query);
    echo "<script>alert('您已添加成功');location.href='user.php';</script>";
    exit;
}