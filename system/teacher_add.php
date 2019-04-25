<?php 
//链接数据库
$link = mysqli_connect('localhost', 'root', 'lpk19961224', 'system');
mysqli_set_charset($link, 'utf8');
//获取数据
$tno = $_POST['tno'];
$tname = $_POST['tname'];
$bm = $_POST['tbm'];
$gw = $_POST['tgw'];
if($tno==''){
    echo"<script>alert('你的工号不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($tname==''){
    echo"<script>alert('你的姓名不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
if($bm==''){
    echo"<script>alert('你的部门不能为空，请重新输入');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
$query = "insert into teacher(tno,t_name,BM,GW) values('$tno','$tname','$bm','$gw')";
$sql = "select * from teacher where t_name='$tname'";

$result_sql = mysqli_query($link, $sql);
if(mysqli_fetch_assoc($result_sql)){
    echo "<script>alert('您输入的教师已存在,请重新输入！');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}else{
	$result = mysqli_query($link, $query);
    echo "<script>alert('您已添加成功');location.href='other.php';</script>";
    exit;
}