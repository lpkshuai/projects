<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','lpk19961224','system');  //连接数据库
 mysqli_set_charset($link ,'utf8'); //设定字符集 

$name=$_POST['username'];

$pwd=$_POST['password'];

    if($name==''){
        echo "<script>alert('请输入用户名');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;
    }
    if($pwd==''){

        echo "<script>alert('请输入密码');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;

    }


    $sql_select="select Uid,username,password,root from user where username= ?";      //从数据库查询信息
    $stmt=mysqli_prepare($link,$sql_select);
    mysqli_stmt_bind_param($stmt,'s',$name);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($result);

    if($row){

        if($pwd !=$row['password'] || $name !=$row['username']){

            echo "<script>alert('密码错误，请重新输入');location.href='login.html'</script>";
            exit;
        }
        else{
            $_SESSION['username']=$row['username'];
            $_SESSION['id']=$row['Uid'];
            if ($row['root']=='管理员') {
                echo "<script>alert('登录成功，您是管理员');location.href='index.html'</script>";
            } else {
                echo "<script>alert('登录成功，您是普通用户');location.href='index2.html'</script>";
            } 
        }

    }else{
        echo "<script>alert('您输入的用户名不存在');location.href='login.html'</script>";
        exit;
    };