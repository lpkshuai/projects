<?php
//链接数据库
$link = mysqli_connect('localhost', 'root', 'lpk19961224', 'system');
mysqli_set_charset($link, 'utf8');

$id = $_GET['id'];
// echo $tno;

$query = "delete from lab where Id=$id";
$result = mysqli_query($link, $query);
if ($result) {
    echo '<script>alert("删除成功");location.href="lab.php"</script>';
} else {
    echo '<script>alert("删除失败");location.href="lab.php"</script>';
}