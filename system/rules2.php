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
				<a href="index2.html" class="navbar-brand">工作量计算系统</a>
			</div>
			<!-- 小屏幕导航按钮和logo -->
			<!-- 导航 -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index2.html"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;系统首页</a></li>
					<li><a href="content2.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;统计报表</a></li>
					<li class="active"><a href="rules2.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;计算规则</a></li>
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
				 	<a href="rules2.php" class="list-group-item active">查询计算规则</a>
				 </div>
			</div>
			<!-- 右侧列表 -->
			<div class="col-md-10">
				<div class="page-header">
					<h1>计算规则</h1>
				</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="rules2.php">查询计算规则</a></li>
				</ul>
				<h3>计算规则查询</h3>
				<h4>(M2= N×P×C×R2,R2=1+S1+S2+S3)</h4>
				<div class="alert alert-info alert-dismissible" role="alert">
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  	N 为计划学时数。P为批次总数，C为重复系数，R2为综合指导系数。教学班分批最多不超过3批。1、2、3批次重复系数C分别为1.0，0.9，0.8。如受限于实验条件，必须超过3批的课程，任课教师须经课程所属院（部）同意，并报教务处备案，且每增加1批次重复系数C递减0.1，最低为0.3。<br>
				  	<strong>注意：</strong>（1）当自然班级不足40人，且P=1时，S3=0；（2）在实验条件允许的情况下，以教学班为单位进行指导。如为上机操作实验，理论课为合班，则课内实验不得拆班进行分批。公共基础课不超过3人，专业课按实验条件和安全规范设定每组人数。
				</div>
				<?php 
				// 连接数据库
				$link = mysqli_connect('localhost','root','lpk19961224','system');
				// 设定字符集  
				mysqli_set_charset($link ,'utf8');
				$query = "select * from rule";
				$result = mysqli_query($link, $query);
				$data = mysqli_fetch_assoc($result);
				if ($result) {
					#print_r($data);
				}else{
					echo "错误";
				}
				
				?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>系数</th>
							<th>代表项</th>
							<th>赋值说明</th>
							<th>赋值</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>P1</td>
							<td>批次总数</td>
							<td>第一批</td>
							<td><?php echo @$data[p1]; ?></td>
						</tr>
						<tr>
							<td>P2</td>
							<td>批次总数</td>
							<td>第二批</td>
							<td><?php echo @$data[p2]; ?></td>
						</tr>
						<tr>
							<td>P3</td>
							<td>批次总数</td>
							<td>第三批</td>
							<td><?php echo @$data[p3]; ?></td>
						</tr>
						<tr>
							<td>C1</td>
							<td>重复系数</td>
							<td>第一批重复系数</td>
							<td><?php echo @$data[c1]; ?></td>
						</tr>
						<tr>
							<td>C2</td>
							<td>重复系数</td>
							<td>第二批重复系数</td>
							<td><?php echo @$data[c2]; ?></td>
						</tr>
						<tr>
							<td>C3</td>
							<td>重复系数</td>
							<td>第三批重复系数</td>
							<td><?php echo @$data[c3]; ?></td>
						</tr>
						<tr>
							<td>S1</td>
							<td>课程类别系数</td>
							<td>通识任选实验课</td>
							<td><?php echo @$data[s1_ts]; ?></td>
							<!-- <td>
								<div role="presentation" class="dropdown">
									<button href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										操作
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="#">编辑</a></li>
										<li><a href="#">删除</a></li>
										<li><a href="#">全局置顶</a></li>
									</ul>
								</div>
							</td> -->
						</tr>
						<tr>
							<td>S1</td>
							<td>课程类别系数</td>
							<td>开放性实验</td>
							<td><?php echo @$data[s1_kf]; ?></td>
						</tr>
						<tr>
							<td>S1</td>
							<td>课程类别系数</td>
							<td>其他</td>
							<td><?php echo @$data[s1_qt]; ?></td>
						</tr>
						<tr>
							<td>S2</td>
							<td>综合性、设计性实验系数</td>
							<td>经专家论证且教务处备案</td>
							<td><?php echo @$data[s2]; ?></td>
						</tr>
						<tr>
							<td>S3</td>
							<td>授课班级人数系数（n）</td>
							<td>n≤20或n≤30</td>
							<td><?php echo @$data[s3_1]; ?></td>
						</tr>
						<tr>
							<td>S3</td>
							<td>授课班级人数系数（n）</td>
							<td>20&lt;n≤30或30&lt;n≤45</td>
							<td><?php echo @$data[s3_2]; ?></td>
						</tr>
						<tr>
							<td>S3</td>
							<td>授课班级人数系数（n）</td>
							<td>30&lt;n≤40或45&lt;n≤60</td>
							<td><?php echo @$data[s3_3]; ?></td>
						</tr>
						<tr>
							<td>S3</td>
							<td>授课班级人数系数（n）</td>
							<td>n&gt;40或n&gt;60</td>
							<td><?php echo @$data[s3_4]; ?></td>
						</tr>
					</tbody>
				</table>
				
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