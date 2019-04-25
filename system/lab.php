<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>其它管理</title>
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
					<li><a href="user.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a></li>
					<li><a href="content.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
					<li><a href="rules.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
					<li class="active"><a href="other.php"><span class="glyphicon glyphicon-menu-hamburger"></span>&nbsp;&nbsp;其它管理</a></li>
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
	<!-- 数据统计等内容 -->
	<div class="container">
		<div class="row">
			<!-- 左侧列表导航 -->
			<div class="col-md-2">
				 <div class="list-group">
				 	<a href="other.php" class="list-group-item">教师信息管理</a>
				 	<a role="button" class="list-group-item" data-toggle="modal" data-target="#myModal">添加教师</a>
				 	<a href="lab.php" class="list-group-item active">机房管理</a>
				 	<a role="button" class="list-group-item" data-toggle="modal" data-target="#myModal2">添加机房</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>其他项信息修改</h1>
				</div>
				<ul class="nav nav-tabs">
					<li><a href="other.php">教师信息管理</a></li>
					<li><a role="button" data-toggle="modal" data-target="#myModal">添加教师</a></li>
					<li class="active"><a href="lab.php">机房管理</a></li>
					<li><a role="button" data-toggle="modal" data-target="#myModal">添加机房</a></li>
				</ul>

				<?php 
				// 连接数据库
				$link = mysqli_connect('localhost','root','lpk19961224','system');
				// 设定字符集  
				mysqli_set_charset($link ,'utf8');
				$query = "select * from lab";
				$result = mysqli_query($link, $query);
				?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>机房名称</th>
							<th>计算机房</th>
							<th>删除</th>
						</tr>
					</thead>
					<tbody>
						<?php
							header("Content-type:text/html;charset=utf-8");	 
							while($row = mysqli_fetch_assoc($result)){
								//定界符方法：
								echo <<<EOD
								<tr>
							    <td>{$row['Id']}</td>
							    <td>{$row['lab_name']}</td>
							    <td>{$row['computer']}</td>
							    <td>
EOD;
								echo '<a class="btn btn-primary" href="lab_del.php?id='.$row['Id'].'">删除</a>';
								echo '</td>';
							 }
						?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">添加教师</h4>
				</div>
				<form action="teacher_add.php" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="tno">教师工号</label>
							<input type="text" name="tno" class="form-control" placeholder="请输入教师工号">
						</div>
						<div class="form-group">
							<label for="tname">教师姓名</label>
							<input type="text" name="tname" class="form-control" placeholder="请输入教师姓名">
						</div>
						<div class="form-group">
							<label for="tbm">教师部门</label>
							<input type="text" name="tbm" class="form-control" placeholder="请输入教师部门" value="信息工程院">
						</div>
						<div class="form-group">
							<label for="tgw">岗位类别</label>
							<select name="tgw" class="form-control">
								<option value="01/在职人员">01/在职人员</option>
								<option value="02/离退人员">02/离退人员</option>
								<option value="03/校聘人员">03/校聘人员</option>
								<option value="04/人事代理">04/人事代理</option>
								<option value="05/部门聘用">05/部门聘用</option>
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
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">添加机房</h4>
				</div>
				<form action="lab_add.php" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="labname">机房名称</label>
							<input type="text" name="labname" class="form-control" placeholder="请输入机房名称">
						</div>
						<div class="form-group">
							<label for="computer">是否为计算机房</label>
							<select name="computer" class="form-control">
								<option value="是">是</option>
								<option value="否">否</option>
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