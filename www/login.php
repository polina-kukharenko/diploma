<?php
	require "db.php";

	$data = $_POST;
	if (isset($data['enter'])) {
		// войти
		$errors = array();
		$user = R::findOne('users','login = ?', array($data['login']));
		if ($user) {
			//логин существует
			if (md5($data['password']) == $user->password) {
				//всё хорошо, логиним пользователя
				$_SESSION['logged_user'] = $user;
				if ($user->role == 2) {
					$_SESSION['idclient'] = $user->id;
					header('Location: client.php');
				}
				if ($user->role == 1){
					$_SESSION['idmanager'] = $user->id;
					header('Location: manager.php');
				}
				if ($user->role == 0){
					$_SESSION['idadmin'] = $user->id;
					header('Location: admin.php');
				}
			}
			else {
				$errors[] = 'Пароль введён неверно!';
			}
		}
		else {
			$errors[] = 'Пользователь с таким логином не найден!';
		}

		if ( ! empty($errors)) {
				$_SESSION['err'] = 'Ошибочка!';
				header('Location: /index.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>