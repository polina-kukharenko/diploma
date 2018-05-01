<?php 
	require "db.php";
	require "libs/functions.php";
	if (isset($_POST['man_name'])){
			$name = (string) $_POST['name_manager'];
			$mysqli = connectDB();
			$id = $_SESSION['info_manager_id'];
			$mysqli->query("UPDATE `info_users` SET `contact_agent` = '$name' WHERE id = '$id'");
			closeDB($mysqli);
			unset($_SESSION['info_manager_id']);
			header('Location: /admin.php');
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
						$inf = get_manager_info();
					?>
					<div class="page-header">
						<h3>Менеджер:</h3>
					</div>
					<form action="admin.php" name="select_all" method="post">
						<table class="table table-bordered">
						<table class="table table-bordered">
							<tr>
								<td><b>ID</b></td>
								<td><b>Логин</b></td>
								<td><b>email</b></td>
								<td><b>Имя</b></td>
							</tr>
							<?php foreach ($inf as $inf): ?>
							<tr>
								<td><?= $inf['id']?></td>
								<td width="150px"><?= $inf['login']?></td>
								<td><?= $inf['email']?></td>
								<td><?= $inf['contact_agent']?></td>
							</tr>
							<?php endforeach; ?>
						</table>
						<table>
							<tr>
							    <td width="400px"><input type = 'text' class="form-control" name = 'name_manager' placeholder="<?= $inf['contact_agent']?>"/>&nbsp;</td>
							</tr>
							<tr>
								<td><input type="submit" class="btn btn-primary" value="Редактировать имя" name = 'man_name' ></td>
							</tr>
						</table>
					</form>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="admin.php" class="list-group-item active">Менеджеры</a>
				  <a href="admin.manager-reg.php" class="list-group-item">Создать нового менеджера</a>
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