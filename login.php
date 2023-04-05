<?php
// 开启session
session_start();

// 如果用户已经登录，则跳转到首页
if(isset($_SESSION['user'])){
	header('Location: index.php');
	exit;
}

// 处理用户提交的表单数据
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	// 验证用户名和密码是否正确
	if($username === 'admin' && $password === '123456'){
		// 登录成功，将用户信息保存到session中
		$_SESSION['user'] = $username;
		$_SESSION['login_success'] = $username;
		header('Location: index.php');
		exit;
	} else {
		// 登录失败，显示错误信息
		$error = '用户名或密码错误！';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 引入Bootstrap样式 -->
	<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css" integrity="sha384-nTbUaVzA6nFj7VzNcK9X6V+UyUm3q6nKU6iS5E5f5+1yfdlHh6CCb4WgG4+4BZ6" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="mt-5">登录</h1>
		<!-- 显示错误信息 -->
		<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
		  <?php echo $error; ?>
		</div>
		<?php endif; ?>
		<!-- 登录表单 -->
		<form method="post" action="login.php" class="mt-5">
			<div class="mb-3">
				<label for="username" class="form-label">用户名</label>
				<input type="text" class="form-control" id="username" name="username" required>
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">密码</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			<button type="submit" class="btn btn-primary">登录</button>
		</form>
	</div>
	<!-- 引入Bootstrap脚本 -->
	<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js" integrity="sha384-5P/7V8aC+Lb7V0DJzvF+7G9X7PbZlB6Z7W8GvJ6T7U6zC1sTmW2LsP6hO4Q/4RZ" crossorigin="anonymous"></script>
</body>
</html>
