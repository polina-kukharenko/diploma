<?php 
	require "db.php";
	require "libs/functions.php";

		if (isset($_POST['reg'])){
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		$email = htmlspecialchars($_POST['email']);
		$bad = false;

		unset($_SESSION['error_login']);
		unset($_SESSION['error_password']);
		if((strlen($login) < 6) || (strlen($login) > 32)){
			$_SESSION['error_login'] = 1;
			$bad = true;
		} 
		if((strlen($password) < 6) || (strlen($password) > 32)) {
			$_SESSION['error_password'] = 1;
			$bad = true;
		} 
		if((strlen($email) < 6) || (strlen($email) > 50)) {
			$_SESSION['error_password'] = 1;
			$bad = true;
		} 
		if (!$bad){
			regUser($login, md5($password), $email);
			$_SESSION['reg_success'] = 1;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет менеджера - Клиенты - ОАО "Осколнефтеснаб"</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
    <style>
		.body {
			background: url(img/фон.jpg);
		}
    </style>
  <body class="body">
<!-- Меню -->
	<div class="container" style="margin-top: 60px;">
		<ul class="nav nav-tabs nav-justified">
		  	<li><a href="manager.php"><b>Заказы</b></a></li>
		  	<li><a href="manager.Za.php">Заявки</a></li>
	  		<li class="active"><a href="manager.client-list.php">Клиенты</a></li>
	  		<li><a href="logout.php" style="color: red">Выход</a></li>
		</ul>
	</div>
<!-- Тело -->
	<div class="container" style="margin-top: 10px;">
		<div class="row" >
		  <div class="col-md-9">
			<div class="panel panel-default">
			  <div class="panel-body">
					<div class="page-header">
						<?php
							if ($_SESSION['error_login'] == 1) echo "<p><span style = 'color: red'>Некорректный логин</span></p>";
							if ($_SESSION['error_password'] == 1) echo "<p><span style = 'color: red'>Некорректный пароль</span></p>";
						?>
					<form class="form-horizontal" action = 'manager.client-reg.php' method = 'post'>
						<fieldset>
						<legend>Регистрация нового клиента:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Логин:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'text' class="form-control"  name = 'login' placeholder="Логин клиента" />
								</div>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Пароль:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'text' class="form-control"  name = 'password' placeholder="Пароль клиента" />
								</div>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Email:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'email' class="form-control"  name = 'email' placeholder="Email клиента" />
								</div>
							  </div>
							</div>
							<hr>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие:</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'reg' value = 'Зарегистрировать' />
							  </div>
							</div>
						</fieldset>
					</form>
					<?php
					if ($_SESSION['reg_success'] == 1){ 
						echo '<div class="alert alert-success">Регистрация успешно завершена</div>';
						unset($_SESSION['reg_success']);
					}
					?>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="manager.client-list.php" class="list-group-item">Клиенты</a>
				  <a href="manager.client-reg.php" class="list-group-item active">Регистрация клиента</a>
				</div>
			</div>
		  <div class="panel">
			<div class="panel-body">
				Обратная связь
			</div>
		  </div>
		  </div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>