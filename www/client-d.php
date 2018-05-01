<?php 
	require "db.php";
	require "libs/functions.php";

	$id_user = $_SESSION['idclient'];
	if (isset($_POST['up_info'])){
		$org_name = htmlspecialchars($_POST['org_name']);
		$org_address = htmlspecialchars($_POST['org_address']);
		$org_tel = htmlspecialchars($_POST['org_tel']);
		$bad = false;

		if((strlen($org_address) == 0) && (strlen($org_tel) == 0)){
			$_SESSION['error_red'] = 1;
			$bad1 = true;
		} 

		if (!$bad && (strlen($org_address) > 0)){
			$mysqli = connectDB();
			$mysqli->query("UPDATE `info_users` SET `org_address`= '$org_address' WHERE `id`= '$id_user'");
			closeDB($mysqli);
			$_SESSION['red_success'] = 1;
			header('Location: /client-d.php');
		} 

		if (!$bad && (strlen($org_tel) > 0)){
			$mysqli = connectDB();
			$mysqli->query("UPDATE `info_users` SET `org_telephone_num` = '$org_tel' WHERE `id`= '$id_user'");
			closeDB($mysqli);
			$_SESSION['red_success'] = 1;
			header('Location: /client-d.php');
		}
	}

	if (isset($_POST['up_adr'])){
		$gorod = htmlspecialchars($_POST['gorod']);
		$address_up = htmlspecialchars($_POST['address_up']);
		$bad = false;

		if((strlen($gorod) == 0) || (strlen($address_up) == 0)){
			$_SESSION['error_red'] = 1;
			$bad = true;
		} 

		if (!$bad){
			$mysqli = connectDB();
			$mysqli->query("INSERT INTO `addresses`(`id_user`, `city`, `address`) 
				VALUES ('$id_user', '$gorod', '$address_up')");
			closeDB($mysqli);
			$_SESSION['red_success'] = 1;
			header('Location: /client-d.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет клиента - Информация - ОАО "Осколнефтеснаб"</title>
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
		  	<li><a href="client.php">Заказы</a></li>
	  		<li class="active"><a href="client-d.php">Информация</a></li>
	  		<li><a href="logout.php" style="color: red">Выход</a></li>
		</ul>
	</div>
<!-- Тело -->
	<div class="container" style="margin-top: 10px;">
		<div class="row" >
		  <div class="col-md-9">
			<div class="panel">
				  <div class="panel-body">
						<?php 
							$row = get_dogovors();
							$info = 'info';
						?>
						<!-- сообщение об -->
						  	<?php
								if ($_SESSION['error_red'] == 1) {echo '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Ошибка! Не все поля были заполнены, либо заполнены некорректно, повторите попытку.</div>';
								unset($_SESSION['error_red']);}
								if ($_SESSION['red_success'] == 1) {echo '<br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Изменения внесены успешно!</div>';
								unset($_SESSION['red_success']);}
							?>
						<div class="page-header">
							<h3>Договоры (<?= count($row) ?>):</h3>
						</div>
							<table class="table table-bordered">
							<?php foreach ($row as $row): ?>
								<tr>
									<td>Договор № <?= $row['no_dogovor_id']?></td>
									<td>Начало: <?= $row['date_start']?></td>
									<td>Топливо: <?= $row['resurs_name']?></td>
									<td>Макс. <?= $row['uslovie']?> л.</td>
									<?php if ($row['status_dogovor'] == 'Неактивный'): ?>
										<?php $info = 'default'; ?>
									<td><span class="label label-<?= $info ?>"><?= $row['status_dogovor']?></span></td>
									<?php elseif ($row['status_dogovor'] == 'Активный'): ?>
										<?php $info = 'success'; ?>
									<td><span class="label label-<?= $info ?>"><?= $row['status_dogovor']?></span></td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
							</table>
				  </div>
					<div class="panel-body">
						<?php 
							$adr = get_address();
						?>
						<div class="page-header">
							<h3>Адреса компании (<?= count($adr) ?>):</h3>
						</div>
						<table class="table table-bordered">
							<?php foreach ($adr as $adr): ?>
							<tr>
								<td>Адрес № <?= $adr['id_address']?></td>
								<td>г. <?= $adr['city']?></td>
								<td><?= $adr['address']?></td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
			</div>
		  </div>
		  <div class="col-md-3">
		  <div class="panel">
				<div class="panel-body">
						<?php 
							$info = get_info();
						?>
						<div class="page-header">
							<h3>О компании:</h3>
						</div>
						<?php foreach ($info as $info): ?>
					      
					        <p><h4><?= $info['organization_name']?></h4></p>
					      <p><h5><i>&nbsp;<br>
					        <i class="glyphicon glyphicon-briefcase"></i>&nbsp;  <?= $info['org_address']?> <br>&nbsp;<br>
					        <i class="glyphicon glyphicon-phone-alt"></i>&nbsp; <?= $info['org_telephone_num']?> <br>&nbsp;<br>
					        <i class="glyphicon glyphicon-envelope"></i>&nbsp; <?= $info['email']?><br><br>
					        <i><b>Контактное лицо:</b></i>&nbsp; <?= $info['contact_agent']?>
					      </p></i></h5>
					     
						<?php endforeach; ?>
				  </div>
		  </div>
		  				  <!-- редактировать -->
					<button class="btn btn-primary btn-block btn-md" data-toggle="modal" data-target="#myModal">Редактировать информацию</button>
					<!-- Модальное окно -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
					  <div class="modal-dialog modal-lg">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Редактировать информацию</h4>
						  </div>
						  <div class="modal-body">
						  <!-- инфо об организации -->
							<form class="form-horizontal" action="client-d.php" method="post">
							<legend>Информация об организации:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Юр.адрес организации: </label>
							  <div class="col-md-7">
								  <input type = 'text' class="form-control"  name = 'org_address' placeholder="<?= $info['org_address']?>" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Телефон: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'org_tel' placeholder="<?= $info['org_telephone_num']?>" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие:</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'up_info' value = 'Редактировать информацию' />
							  </div>
							</div>
							</form>

														<!-- добавить адрес -->
							<form class="form-horizontal" action="client-d.php" method="post">
							<legend>Добавить адрес доставки:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Введите город: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'gorod' placeholder="Город" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Введите адрес: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'address_up' placeholder="улица, дом(корпус)"/>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие:</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'up_adr' value = 'Добавить адрес' />
							  </div>
							</div>
							</form>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
						  </div>
						</div>
					  </div>
					</div>
		  </div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>