<?php
// 开启session
session_start();

// 如果用户未登录，则跳转到登录页面
if(!isset($_SESSION['user'])){
	header('Location: login.php');
	exit;
}

// 如果用户未登录成功，则跳转到登录页面
if(isset($_SESSION['login_success']) && $_SESSION['login_success'] !== $_SESSION['user']){
	header('Location: login.php');
	exit;
}

// 如果用户注册成功，则显示注册成功的提示信息
if(isset($_SESSION['signup_success']) && $_SESSION['signup_success']){
	echo '<div class="alert alert-success" role="alert">注册成功！</div>';
	unset($_SESSION['signup_success']);
}

// 处理用户退出登录请求
if(isset($_GET['logout'])){
	session_destroy();
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>管理页面</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 引入Bootstrap样式 -->
	<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css" integrity="sha384-nTbUaVzA6nFj7VzNcK9X6V+UyUm3q6nKU6iS5E5f5+1yfdlHh6CCb4WgG4+4BZ6" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="mt-5">管理页面</h1>
		<p>欢迎您，<?php echo $_SESSION['user']; ?>！</p>
		<a href="admin.php?logout=true" class="btn btn-danger">退出登录</a>
	</div>
	<!-- 引入Bootstrap脚本 -->
	<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js" integrity="sha384-5P/7V8aC+Lb7V0DJzvF+7G9X7PbZlB6Z7W8GvJ6T7U6zC1sTmW2LsP6hO4Q/4RZ" crossorigin="anonymous"></script>
</body>
</html>
