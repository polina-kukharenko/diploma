<?php 
	require "db.php";
	require "libs/functions.php";
		$id_user = $_SESSION['read_client_info'];
	if (isset($_POST['up_info'])){
		$org_name = htmlspecialchars($_POST['org_name']);
		$org_address = htmlspecialchars($_POST['org_address']);
		$org_tel = htmlspecialchars($_POST['org_tel']);
		$bad = false;

		if((strlen($org_name) == 0) || (strlen($org_address) == 0) || (strlen($org_tel) == 0)){
			$_SESSION['error_red_manager'] = 1;
			$bad = true;
		} 

		if (!$bad){
			$mysqli = connectDB();
			$mysqli->query("INSERT INTO `info_users`(`id`, `organization_name`, `org_address`, `org_telephone_num`) 
				VALUES ('$id_user', '$org_name', '$org_address', '$org_tel')");
			closeDB($mysqli);
			$_SESSION['red_success_manager'] = 1;
			header('Location: /manager.client_info.php');
		}
	}
	if (isset($_POST['up_dog'])){
		$date_start = htmlspecialchars($_POST['date_start']);
		$res = htmlspecialchars($_POST['res']);
		$uslovie = htmlspecialchars($_POST['uslovie']);
		$bad = false;

		if((strlen($res) == 0) || (strlen($uslovie) == 0) || (strlen($date_start) < 10)){
			$_SESSION['error_red_manager'] = 1;
			$bad = true;
		} 

		if (!$bad){
			$mysqli = connectDB();
			$mysqli->query("INSERT INTO `dogovors`(`id_user`, `id_resurs`, `date_start`, `uslovie`, `status_dogovor`) 
				VALUES ('$id_user', '$res', '$date_start', '$uslovie', 1)");
			closeDB($mysqli);
			$_SESSION['red_success_manager'] = 1;
			header('Location: /manager.client_info.php');
		}
	}
	if (isset($_POST['up_adr'])){
		$gorod = htmlspecialchars($_POST['gorod']);
		$address_up = htmlspecialchars($_POST['address_up']);
		$bad = false;

		if((strlen($gorod) == 0) || (strlen($address_up) == 0)){
			$_SESSION['error_red_manager'] = 1;
			$bad = true;
		} 

		if (!$bad){
			$mysqli = connectDB();
			$mysqli->query("INSERT INTO `addresses`(`id_user`, `city`, `address`) 
				VALUES ('$id_user', '$gorod', '$address_up')");
			closeDB($mysqli);
			$_SESSION['red_success_manager'] = 1;
			header('Location: /manager.client_info.php');
		}
	}

	if (isset($_POST['activ'])){
		$list = $_POST['list'];
		$mysqli = connectDB();
		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE dogovors SET status_dogovor = 1 WHERE no_dogovor_id = '$value'");
				}
				header('Location: /manager.client_info.php');
		} else {header('Location: /manager.client_info.php');}
		closeDB($mysqli);
		}
	if (isset($_POST['deactiv'])){
			$list = $_POST['list'];
		$mysqli = connectDB();
		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE dogovors SET status_dogovor = 2 WHERE no_dogovor_id = '$value'");
				}
				header('Location: /manager.client_info.php');
		} else {header('Location: /manager.client_info.php');}
		closeDB($mysqli);
		}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Информация о клиенте - ОАО "Осколнефтеснаб"</title>
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
								<!-- сообщение об ошибке-->
						  	<?php
								if ($_SESSION['error_red_manager'] == 1) {echo '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Ошибка! Не все поля были заполнены, либо заполнены некорректно, повторите попытку.</div>';
								unset($_SESSION['error_red_manager']);}
								if ($_SESSION['red_success_manager'] == 1) {echo '<br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Изменения внесены успешно!</div>';
								unset($_SESSION['red_success_manager']);}
							?>
			  <div class="panel-body">
				<?php 
					$dog = get_dogovors1();
					$adr = get_address1();
					$inf = get_info1();
				?>
				<div class="panel-body">
						<div class="page-header">
							<h3>Договоры (<?= count($dog) ?>):</h3>
						</div>
						<form action="manager.client_info.php" name="active" method="post">
							<table class="table table-bordered">
							<?php foreach ($dog as $dog): ?>
								<tr>
									<td><input type="checkbox" name="list[]" value="<?= $dog['no_dogovor_id']?>"></td>
									<td>Договор № <?= $dog['no_dogovor_id']?></td>
									<td>Начало: <?= $dog['date_start']?></td>
									<td>Топливо: <?= $dog['resurs_name']?></td>
									<td>Макс. <?= $dog['uslovie']?> л.</td>
									<?php if ($dog['status_dogovor'] == 'Неактивный'): ?>
										<?php $info = 'default'; ?>
									<td><span class="label label-<?= $info ?>"><?= $dog['status_dogovor']?></span></td>
									<?php elseif ($dog['status_dogovor'] == 'Активный'): ?>
										<?php $info = 'success'; ?>
									<td><span class="label label-<?= $info ?>"><?= $dog['status_dogovor']?></span></td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
							</table>
						<table>
							<tr>
							    <td><input type = 'submit' class="btn btn-success" name = 'activ' value = 'Активировать' />&nbsp;</td>
							    <td><input type = 'submit' class="btn btn-default" name = 'deactiv' value = 'Деактивировать' />&nbsp;</td>
							</tr>
						</table>
						</form>
				  </div>
				  <div class="panel-body">
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
		  </div>
		  <div class="col-md-3">
		  <div class="panel">
				<div class="panel-body">
						<div class="page-header">
							<h3>О компании:</h3>
						</div>
						<?php foreach ($inf as $inf): ?>
					        <p><h4><?= $inf['organization_name']?></h4></p>
					      <p><h5><i>&nbsp;<br>
					        <i class="glyphicon glyphicon-briefcase"></i>&nbsp;  <?= $inf['org_address']?> <br>&nbsp;<br>
					        <i class="glyphicon glyphicon-phone-alt"></i>&nbsp; <?= $inf['org_telephone_num']?> <br>&nbsp;<br>
					        <i class="glyphicon glyphicon-envelope"></i>&nbsp; <?= $inf['email']?><br><br>
					        <i><b>Контактное лицо:</b></i>&nbsp; <?= $inf['contact_agent']?>
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
							<h4 class="modal-title" id="myModalLabel">Добавить информацию о клиенте</h4>
						  </div>
						  <div class="modal-body">
						  <!-- инфо об организации -->
							<form class="form-horizontal" action="manager.client_info.php" method="post">
							<legend>Информация об организации:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Наименование организации:</label>
							  <div class="col-md-7">
								  <input type = 'text' class="form-control"  name = 'org_name' placeholder="Наименование организации (полное или сокращенное)" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Юр.адрес организации: </label>
							  <div class="col-md-7">
								  <input type = 'text' class="form-control"  name = 'org_address' placeholder="улица, дом(корпус), населенный пункт, область" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Телефон: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'org_tel' placeholder="формат: 8(123)456-78-90" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие:</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'up_info' value = 'Добавить информацию' />
							  </div>
							</div>
							</form>
							<!-- добавить договор -->
							<form class="form-horizontal" action="manager.client_info.php" method="post">
							<legend>Добавить договор клиенту:</legend>
							<div class="form-group">
							  <label class="col-md-4 control-label">Введите дату начала договора: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'date_start' placeholder="формат: гггг-мм-дд" />
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Выберите ГСМ: </label>
							  <div class="col-md-4">
								  <select class="form-control" name="res" >
									  <option value="1">92</option>
									  <option value="2">95</option>
									  <option value="3">98</option>
									  <option value="4">ДТ</option>
									</select>	
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label">Введите максимальное количество ГСМ на поставку: </label>
							  <div class="col-md-4">
								  <input type = 'text' class="form-control"  name = 'uslovie' placeholder="литров"/>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие:</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'up_dog' value = 'Добавить договор' />
							  </div>
							</div>
							</form>
														<!-- добавить адрес -->
							<form class="form-horizontal" action="manager.client_info.php" method="post">
							<legend>Добавить адрес клиенту:</legend>
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