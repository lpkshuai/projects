<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>计算规则</title>
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
					<li class="active"><a href="rules.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
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
				 	<a href="rules.php" class="list-group-item">查询计算规则</a>
				 	<a href="rules_change.php" class="list-group-item active">修改计算规则</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>计算规则</h1>
				</div>
				<ul class="nav nav-tabs">
					<li><a href="rules.php">查询计算规则</a></li>
					<li class="active"><a href="rules_change.php">修改计算规则</a></li>
				</ul>
				<h3>计算规则修改</h3>
				<div class="alert alert-info alert-dismissible" role="alert">
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  	<strong>注意：</strong>（1）P1,P2,P3参数类型为整数；（2）其他参数类型为小数。
				</div>
				<form action="rules_update.php" method="post">
					<div class="form-group">
						<label for="choose">选择系数</label>
						<select name="coefficient" class="form-control">
							<option value="p1">P1</option>
							<option value="p2">P2</option>
							<option value="p3">P3</option>
							<option value="c1">C1</option>
							<option value="c2">C2</option>
							<option value="c3">C3</option>
							<option value="s1_ts">S1_ts</option>
							<option value="s1_kf">S1_kf</option>
							<option value="s1_qt">S1_qt</option>
							<option value="s2">S2</option>
							<option value="s3_1">S3_1</option>
							<option value="s3_2">S3_2</option>
							<option value="s3_3">S3_3</option>
							<option value="s3_4">S3_4</option>
						</select>
					</div>
					<div class="form-group">
						<label>修改值</label>
						<input type="text" name="newvalue" class="form-control" placeholder="请输入修改后的值">
					</div>
					<div class="form-group col-md-2 pull-right">
						<button type="submit" class="form-control btn btn-primary">提交</button>
					</div>
					
				</form>
				
				
			</div>
		</div>
	</div>
	<!-- 用户管理 -->
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