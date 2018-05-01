<?php 
	require "db.php";
	require "libs/functions.php";

		if (isset($_POST['gotovo'])){
			$list = $_POST['list'];
			$date_post = $zayav['date_post'];
			form_Za($list, $date_post);
		}
		if (isset($_POST['otmena'])){
			$list = $_POST['list'];
			otmena_Za($list);
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
		  	<li class="active"><a href="manager.Za.php">Заявки</a></li>
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
			  <legend>Заявка:</legend>
							<?php 
								$zayav = get_shipping_zayav();
							?>
				<center>
				<form name="select_all_clients" method="post">
						<table>
						    <tr>
						        <td><center>Заявка на поставку ГСМ</center><br></td>
						    </tr>
						    <tr>
						        <td>
						        <table class="table table-bordered">
						        	<tr>
								    	<td><input type="checkbox" checked disabled></td>
								        <td>Заказ</td>
								        <td>ГСМ</td>
								        <td>Количество</td>
								        <td>Адрес доставки</td>
								        <td>Калибровка, л</td>
								    </tr>
									<?php foreach ($zayav as $zayav): ?>
								    <tr>
								    	<td><input type="checkbox" name="list[]" value="<?= $zayav['id_order']?>" checked></td>
								        <td><?= $zayav['id_order']?></td>
								        <td><?= $zayav['resurs_name']?></td>
								        <td><?= $zayav['kolvo']?></td>
								        <td><?= $zayav['city']?>, <?= $zayav['address']?></td>
								        <td><?= $zayav['volume']?></td>
								    </tr>
									<?php endforeach; ?>
								</table>
						        </td>
						    </tr>
						</table>
						<b>Дата:</b> <?= $zayav['date_post']?><br><br><br>
						<table>
							<tr>
								<td><input type = 'submit' class="btn btn-success" name = 'gotovo' value = 'Готово' />&nbsp;</td>
								<td><input type = 'submit' class="btn btn-danger" name = 'otmena' value = 'Отменить все действия' />&nbsp;</td>
							</tr>
						</table>
				</form>
				</center>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
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