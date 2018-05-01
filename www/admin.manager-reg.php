<?php 
	require "db.php";
	require "libs/functions.php";

		if (isset($_POST['reg'])){
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);
		$email = htmlspecialchars($_POST['email']);
		$name = htmlspecialchars($_POST['name']);
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
			regManager($login, md5($password), $email, $name);
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
    <title>Администратор - ОАО "Осколнефтеснаб"</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
    <style>
		.body {
			background: url(img/фон.jpg);
		}
    </style>
  <body class="body">
<!-- Тело -->
	<div class="container" style="margin-top: 100px;">
		<div class="row" >
		  <div class="col-md-9">
			<div class="panel panel-default">
			  <div class="panel-body">
					<?php 
						$man = get_managers();
					?>
					<div class="page-header">
						<?php
							if ($_SESSION['error_login'] == 1) echo "<p><span style = 'color: red'>Некорректный логин</span></p>";
							if ($_SESSION['error_password'] == 1) echo "<p><span style = 'color: red'>Некорректный пароль</span></p>";
						?>
					<form class="form-horizontal" action = 'admin.manager-reg.php' method = 'post'>
						<fieldset>
						<legend>Регистрация нового менеджера:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Логин:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'text' class="form-control"  name = 'login' placeholder="Логин менеджера" />
								</div>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Пароль:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'text' class="form-control"  name = 'password' placeholder="Пароль менеджера" />
								</div>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Email:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'email' class="form-control"  name = 'email' placeholder="Email менеджера" />
								</div>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Имя менеджера:</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type = 'text' class="form-control"  name = 'name' placeholder="Имя менеджера" style="width = 400px;"" />
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
				  <a href="admin.php" class="list-group-item">Менеджеры</a>
				  <a href="admin.manager-reg.php" class="list-group-item active">Создать нового менеджера</a>
				</div>
			</div>
		  <div class="panel">
			<div class="panel-body">
				<a href="logout.php" class="btn btn-danger btn-block btn-md">Выход</a>
			</div>
		  </div>
		  </div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>