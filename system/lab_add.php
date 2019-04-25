<?php 
//链接数据库
$link = mysqli_connect('localhost', 'root', 'lpk19961224', 'system');
mysqli_set_charset($link, 'utf8');
//获取数据
$labname = $_POST['labname'];
$computer = $_POST['computer'];
if($labname==''){
    echo"<script>alert('你的机房名不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
$query = "insert into lab(lab_name,computer) values('$labname','$computer')";
$sql = "select * from lab where lab_name='$labname'";

$result_sql = mysqli_query($link, $sql);
if(mysqli_fetch_assoc($result_sql)){
    echo "<script>alert('您输入的机房已存在,请重新输入！');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}else{
	$result = mysqli_query($link, $query);
    echo "<script>alert('您已添加成功');location.href='lab.php';</script>";
    exit;
}