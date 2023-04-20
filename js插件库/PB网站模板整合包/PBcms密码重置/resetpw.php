<?php
/**
 * @copyright (C)2016-2099 Hnaoyun Inc.
 * @license This is not a freeware, use is subject to license terms
 * @author XingMeng
 * @email hnxsh@foxmail.com
 * @date 2018年11月17日
 *  重置PbootCMS用户密码
 */
// 设置字符集编码、IE文档模式
header('Content-Type:text/html; charset=utf-8');
header('X-UA-Compatible:IE=edge,chrome=1');

// 设置中国时区
date_default_timezone_set('Asia/Shanghai');

// 引入配置文件
$db = require __DIR__.'/config/database.php';


//执行修改	
if ($_POST) {
    
    // 数据库配置文件
    $db_path = __DIR__ . @$_POST['config'];
	
	//纠正路径
	$db = require $db_path;
    
    // 检查配置文件是否存在
    if (! file_exists($db_path)) {
        die('数据库配置文件不存在，请检查路径是否填写正常！');
    }
    
    // 要重置的用户名
    $username = @$_POST['username'];
    
    // 要设置的密码
    $password = @$_POST['password'];
    
    if (! $username) {
        exit('需要重置密码的用户名不能为空！');
    }
    
    if (! $password) {
        exit('请输入需要设置的新密码！');
    }
    
    // 修改密码
    $sql = "UPDATE ay_user SET password='" . md5(md5($password)) . "' where username='$username'";
    if ($db['database']['type'] == 'sqlite' || $db['database']['type'] == 'pdo_sqlite') {
        $conn = get_sqlite(__DIR__ . $db['database']['dbname']);
        $result = $conn->exec($sql) or $conn->lastErrorMsg();
        if ($conn->changes()) {
            echo '恭喜您，重置成功！';
        } else {
            echo '不好意思，重置失败，请核对用户名！(sqlite)';
        }
    } else {
        $conn = get_mysql($db['database']);
        $result = $conn->query($sql) or mysqli_error($conn);
        if ($conn->affected_rows > 0) {
            echo '恭喜您，重置成功！';
        } else {
            echo '不好意思，重置失败，请核对用户名！(mysql)';
        }
    }
}

// 连接数据库，接受数据库连接参数，返回数据库连接对象
function get_sqlite($dbfile)
{
    if (extension_loaded('SQLite3')) {
        try {
            $conn = new SQLite3($dbfile);
            $conn->busyTimeout(15 * 1000); // 设置繁忙延迟时间
        } catch (Exception $e) {
            die("读取数据库文件失败：" . iconv('gbk', 'utf-8', $e->getMessage()));
        }
    } else {
        error('未检测到您服务器环境的SQLite3数据库扩展，请检查php.ini中是否已经开启该扩展！');
    }
    return $conn;
}

// 连接数据库，接受数据库连接参数，返回数据库连接对象
function get_mysql($cfg)
{
    if (! extension_loaded('mysqli')) {
        die('未检测到您服务器环境的mysqli数据库扩展，请检查php.ini中是否已经开启该扩展！');
    }
    // 优化>php5.3版本 在win2008以上服务器连接
    if ($cfg['host'] == 'localhost') {
        $cfg['host'] = '127.0.0.1';
    }
    
    $conn = @new Mysqli($cfg['host'], $cfg['user'], $cfg['passwd'], $cfg['dbname'], $cfg['dbport']);
    if (mysqli_connect_errno()) {
        die("连接数据库服务器失败：" . iconv('gbk', 'utf-8', mysqli_connect_error()));
    }
    $conn->set_charset('utf8'); // 设置编码
    return $conn;
}

// 获取用户名
$sql = 'select username from ay_user';
if ($db['database']['type'] == 'sqlite' || $db['database']['type'] == 'pdo_sqlite') {
	$conn = get_sqlite(__DIR__ . $db['database']['dbname']);
	$result = $conn->query($sql) or $conn->lastErrorMsg();
	$rows = array();
	while (! ! $row = $result->fetchArray(1)) {
		if ($row) {
			$out = new \stdClass();
			foreach ($row as $key => $value) {
				$out->$key = $value;
			}
			$row = $out;
		}
		$rows[] = $row;
	}
} else {
	$conn = get_mysql($db['database']);
	$result = $conn->query($sql) or mysqli_error($conn);
	$rows = array();
	if ($conn->affected_rows > 0) {
		 while (! ! $objects = $result->fetch_object()) {
			$rows[] = $objects;
		}
	} 
}
?>

<!doctype html>
<html lang="zh">
<head>
	<meta charset="utf-8">
	<title>PbootCMS-密码重置工具</title>
</head>
<body>

<form class="mb-5" action=""  method="post">
 <p>配置文件：<input type="text" name="config" value="/config/database.php"  placeholder="请填写数据库配置文件路径"></p>
 <p>用 户 名 ：
 <select name="username">
 <?php
	foreach($rows as $k=>$v){
		echo "<option value='".$v->username."'>".$v->username."</option>";
	}
 ?>
 </select>
 </p>
 <p>新 密 码 ：<input type="text" name="password" placeholder="请输入新密码"> </p>
 <p><button type="submit" class="btn btn-info mb-2">提交</button></p>
</form>

</body>
</html>
