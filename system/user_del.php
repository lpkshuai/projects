<?php 
// 连接数据库
$link = mysqli_connect('localhost','root','lpk19961224','system');
// 设定字符集  
mysqli_set_charset($link ,'utf8');
//点击删除时通过GET传递id参数
$id = (int) $_GET['id'];
$sql_del = "delete from user where UId=($id)";
$result = mysqli_query($link, $sql_del);
if ($result) {
    echo '<script>alert("删除成功");location.href="user.php"</script>';
} else {
    echo '<script>alert("删除失败");location.href="user.php"</script>';
}