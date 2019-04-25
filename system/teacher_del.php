<?php
//链接数据库
$link = mysqli_connect('localhost', 'root', 'lpk19961224', 'system');
mysqli_set_charset($link, 'utf8');

$tno = $_GET['tno'];
// echo $tno;

$query = "delete from teacher where tno=$tno";
$result = mysqli_query($link, $query);
if ($result) {
    echo '<script>alert("删除成功");location.href="other.php"</script>';
} else {
    echo '<script>alert("删除失败");location.href="other.php"</script>';
}
