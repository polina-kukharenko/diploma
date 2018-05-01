<?php 
	require "db.php";
	require "libs/functions.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заявка - ОАО "Осколнефтеснаб"</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
<body>
<div class="container" style="margin-top: 80px; width: 700px;">
			<div class="panel-body">
							<?php 
								$zayav = get_shipping_zayav1($_SESSION['read_date']);
							?>
				<center>
				<form name="select_all_clients" method="post">
						<table>
						    <tr>
						        <td width="300px"></td>
						        <td width="300px"></td>
						        <td width="300px"></td>
						        <td width="300px"></td>
						        <td width="300px">
						        Cтаршему товарному оператору&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; ОАО "Осколнефтеснаб" Понкратовой Т. В.
						        </td>
						    </tr>
						</table>
						<br><br><br>
						<table>
						    <tr>
						        <td><center><b>ЗАЯВКА</b> на поставку ГСМ</center><br></td>
						    </tr>
						    <tr>
						        <td>
						        <table class="table table-bordered">
						        	<tr>
								        <td>Заказ</td>
								        <td>ГСМ</td>
								        <td>Количество</td>
								        <td>Адрес доставки</td>
								        <td>Калибровка, л</td>
								    </tr>
									<?php foreach ($zayav as $zayav): ?>
								    <tr>
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
						<br><br>
						<div align="right" style="margin-right: 80px;"><b>Дата:</b> <?= $zayav['date_post']?></div><br>
						<div align="right" style="margin-right: 80px;"><b>_________________________________</div>
						<br><br><br>
				</form>
				</center>
			  </div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>		  
</body>
</html>
