<?php 
	require "db.php";
	require "libs/functions.php";

		if (isset($_POST['read_zayav'])){
		$date = $_POST['date']; //дата
		$_SESSION['read_date'] = $date;
		header('Location: doc.zayavka.php');
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
			  <?php
			  	$date_post = get_date_post();
			  ?>
			  	<div class="page-header">
					<h3>Документы:</h3>
				</div>
				<center>
				<form class="form-horizontal" method="post" action="manager.Za.php" target="_blank">
							<div class="form-group">
							  <label class="col-md-3 control-label">Выберите дату заявки:</label>
							  	<div class="col-sm-5">
							  		<select class="form-control" name="date" >
									<?php foreach ($date_post as $date_post): ?>
									  <option value="<?= $date_post['date_post_index']?>">
									  	<?= $date_post['date_post_index']?>
									  </option>
									<?php endforeach; ?>
									</select>		
							  </div>
							  <input type="submit" class="btn btn-primary" name="read_zayav" value="Посмотреть заявку">
							</div>
							<hr>
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