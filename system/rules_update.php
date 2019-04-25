<?php 
// 连接数据库
$link = mysqli_connect('localhost','root','lpk19961224','system');
// 设定字符集  
mysqli_set_charset($link ,'utf8');

$coefficient = $_POST['coefficient'];

if ($_POST['newvalue']) {
	$newvalue = $_POST['newvalue'];
	$query = "update rule set $coefficient=$newvalue";
}else{
	echo '<script>alert("请填写修改后的值");location.href="rule_change.php";</script>';
}
$result = mysqli_query($link, $query);
if ($result) {
	echo '<script>alert("修改成功");location.href="rules.php";</script>';
}
