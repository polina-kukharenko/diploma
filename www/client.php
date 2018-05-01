<?php 
	require "db.php";
	require "libs/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет клиента - Заказы - ОАО "Осколнефтеснаб"</title>
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
		  	<li class="active"><a href="client.php"><b>Заказы</b></a></li>
	  		<li><a href="client-d.php">Информация</a></li>
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
							$ord = get_orders();
						?>
					<div class="page-header">
						<h3>Все заказы (<?= count($ord) ?>):</h3>
					</div>
						<table class="table table-bordered">
						<?php foreach ($ord as $ord): ?>
							<tr>
								<td>Заказ №<?= $ord['id_order']?></td>
								<td>Договор № <?= $ord['dogovor']?></td>
								<td>Ресурс: <?= $ord['resurs_name']?></td>
								<td><?= $ord['kolvo']?> л.</td>
								<td>Дата заказа: <?= $ord['date_order']?></td>
								<td>Дата доставки: <?= $ord['date_post']?></td>
								<td>г. <?= $ord['city']?>, <?= $ord['address']?></td>
								<td>Статус: <span class="label label-info"><?= $ord['status_name']?></span></td>
								</tr>
						<?php endforeach; ?>
						</table>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="client.php" class="list-group-item active">Все заказы</a>
				  <a href="client.tekorders.php" class="list-group-item">Текущие заказы</a>
				  <a href="client.ojid.php" class="list-group-item">Ожидают обработки</a>
				  <a href="client.neworder.php" class="list-group-item">Новый заказ</a>
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