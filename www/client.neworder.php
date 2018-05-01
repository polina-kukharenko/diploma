<?php 
	require "db.php";
	require "libs/functions.php";

	if (isset($_POST['order'])){
		$dogovor = ($_POST['dogovor']);
		$tonn = htmlspecialchars($_POST['tonn']);
		$year = date('Y');
		$date = $year.'-'.$_POST['month'].'-'.$_POST['day'];
		$address = ($_POST['address']);
		$bad = false;

		if((strlen($dogovor) == 0) || (strlen($tonn) == 0) || (strlen($date) < 10) || strlen($address) == 0){
			$_SESSION['error_order'] = 1;
			$bad = true;
		} 

		if (!$bad){
			new_order($dogovor, $tonn, $date, $address);
			$_SESSION['order_success'] = 1;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет клиента - Новый заказ - ОАО "Осколнефтеснаб"</title>
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
					<div class="page-header">
						<?php
							if ($_SESSION['order_success'] == 1){ 
								echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Ваш заказ успешно осуществлен, отслеживайте статус на странице заказов.</div>';
								unset($_SESSION['order_success']);
							}
						?>
						<form class="form-horizontal" action = 'client.neworder.php' method = 'post'>
							<fieldset>
							<!-- Form Name -->
							<legend>Новый заказ:</legend>
							<!-- Выбор договора -->
							<div class="form-group">
							  <label class="col-md-4 control-label">Выберите договор</label><br><br>
							  <div class="col-md-12">
							    	<div class="panel-body">
										<?php 
											$row = get_dogovors();
										?>
											<table class="table table-bordered">
											<?php foreach ($row as $row): ?>
											    <tr>
											        <?php if ($row['status_dogovor'] == 'Неактивный'): ?>
														<?php $dis = 'disabled'; ?>
													<td><input type="radio" name="dogovor" value="<?= $row['no_dogovor_id']?>" <?= $dis ?>></td>
													<?php elseif ($row['status_dogovor'] == 'Активный'): ?>
														<?php $dis = ''; ?>
													<td><input type="radio" name="dogovor" value="<?= $row['no_dogovor_id']?>" <?= $dis ?>></td>
													<?php endif; ?>
											        <td>Договор № <?= $row['no_dogovor_id']?></td>
											        <td><?= $row['date_start']?></td>
											        <td>Топливо <?= $row['resurs_name']?></td>
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
							  </div>
							</div>
							<!-- Ввод количества-->
							<div class="form-group">
							  <label class="col-md-4 control-label">Введите количество</label>
							  <div class="col-md-3">
							  	<div class="input-group">
								  <input type="text" class="form-control" name="tonn">
								  <span class="input-group-addon">литров</span>
								</div>
							  </div>
							</div>

							<!-- Дата доставки-->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="textinput">Введите дату доставки</label>  
							  <div class="col-md-4">
								<table>
									<tr>
									    <td><input placeholder="дд" class="form-control" name="day"></td>
									    <td><input placeholder="мм" class="form-control" name="month"></td>
									    <td><input name="year" class="form-control" id="disabledInput" type="text" placeholder="<?php echo date('Y'); ?>" disabled></td>
									</tr>
								</table>
							  </div>
							</div>
							<!-- Выбор адреса -->
							<div class="form-group">
							  <label class="col-md-4 control-label">Выберите адрес доставки</label><br><br>
							  <div class="col-md-12">
							    	<div class="panel-body">
										<?php 
											$adr = get_address();
										?>
											<table class="table table-bordered">
											<?php foreach ($adr as $adr): ?>
											    <tr>
											        <td><input type="radio" name="address" value="<?= $adr['id_address']?>"></label></td>
											        <td>Адрес № <?= $adr['id_address']?></td>
											        <td>г. <?= $adr['city']?></td>
											        <td><?= $adr['address']?></td>
											    </tr>
											<?php endforeach; ?>
											</table>
								    </div>
							  </div>
							</div>
							<!-- Button (Double) -->
							<div class="form-group">
							  <label class="col-md-4 control-label" for="button1id">Действие</label>
							  <div class="col-md-8">
							    <input type = 'submit' class="btn btn-success" name = 'order' value = 'Сделать заказ' />
							    <input type = 'reset' class="btn btn-default" name = 'reset' value = 'Отмена' />
							  </div>
							</div>
							<?php
								if ($_SESSION['error_order'] == 1) echo '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Ошибка! Не все поля были заполнены, либо поля заполнены некорректно! Проверьте правильность заполнения и повторите попытку.</div>';
								unset($_SESSION['error_order']);
							?>
							</fieldset>
						</form>
					</div>
			  </div>
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="panel panel-default">
			  	<div class="list-group">
				  <a href="client.php" class="list-group-item">Все заказы</a>
				  <a href="client.tekorders.php" class="list-group-item">Текущие заказы</a>
				  <a href="client.ojid.php" class="list-group-item">Ожидают обработки</a>
				  <a href="client.neworder.php" class="list-group-item active">Новый заказ</a>
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