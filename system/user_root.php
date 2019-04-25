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
				 	<a href="user.php" class="list-group-item">用户列表</a>
				 	<a href="user_root.php" class="list-group-item active">修改权限</a>
				 	<a role="button" class="list-group-item" data-toggle="modal" data-target="#myModal">添加用户</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>用户管理</h1>
				</div>
				<ul class="nav nav-tabs">
					<li><a href="user.php">用户列表</a></li>
					<li class="active"><a href="user_root.php">修改权限</a></li>
					<li><a role="button" data-toggle="modal" data-target="#myModal">添加用户</a></li>
				</ul>
				<?php 
				// 连接数据库
				$link = mysqli_connect('localhost','root','lpk19961224','system');
				// 设定字符集  
				mysqli_set_charset($link ,'utf8');
				//此处加@目的是屏蔽报错信息（因为直接打开此项没有id传入，所以会报错）
				@$id = (int) $_GET['id'];
				$sql = "select username from user where UId = $id";
				$result = mysqli_query($link, $sql);
				$data = mysqli_fetch_assoc($result);
				// print_r($data);
				?>
				<form action="user_root_update.php" method="post">
					<div class="form-group">
						<label for="name">用户名</label>
						<input type="text" name="username" class="form-control" placeholder="请输入用户名" value="<?php echo $data['username'];?>">
						<!-- <input type="hidden" value="<?php echo $data['UId'];?>" name="id" /> -->
					</div>
					<div class="form-group">
						<label for="password">用户密码</label>
						<input type="password" name="password" class="form-control" placeholder="请输入修改后的用户密码">
					</div>
					<div class="form-group">
						<label for="userroot">用户权限</label>
						<select name="userroot" class="form-control">
							<option value="普通用户">普通用户</option>
							<option value="管理员">管理员</option>
						</select>
					</div>
					<div class="form-group col-md-2 pull-right">
						<button type="submit" class="form-control btn btn-primary">提交</button>
					</div>
				</form>
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