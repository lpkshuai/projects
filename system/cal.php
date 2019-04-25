<?php  
// 连接数据库
$link = mysqli_connect('localhost','root','lpk19961224','system');
// 设定字符集  
mysqli_set_charset($link ,'utf8');

$table = $_POST['term'];
$term = substr($table, 6);//截取学期信息
$results = "results_".$term;//定义结果表的名字
// echo $results;
// echo $term;
//定义系数
$sql_rules ="select * from rule";
$result_rules = mysqli_query($link, $sql_rules);
$data_rules = mysqli_fetch_assoc($result_rules);
// print_r($data_rules);
$p1 = $data_rules['p1'];//批次
$p2 = $data_rules['p2'];
$p3 = $data_rules['p3'];
$c1 = $data_rules['c1'];//批次重复系数
$c2 = $data_rules['c2'];
$c3 = $data_rules['c3'];
$s1_ts = $data_rules['s1_ts'];//课程类别系数（通识，开放，其他）
$s1_kf = $data_rules['s1_kf'];
$s1_qt = $data_rules['s1_qt'];
$s2 = $data_rules['s2'];//综合性设计实验系数
$s3_1 = $data_rules['s3_1'];//人数系数
$s3_2 = $data_rules['s3_2'];
$s3_3 = $data_rules['s3_3'];
$s3_4 = $data_rules['s3_4'];
//判断是否已经存在计算结果表
$results_exist = "select * from $results";//exit($results_exist);
$result_results = mysqli_query($link, $results_exist);
if ($result_results) {
	echo '<script>alert("此学期已经计算过了，请选择其它学期");location.href="content_cal.html";</script>';
}else{
	$results_create = "create table if not exists $results (
	  `XQ` varchar(20) not null default '',
	  `KCDW` varchar(50) default null comment '课程单位',
	  `XSXY` varchar(50) default null comment '学生所属学院',
	  `JS` varchar(20) default null comment '教师',
	  `GH` varchar(20) default null comment '工号',
	  `JSBM` varchar(20) default null comment '教师部门',
	  `JSGW` varchar(50) default null comment '教师岗位/现状',
	  `GZL` varchar(20) default null comment '教师工作量'
	) engine=InnoDB default charset=utf8;
	";
	$result_create = mysqli_query($link, $results_create);
	$query = "select DW,major,date,lab_name,teacher,teacher_no,teacher_DW,batch,batch_stu from $table where finish='是' order by teacher_no";
	$result = mysqli_query($link, $query);

	foreach ($result as $rows) {
		// print_r($rows);
		echo "<br>";
		// foreach ($row as $value) {
		// 	echo $value.'<br>';
		// }
		if (strlen($rows['date'])==5) {
			$N = 2;//计划学时
		}elseif (strlen($rows['date'])==9) {
			$N = 4;
		}elseif ($rows['date']==''){
			$N = 0;//数据不全
		}
		if ($rows['batch']=='第一批') {
			$P = $p1;
			$C = $c1;
		}elseif ($rows['batch']=='第二批') {
			$P = $p2;
			$C = $c2;
		}elseif ($rows['batch']=='第三批'){
			$P = $p3;
			$C = $c3;
		}elseif ($rows['batch']==''){
			$P = 0;//数据不全
			$C = 0;
		}
		$S1 = $s1_qt;//课程类别系数均为其他
		$S2 = $s2; 
		$lab = $rows['lab_name'];
		$tno = $rows['teacher_no'];
		$major = $rows['major'];
		$dw = $rows['DW'];
		$teacher = $rows['teacher'];
		$tdw = $rows['teacher_DW'];
		$sql_computer = "select computer from lab where lab_name='$lab'";
		$result_computer = mysqli_query($link, $sql_computer);
		$data_computer  = mysqli_fetch_assoc($result_computer);
		$sql_gw = "select GW from teacher where tno='$tno'";
		$result_gw = mysqli_query($link, $sql_gw);
		$data_gw  = mysqli_fetch_assoc($result_gw);
		// echo $sql_computer;
		// echo $data_computer['computer'];
		if ($data_computer['computer']=="是") {
			if ($rows['batch_stu']<=30) {
				$S3 = $s3_1;
			}elseif (($rows['batch_stu'])>30 && ($rows['batch_stu'])<=45) {
				$S3 = $s3_2;
			}elseif (($rows['batch_stu'])>45 && ($rows['batch_stu'])<=60) {
				$S3 = $s3_3;
			}elseif (($rows['batch_stu'])>60) {
				$S3 = $s3_4;
			}
		}elseif ($data_computer['computer']=="否") {
			if ($rows['batch_stu']<=20) {
				$S3 = $s3_1;
			}elseif (($rows['batch_stu'])>20 && ($rows['batch_stu'])<=30) {
				$S3 = $s3_2;
				// echo $S3;
			}elseif (($rows['batch_stu'])>30 && ($rows['batch_stu'])<=40) {
				$S3 = $s3_3;
			}elseif (($rows['batch_stu'])>40) {
				$S3 = $s3_4;
			}
		}elseif ($data_computer['computer']=="") {
			$S3 = 0;
			// echo $S3;
		}
		$R2 = 1 + $S1 + $S2 + $S3;
		$M2 = $N * $P * $C * $R2;
		
		$GW = $data_gw['GW'];
		//学生所属学院分类
		if (preg_match("/海军|武警|二炮|火箭军|士官/", $major)) {
			$major = "军事教育学院";
			// echo $institute;
		}elseif (preg_match("/瑶湖/", $major)) {
			$major = "瑶湖学院";
		}elseif (preg_match("/测控技术与仪器|电子信息工程|计算机|软件|通信工程|通信技术|信息管理与信息系统|应用电子/", $major)) {
			$major = "信息工程学院";
		}elseif (preg_match("/法语|翻译|英语/", $major)) {
			$major = "外国语学院";
		}elseif (preg_match("/土木工程|建筑|工程管理|工程造价|给排水|道路桥梁|大土木实验|城市规划|城乡规划|城镇规划|城市地下空间工程/", $major)) {
			$major = "土木与建筑工程学院";
		}elseif (preg_match("/园林|水信息|水利|水土|水文|工程监理|工程测量技术|风景园林|地质工程|地理信息系统与地图制图技术|测绘工程/", $major)) {
			$major = "水利与生态工程学院";
		}elseif (preg_match("/音乐|艺术|文秘|视觉传达设计|环境设计|产品设计|汉语言文学|广播电视|动画|编辑出版/", $major)) {
			$major = "人文与艺术学院";
		}elseif (preg_match("/测试增加|信息与计算科学|应用统计学/", $major)) {
			$major = "理学院";
		}elseif (preg_match("/保险|财务管理|国际经济与贸易|会计|审计学/", $major)) {
			$major = "经济贸易学院";
		}elseif (preg_match("/自动化|水电站动力设备与管理|数控技术|热能与动力工程|汽车检测与维修技术|能源与动力工程|机械设计制造及其自动化|机械电子工程|机电一体化技术|供用电技术|电气工程及其自动化|车辆工程|材料成型及控制工程/", $major)) {
			$major = "机械与电气工程学院";
		}elseif (preg_match("/中荷|中韩|中加/", $major)) {
			$major = "国际教育学院";
		}elseif (preg_match("/物流管理|市场营销|旅游管理|房地产经营与估价|电子商务/", $major)) {
			$major = "工商管理学院";
		}
		
		// echo $term.$dw.$major.$teacher.$tno.$tdw.$GW.'----------------'.$M2.'-------'.$R2;

		
		
		//向数据库里加入结果表
		$sql_results = "insert into $results values("."\"".$term."\"".","."\"".$dw."\"".","."\"".$major."\"".","."\"".$teacher."\"".","."\"".$tno."\"".","."\"".$tdw."\"".","."\"".$GW."\"".",".$M2.")";
		// echo $sql_results;
		$result_insert = mysqli_query($link, $sql_results);
		
	}
}
//再次判断结果
$judge = "select * from $results";
$result_judge = mysqli_query($link, $judge);
if ($result_judge) {
	echo '<script>alert("计算成功");location.href="content.php";</script>';
}else{
	echo '<script>alert("计算失败，请重新尝试");location.href="content_cal.html";</script>';
}