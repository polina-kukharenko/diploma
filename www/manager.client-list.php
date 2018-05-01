<?php 
	require "db.php";
	require "libs/functions.php";

	if (isset($_POST['client_info'])){
		$id_client = $_POST['id_client'];
		$_SESSION['read_client_info'] = $id_client;
		header('Location: manager.client_info.php');
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
							<?php 
								$cli = get_clients();
							?>
							<div class="page-header">
								<h3>Клиенты (<?= count($cli) ?>):</h3>
							</div>
				<form name="select_all_clients" method="post" action="manager.client-list.php" target="_blank">
						<input type="submit" class="btn btn-primary" value="Подробнее" name = 'client_info'>
						<br><br>
						<table class="table table-bordered">
							<tr>
								<td></td>
								<td><b>ID</b></td>
								<td><b>Логин</b></td>
								<td><b>Организация</b></td>
								<td><b>Юр. адрес</b></td>
								<td><b>Телефон</b></td>
							</tr>
						<?php foreach ($cli as $cli): ?>
							<tr>
								<td><input type="radio" name="id_client" value="<?= $cli['id']?>"></td>
								<td><?= $cli['id']?></td>
								<td width="150px"><?= $cli['login']?></td>
								<td><?= $cli['organization_name']?></td>
								<td><?= $cli['org_address']?></td>
								<td width="130px"><?= $cli['org_telephone_num']?></td>
							</tr>
							<?php endforeach; ?>
						</table>
						<input type="submit" class="btn btn-primary" value="Подробнее" name = 'client_info'>
				</form>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="manager.client-list.php" class="list-group-item active">Клиенты</a>
				  <a href="manager.client-reg.php" class="list-group-item">Регистрация клиента</a>
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