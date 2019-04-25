<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>统计报表</title>
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
				<a href="index2.html" class="navbar-brand">工作量计算系统</a>
			</div>
			<!-- 小屏幕导航按钮和logo -->
			<!-- 导航 -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index2.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;系统首页</a></li>
					<li class="active"><a href="content2.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
					<li><a href="rules2.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expended="false">
							普通用户
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="index2.html"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;系统首页</a></li>
							<li><a href="content2.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
							<li><a href="rules2.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
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
				 	<a href="content2.php" class="list-group-item active">查询工作量</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>个人工作量统计</h1>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="content2.php">查询工作量</a></li>
				</ul>
				<h4>请先选择要查询的学期</h4>
				<div class="alert alert-info alert-dismissible" role="alert">
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  	<strong>注意：</strong>如果某项查询数据内容不全，请联系管理员检查您的信息是否添加到教师信息表。<u>查询前请确保已经完成计算</u>
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="form-group col-md-10">
						<!-- <select name="term" class="form-control">
							<option value="results_16_17_2">16-17-2</option>
							<option value="results_17_18_1">17-18-1</option>
							<option value="results_17_18_1">学年</option>
							<option value="results_17_18_2">17-18-2</option>
							<option value="results_18_19_1">18-19-1</option>
							<option value="results_18_19_2">18-19-2</option>
							<option value="results_19_20_1">19-20-1</option>
						</select> -->
						<input type="text" class="form-control" placeholder="请输入您的姓名" name="search_name">
					</div>
					<div class="form-group col-md-2 pull-right">
						<button type="submit" class="form-control btn btn-primary">查询</button>
					</div>
				</form>
				<table class="table table-striped" id="datatable">
						<?php 
							// 连接数据库
							$link = mysqli_connect('localhost','root','lpk19961224','system');
							// 设定字符集  
							mysqli_set_charset($link ,'utf8');
							error_reporting(E_ALL & ~E_NOTICE);
							if (isset($_POST['search_name'])) {
								$name = $_POST['search_name'];
								$sql_16_17_2 = "select XQ,KCDW,JS,GH,JSBM,JSGW,round(sum(GZL),2) as total from results_16_17_2 where JS='$name' group by GH";
								$sql_17_18_1 = "select XQ,KCDW,JS,GH,JSBM,JSGW,round(sum(GZL),2) as total from results_17_18_1 where JS='$name' group by GH";
								$sql_17_18_2 = "select XQ,KCDW,JS,GH,JSBM,JSGW,round(sum(GZL),2) as total from results_17_18_2 where JS='$name' group by GH";
								$sql_18_19_1 = "select XQ,KCDW,JS,GH,JSBM,JSGW,round(sum(GZL),2) as total from results_18_19_1 where JS='$name' group by GH";
								$result_16_17_2 = mysqli_query($link, $sql_16_17_2);
								$result_17_18_1 = mysqli_query($link, $sql_17_18_1);
								$result_17_18_2 = mysqli_query($link, $sql_17_18_2);
								$result_18_19_1 = mysqli_query($link, $sql_18_19_1);
							}
						?>
						<thead>
						<tr>
							<th>学期</th>
							<th>课程单位</th>
							<th>教师姓名</th>
							<th>教师工号</th>
							<th>教师部门</th>
							<th>教师岗位</th>
							<th>工作量</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							if ($result_16_17_2) {
								$row = mysqli_fetch_assoc($result_16_17_2);
								//定界符方法：
								echo <<<EOD
								<tr>
								<td>{$row['XQ']}</td>
								<td>{$row['KCDW']}</td>
								<td>{$row['JS']}</td>
								<td>{$row['GH']}</td>
								<td>{$row['JSBM']}</td>
								<td>{$row['JSGW']}</td>
								<td>{$row['total']}</td>
								</tr>
EOD;
							}
							if ($result_17_18_1) {
								$row = mysqli_fetch_assoc($result_17_18_1);
								//定界符方法：
								echo <<<EOD
								<tr>
								<td>{$row['XQ']}</td>
								<td>{$row['KCDW']}</td>
								<td>{$row['JS']}</td>
								<td>{$row['GH']}</td>
								<td>{$row['JSBM']}</td>
								<td>{$row['JSGW']}</td>
								<td>{$row['total']}</td>
								</tr>
EOD;
							}
							if ($result_17_18_2) {
								$row = mysqli_fetch_assoc($result_17_18_2);
								//定界符方法：
								echo <<<EOD
								<tr>
								<td>{$row['XQ']}</td>
								<td>{$row['KCDW']}</td>
								<td>{$row['JS']}</td>
								<td>{$row['GH']}</td>
								<td>{$row['JSBM']}</td>
								<td>{$row['JSGW']}</td>
								<td>{$row['total']}</td>
								</tr>
EOD;
							}
							if ($result_18_19_1) {
								$row = mysqli_fetch_assoc($result_18_19_1);
								//定界符方法：
								echo <<<EOD
								<tr>
								<td>{$row['XQ']}</td>
								<td>{$row['KCDW']}</td>
								<td>{$row['JS']}</td>
								<td>{$row['GH']}</td>
								<td>{$row['JSBM']}</td>
								<td>{$row['JSGW']}</td>
								<td>{$row['total']}</td>
								</tr>
EOD;
							}
						?>
						
					</tbody>
				</table>
				<button id="excelbtn" class="btn btn-success">导出excel表</button>
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
<script src="js/jquery.table2excel.js"></script>
<script src="js/toexcel.js"></script>
</body>
</html>