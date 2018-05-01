<?php
	require "db.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ОАО "Осколнефтеснаб" - Главная</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
      <style>
		.body {
			 background: url(img/фон.jpg);
		}
		.footer {

	    bottom: 0;
	    left: 0;
	    right: 0;
	    height: 50px;
	    text-align: center;
		}

		footer p {
	    padding: 10.5px;
	    margin: 0px;
	    line-height: 100%;
		}
    </style>
<body class="body">
	<div class="container" style="margin-top: 50px;">
	<div class="row">
		<!-- Форма ввода -->
		<div class="col-md-3">
			<div class="well span offset3" style="margin-top: 0px;">
				<center><img src="img/лого без палочки.png" width="206" height="88"></center>
				
				<form id='login' action = 'login.php' method = 'post'>
				<br>
					<input type = 'text' class="form-control" placeholder="Введите логин"  name = 'login' /><p></p>
					<input type = 'password' class="form-control" placeholder="Введите пароль"  name = 'password'/><p></p>
					<button type = 'submit' name="enter" class="btn btn-primary btn-block">Войти</button>
				</form>
				<?php
					if ($_SESSION['err']) {
					echo '<br><div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Ошибка авторизации!</div>';
					unset($_SESSION['err']);
					} 
				?>
				<hr>
				<!-- как зарегистрироваться? -->
					<button class="btn btn-default btn-block btn-md" data-toggle="modal" data-target="#myModal">Как зарегистрироваться?</button>
					<!-- Модальное окно -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Как зарегистрироваться?</h4>
						  </div>
						  <div class="modal-body">
							Чтобы начать совершать онлайн-заказы ГСМ необходимо заключить договор с нашей компанией.<br> Заключить договор можно по адресу: г. Старый Оскол, м-н Приборостроитель, 54.<br> Чтобы получить дополнительную информацию позвоните нам: 8-(800)-800-80-80
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Понятно</button>
						  </div>
						</div>
					  </div>
					</div>
			</div>
		</div>
		<!-- Тело с информацией -->
		<div class="col-md-9">
			  <center><img src="img/mash4.png" width="884" height="367"></center>
		</div>
		</div>
	</div>
	<div class="container" style="margin-top: 40px;">
			<table class="table">
			    <tr>
			        <td width="300"><center><img src="img/garantia.png" width="150" height="120"><br><p style="color: white;">Где купить топливо оптом? Какой компанией может быть гарантирована поставка качественного топлива? Поиски ведутся всеми в разных направлениях, но многие дороги приводят к нам, в ОАО «Осколнефтеснаб».</p></center></td>
			        <td width="300"><center><img src="img/dost.png" width="100" height="100"><br><br><p style="color: white;">Мы осуществляем самовывоз и доставляем продукцию напрямую заказчикам на бензовозах из своего автопарка. Это позволяет нам не искать сторонних подрядчиков и экономить в том числе и ваши средства.</p></center></td>
			        <td width="300"><center><img src="img/kontrakt.png" width="100" height="100"><br><br><p style="color: white;">Мы готовы заключить с фирмой долгосрочный контракт. И у вас не будет болеть голова, где найти добросовестного партнера — ведь мы всегда выполняем свои обязательства по договору предельно точно.</p></center></td>
			        <td width="300"><center><img src="img/testir.png" width="100" height="100"><br><br><p style="color: white;">Мы всегда тестируем и внимательно проверяем произведенную продукцию, жестко отслеживаем ее состав и качество, соответствие евростандартам, экологичность, безопасность для машины, человека и окружающей среды.</p></center></td>
			        <td width="300"><center><img src="img/garantia.png" width="150" height="120"><br><p style="color: white;">Компания «Осколнефтеснаб» предлагает своим заказчикам самое надежное и безопасное топливо и гарантирует прозрачные условия контракта, доставку продукции в срок и идеальную заправку вашим клиентам.</p></center></td>
			    </tr>
			</table>
	</div>
	<footer class="footer">
	<div>
		<hr>
		<p style="color: white;">ОАО «Осколнефтеснаб» © 2017 &nbsp;&nbsp;&nbsp;
        <a style="color: white;" href="#">О компании</a>&nbsp;
        <a style="color: white;" href="#">Контакты</a>&nbsp;
        <a href = "https://vk.com/azsons"><img src="img/vk.com1600.png" width="35" height="35" title="Наша группа ВКонтакте"></a></p>
	</div>
    </footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>