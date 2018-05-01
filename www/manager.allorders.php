<?php 
	require "db.php";
	require "libs/functions.php";

	if (isset($_POST['vedom'])){
			header('Location: /manager.Za.php');
		}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет клиента - Текущие заказы - ОАО "Осколнефтеснаб"</title>
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
		  	<li class="active"><a href="manager.php"><b>Заказы</b></a></li>
		  	<li><a href="manager.Za.php">Заявки</a></li>
	  		<li><a href="manager.client-list.php">Клиенты</a></li>
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
						$ord = get_ready_orders_manager();
					?>
					<div class="page-header">
						<h3>Доставленные заказы (<?= count($ord) ?>):</h3>
					</div>
					<form action="manager.allorders.php" name="select_all" method="post">
						<table>
							<tr>
							    <td><input type = 'submit' class="btn btn-success" name = 'vedom' value = 'Сформировать сводную ведомость' /><br><br>
							</tr>
						</table>
						<table class="table table-bordered">
						<?php foreach ($ord as $ord): ?>
							<tr>
								<!-- <td><input type="checkbox" name="list[]" value="<?= $ord['id_order']?>"></td>-->
								<td>№<?= $ord['id_order']?></td>
								<td>Ресурс: <?= $ord['resurs_name']?></td>
								<td><?= $ord['kolvo']?> л.</td>
								<td>Дата заказа: <?= $ord['date_order']?></td>
								<td>Дата доставки: <?= $ord['date_post']?></td>
								<td>г. <?= $ord['city']?>, <?= $ord['address']?></td>
								<td>Статус: <span class="label label-info"><?= $ord['status_name']?></span></td>
							</tr>
						<?php endforeach; ?>
						</table>
						<table>
							<tr>
							    <td><input type = 'submit' class="btn btn-success" name = 'vedom' value = 'Сформировать сводную ведомость' />
							</tr>
						</table>
					</form>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="manager.php" class="list-group-item">Новые заказы</a>
				  <a href="manager.workwithorder.php" class="list-group-item">Обрабатываются</a>
				  <a href="manager.tekorders.php" class="list-group-item">Текущие заказы</a>
				  <a href="manager.allorders.php" class="list-group-item active">Доставленные заказ</a>
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