<?php
// 开启session
session_start();

// 连接数据库
$conn = mysqli_connect('127.0.0.1', 'tsa', 'cccc1111', 'tsa');

// 获取候选人列表
$sql = "SELECT * FROM candidates ORDER BY votes DESC";
$result = mysqli_query($conn, $sql);
$candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 获取当前用户的投票信息
if(isset($_COOKIE['tsa_cookie'])){
	$cookie = $_COOKIE['tsa_cookie'];
	$sql = "SELECT * FROM users WHERE cookie='$cookie'";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
}

// 处理投票请求
if(isset($_POST['vote']) && isset($user)){
	$candidate_id = $_POST['vote'];
	$sql = "UPDATE candidates SET votes=votes+1 WHERE id=$candidate_id";
	mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>答辩之奖</title>
	<!-- 引入Bootstrap样式 -->
	<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css" integrity="sha384-8x+K1RBFYsJFpZ+o63VCw0zGj0qJcLg9T9T0QfjKsRmYsJp6Zv8mZw3hKjGqHrF" crossorigin="anonymous">
	<!-- 定义样式 -->
	<style type="text/css">
		.container{
			margin-top: 50px;
		}
		.candidate{
			display: flex;
			flex-direction: row;
			align-items: center;
			margin-top: 20px;
		}
		.name{
			flex: 1;
		}
		.votes{
			flex: 0 0 100px;
			text-align: center;
			font-size: 20px;
		}
		.vote-btn{
			margin-left: 20px;
		}
		.alert{
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<!-- 导航栏 -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">答辩之奖</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">主页</a>
	      </li>
	      <?php if(isset($user)): ?>
	      <li class="nav-item">
	        <a class="nav-link" href="logout.php">退出登录</a>
	      </li>
	      <?php else: ?>
	      <li class="nav-item">
	        <a class="nav-link" href="login.php">登录</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="signup.php">注册</a>
	      </li>
	      <?php endif; ?>
	    </ul>
	  </div>
	</nav>
	<!-- 主体内容 -->
	<div class="container">
		<!-- 登陆提示 -->
		<?php if(isset($_SESSION['login_success'])): ?>
		<div class="alert alert-success" role="alert">
		  登录成功！欢迎回来，<?php echo $_SESSION['login_success']; ?>！
		</div>
		<?php unset($_SESSION['login_success']); ?>
		<?php endif; ?>
		<!-- 注册提示 -->
		<?php if(isset($_SESSION['signup_success'])): ?>
		<div class="alert alert-success" role="alert">
		  注册成功！快去登录吧！
		</div>
		<?php unset($_SESSION['signup_success']); ?>
		<?php endif; ?>
		<!-- 投票提示 -->
		<?php if(isset($_POST['vote']) && isset($user)): ?>
		<div class="alert alert-success" role="alert">
		  投票成功！感谢您的支持！
		</div>
		<?php endif; ?>
		<!-- 候选人列表 -->
		<?php foreach($candidates as $candidate): ?>
		<div class="candidate">
			<div class="name"><?php echo $candidate['name']; ?></div>
			<div class="votes"><?php echo $candidate['votes']; ?> 票</div>
			<?php if(isset($user)): ?>
			<form method="post" action="index.php" class="vote-btn">
				<input type="hidden" name="vote" value="<?php echo $candidate['id']; ?>">
				<button type="submit" class="btn btn-primary">投票</button>
			</form>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<!-- 引入Bootstrap脚本 -->
	<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js" integrity="sha384-5P/7V8aC+Lb7V0DJzvF+7G9X7PbZlB6Z7W8GvJ6T7U6zC1sTmW2LsP6hO4Q/4RZ" crossorigin="anonymous"></script>
</body>
</html>
