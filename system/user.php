<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>用户管理</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<!-- 导航 -->
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- 小屏幕导航按钮和logo -->
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.html" class="navbar-brand">工作量计算系统</a>
			</div>
			<!-- 小屏幕导航按钮和logo -->
			<!-- 导航 -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;系统首页</a></li>
					<li class="active"><a href="user.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a></li>
					<li><a href="content.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
					<li><a href="rules.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
					<li><a href="other.php"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;&nbsp;其它管理</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expended="false">
							管理员
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="index.html"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;系统首页</a></li>
							<li><a href="user.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a></li>
							<li><a href="content.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
							<li><a href="rules.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
							<li><a href="other.php"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;&nbsp;其它管理</a></li>
						</ul>
					</li>
					<li><a href="login.html"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;退出</a></li>
				</ul>
			</div>
			<!-- 导航 -->
		</div>
	</nav>
	<!-- 导航 -->
	<!-- 用户管理 -->
	<div class="container">
		<div class="row">
			<!-- 左侧列表导航 -->
			<div class="col-md-2">
				 <div class="list-group">
				 	<a href="user.php" class="list-group-item active">用户列表</a>
				 	<a href="user_root.php" class="list-group-item">修改权限</a>
				 	<a role="button" class="list-group-item" data-toggle="modal" data-target="#myModal">添加用户</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>用户管理</h1>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="user.php">用户列表</a></li>
					<li><a href="user_root.php">修改权限</a></li>
					<li><a role="button" data-toggle="modal" data-target="#myModal">添加用户</a></li>
				</ul>
				<table class="table table-striped">
						<?php 
							// 连接数据库
							$link = mysqli_connect('localhost','root','lpk19961224','system');
							// 设定字符集  
							mysqli_set_charset($link ,'utf8');  

							// 得到总的用户数
							$sql_count = "select count(UId) as c from user";
							$sql_result2 = mysqli_query($link, $sql_count); 
							$data = mysqli_fetch_assoc($sql_result2);
							$count = $data['c'];
							// echo "$count";

							// 传入页码
							$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
							// if (isset($_GET['page'])) {
							//  $page = (int) $_GET['page'];
							// } else {
							//  $page = 1;
							// }

							// 每页显示数
							$num = 10;
							// 得到总页数
							$total_page = ceil($count / $num);
							if ($page <= 1) {
								$page = 1;
							}
							if ($page >= $total_page) {
								$page = $total_page;
							}
							$offset = ($page - 1) * $num;

							// 根据页码取出数据(此处有一个问题，limit后没有空格会报错)
							$sql_select="select * from user limit ".$offset.",$num";
							$sql_result1 = mysqli_query($link, $sql_select);
						?>
						<thead>
						<tr>
							<th>ID</th>
							<th>用户名</th>
							<th>权限</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php
							header("Content-type:text/html;charset=utf-8");	 
							while($row = mysqli_fetch_assoc($sql_result1)){
								//定界符方法：
								echo <<<EOD
								<tr>
							    <th>{$row['UId']}</th>
							    <td>{$row['username']}</td>
							    <td>{$row['root']}</td>
							    <td>
									<div role="presentation" class="dropdown">

										<button href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											操作
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
EOD;
										echo '<li><a href="user_del.php?id='.$row['UId'].'">删除用户</a></li>';
										echo '<li><a href="user_root.php?id='.$row['UId'].'">修改权限</a></li>';
								echo <<<EOD
										</ul>
									</div>
								</td>
EOD;
							 }
						?>
						
					</tbody>
				</table>
				<nav class="pull-right">
				<?php
// 				echo <<<EOD
// 					<ul class="pagination">
// 						<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
// 						<li class="active"><a href="?page=1">1</a></li>
// 						<li><a href="?page=2">2</a></li>
// 						<li><a href="?page=3">3</a></li>
// 						<li><a href="?page=4">4</a></li>
// 						<li><a href="?page=5">5</a></li>
// 						<li><a href="?page=6">6</a></li>
// 						<li><a href="?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>
// 					</ul>
// EOD;
					echo '<ul class="pagination">';
					echo '<li><a href="?page='.($page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
						
					for ($i=1; $i <= $total_page; $i++) { 
						echo '<li><a href="?page='."$i".'">'."$i".'</a></li>';
					}
					echo '<li><a href="?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
					echo '</ul>';
					echo '<ul class="pagination pull-right">';
					echo '<li style="line-height: 34px;" class="active">&#12288;当前页：&nbsp;<span class="pull-right">'.$page.'</span></li>';
					echo '</ul>';
				 ?>	
				</nav>
			</div>
		</div>
	</div>
	<!-- 用户管理 -->
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">添加用户</h4>
				</div>
				<form action="user_add.php" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="addname">用户名</label>
							<input type="text" name="addname" class="form-control" placeholder="请输入用户名">
						</div>
						<div class="form-group">
							<label for="addpassword">用户密码</label>
							<input type="password" name="addpassword" class="form-control" placeholder="请输入用户密码">
						</div>
						<div class="form-group">
							<label for="addpassword">确认密码</label>
							<input type="password" name="addpassword2" class="form-control" placeholder="请确认用户密码">
						</div>
						<div class="form-group">
							<label for="addusergroup">所属用户组</label>
							<select name="addusergroup" class="form-control">
								<option value="普通用户">普通用户</option>
								<option value="管理员">管理员</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<button type="submit" class="btn btn-primary">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<!-- footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>信息工程学院实验教学工作量计算系统</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- footer -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>