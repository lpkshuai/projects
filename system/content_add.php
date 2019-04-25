<?php
//内存超限
set_time_limit(0);
ini_set('memory_limit', '512M');
//导入类库
require_once('lib/php-excel-reader/excel_reader2.php');
require_once('lib/SpreadsheetReader.php');
//数据库连接
$dbHost = "localhost";
$dbDatabase = "system";
$dbPasswrod = "lpk19961224";
$dbUser = "root";
$link = mysqli_connect($dbHost,$dbUser,$dbPasswrod,$dbDatabase);
// 设定字符集  
mysqli_set_charset($link ,'utf8');
//上传文件对应字典（对象）
$fileInfo = $_FILES['file'];
$fileName = $fileInfo['name'];
$table_name = $_POST['table_name'];
$Reader = new SpreadsheetReader('uploads/'.$fileName);
//正则表达式判断要插入的表是哪张（实验项目还是交叉表）
if (preg_match("/交叉表/", $fileName)) {
	$create = "create table if not exists $table_name (`CJLRMC` varchar(50) DEFAULT NULL,`KKXY` varchar(50) DEFAULT NULL COMMENT '开课学院',`KCMC` varchar(50) DEFAULT NULL COMMENT '课程名称',`KCXZ` varchar(50) DEFAULT NULL COMMENT '课程性质',`ZXS` varchar(20) DEFAULT NULL COMMENT '总学时',`XF` varchar(20) DEFAULT NULL COMMENT '学分',`JGH` varchar(50) DEFAULT NULL,`JS` varchar(20) DEFAULT NULL,`KTMC` varchar(50) DEFAULT NULL,`TOTAL` varchar(50) DEFAULT NULL,`GSGL` varchar(20) DEFAULT NULL,`GJJY` varchar(20) DEFAULT NULL,`JXDQ` varchar(20) DEFAULT NULL,`JXHJGC` varchar(20) DEFAULT NULL,`JJMY` varchar(20) DEFAULT NULL,`JSJY` varchar(20) DEFAULT NULL,`LI` varchar(20) DEFAULT NULL,`RW` varchar(20) DEFAULT NULL,`SL` varchar(20) DEFAULT NULL,`TM` varchar(20) DEFAULT NULL,`WY` varchar(20) DEFAULT NULL,`XXGC` varchar(20) DEFAULT NULL,`YH` varchar(20) DEFAULT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;
						";
	$result1 = mysqli_query($link, $create);
	//预处理及绑定
	$insert_sql = "insert into $table_name values(? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )";
	$stmt = mysqli_prepare($link,$insert_sql);
	mysqli_stmt_bind_param($stmt,'sssssssssssssssssssssss',$CJLRMC,$KKXY,$KCMC,$KCXZ,$ZXS,$XF,$JGH,$JS,$KTMC,$TOTAL,$GSGL,$GJJY,$JXDQ,$JXHJGC,$JJMY,$JSJY,$LI,$RW,$SL,$TM,$WY,$XXGC,$YH);
	if ($result1) {
		foreach ($Reader as $Row)
		{
			//判断数据为空情况
			$CJLRMC = isset($Row[0]) ? $Row[0] : '';
			$KKXY = isset($Row[1]) ? $Row[1] : '';
			$KCMC = isset($Row[2]) ? $Row[2] : '';
			$KCXZ = isset($Row[3]) ? $Row[3] : '';
			$ZXS = isset($Row[4]) ? $Row[4] : '';
			$XF = isset($Row[5]) ? $Row[5] : '';
			$JGH = isset($Row[6]) ? $Row[6] : '';
			$JS = isset($Row[7]) ? $Row[7] : '';
			$KTMC = isset($Row[8]) ? $Row[8] : '';
			$TOTAL = isset($Row[9]) ? $Row[9] : '';
			$GSGL = isset($Row[10]) ? $Row[10] : '';
			$GJJY = isset($Row[11]) ? $Row[11] : '';
			$JXDQ = isset($Row[12]) ? $Row[12] : '';
			$JXHJGC = isset($Row[13]) ? $Row[13] : '';
			$JJMY = isset($Row[14]) ? $Row[14] : '';
			$JSJY = isset($Row[15]) ? $Row[15] : '';
			$LI = isset($Row[16]) ? $Row[16] : '';
			$RW = isset($Row[17]) ? $Row[17] : '';
			$SL = isset($Row[18]) ? $Row[18] : '';
			$TM = isset($Row[19]) ? $Row[19] : '';
			$WY = isset($Row[20]) ? $Row[20] : '';
			$XXGC = isset($Row[21]) ? $Row[21] : '';
			$YH = isset($Row[22]) ? $Row[22] : '';
			if ($KKXY == "信息工程学院") {
				//设置参数并执行
				$result_insert = mysqli_stmt_execute($stmt);
		   		if ($result_insert) {
					echo '<script>alert("插入成功");location.href="content_add.html";</script>';
				}else{
					echo '<script>alert("插入失败，请重新尝试");location.href="content_add.html";</script>';
				}
			}
		}
	}else {
		echo '<script>alert("此表已存在");location.href="content_add.html";</script>';
	}
}else if (preg_match("/实验项目/", $fileName)) {
	$create = "create table if not exists $table_name (`DW` varchar(20) not null default '信息工程学院' comment '开课单位',`C_name` varchar(50) not null default '' comment '课程名称',`C_no` varchar(50) not null default '' comment '课程号',`experimental_name` varchar(50) not null default '' comment '实验项目名称',`experimental_no` varchar(50) not null default '' comment '实验项目编号',`major` varchar(50) not null default '' comment '课堂名称',`week` varchar(20) default null comment '实验周次',`date` varchar(50) default null comment '实验时间',`finish` varchar(10) default null comment '是否完成',`lab_name` varchar(50) default null comment '实验室名称',`teacher` varchar(20) default null comment '教师姓名',`teacher_no` varchar(50) default null comment '教工号',`teacher_DW` varchar(50) default null comment '教师所属单位',`batch` varchar(20) default null comment '批次名称',`batch_stu` varchar(20) default null comment '批次学生数'
					) engine=InnoDB default charset=utf8;
					";
	mysqli_query($link, $create);
	//定义文件名
	$ff = 'E:/phpStudy/PHPTutorial/WWW/system/files/'.$table_name.'.csv';
	if (file_exists($ff)) {
		//如果已经有该文件为了防止数据重复进行删除操作
		unlink($ff);
		foreach ($Reader as $Row)
		{
			$values = implode($Row, ';')."\r\n";
			// var_dump($values) ;
			file_put_contents($ff, $values, FILE_APPEND);
		}
		mysqli_options($link, MYSQLI_OPT_LOCAL_INFILE, true);
		$sql = "load data local infile '$ff' ignore into table $table_name fields terminated by ';' lines terminated by '\\r\\n' ignore 1 lines";
		// echo $sql;
		$result = mysqli_query($link, $sql);
		if ($result) {
			echo '<script>alert("插入成功");location.href="content_add.html";</script>';
		}else{
			echo '<script>alert("插入失败，请重新尝试");location.href="content_add.html";</script>';
		}
	}else{
		foreach ($Reader as $Row)
		{
			$values = implode($Row, ';')."\r\n";
			file_put_contents($ff, $values, FILE_APPEND);
		}
		mysqli_options($link, MYSQLI_OPT_LOCAL_INFILE, true);
		$sql = "load data local infile '$ff' ignore into table $table_name fields terminated by ';' lines terminated by '\\r\\n' ignore 1 lines";
		$result = mysqli_query($link, $sql);
		if ($result) {
			echo '<script>alert("插入成功");location.href="content_add.html";</script>';
		}else{
			echo '<script>alert("插入失败，请重新尝试");location.href="content_add.html";</script>';
		}
	}	
}else{
	echo "<script>alert('插入表格文件不合法，请确认是否为实验表或人数交叉表！');location.href='content_add.html'</script>";
}