<?php

function connectDB(){
		return new mysqli("localhost", "test", "test", "test");
	}

function closeDB($mysqli){
		$mysqli->close();
	}

//функции админа
function admin_delete_managers($list){
		$mysqli = connectDB();
		$id = $_SESSION['idadmin'];
		$mysqli->query("DELETE FROM `users` WHERE `id` = '$list'");
		closeDB($mysqli);
		header('Location: /admin.php');
}

function get_managers(){
		$mysqli = connectDB();
		$id = $_SESSION['idadmin'];
		$query = "SELECT `users`.id, `users`.login, `users`.email, `info_users`.contact_agent FROM `users` LEFT OUTER JOIN `info_users` ON `users`.id = `info_users`.id WHERE `users`.role = 1 ORDER BY `users`.id DESC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_manager_info(){
		$mysqli = connectDB();
		$id = $_SESSION['info_manager_id'];
		$query = "SELECT `users`.id, `users`.login, `users`.email, `info_users`.contact_agent FROM `users` LEFT OUTER JOIN `info_users` ON `users`.id = `info_users`.id WHERE `users`.role = 1 AND `users`.id = '$id' ORDER BY `users`.id DESC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function regManager($login, $password, $email, $name){
		$mysqli = connectDB();
		$mysqli->query("INSERT INTO users (`login`,`password`,`email`,`role`) VALUES ('$login','$password','$email', 1)");
		closeDB($mysqli);
		$mysqli = connectDB();
		header('Location: /admin.php');
}


//функции клиента
function get_dogovors() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `dogovors`.no_dogovor_id, `dogovors`.`id_user`, `resurs`.resurs_name, `dogovors`.date_start, `dogovors`.uslovie, `uslovia`.status_dogovor FROM `dogovors`, `resurs`, `uslovia` WHERE `dogovors`.id_resurs = `resurs`.id_resurs AND `dogovors`.status_dogovor = `uslovia`.ID_status_dogovor AND id_user = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_address() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `id_address`, `city`, `address` FROM `addresses` WHERE id_user = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_info() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `users`.id, `users`.login, `users`.email, `info_users`.organization_name, `info_users`.org_address, `info_users`.org_telephone_num,`info_users`.contact_agent FROM `users` LEFT OUTER JOIN `info_users` ON `users`.id = `info_users`.id WHERE `users`.id = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_orders() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `addresses`.id_user = '$id' AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) ORDER BY `orders`.date_post DESC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_orders_new() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `addresses`.id_user = '$id' AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status != 4";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_orders_ojid() {

		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `addresses`.id_user = '$id' AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status = 1";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function delete_orders_ojid($list){
		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("DELETE FROM `orders` WHERE `id_order` = '$value'");
				}
				header('Location: /client.ojid.php');
		} else {header('Location: /client.ojid.php');}
		closeDB($mysqli);
}

function new_order($dogovor, $tonn, $date, $address){
		$date_order = date('Y-m-d');
		$mysqli = connectDB();
		$mysqli->query("INSERT INTO orders (`dogovor`,`kolvo`,`date_order`,`date_post`,`status`,`address_ship`) VALUES ('$dogovor','$tonn','$date_order','$date', 1, '$address')");
		closeDB($mysqli);
}


//функции менеджера
function get_orders_manager_new() {

		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status = 1 ORDER BY `orders`.date_post ASC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_tek_orders_manager(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status != 4 ORDER BY `orders`.date_post ASC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_ready_orders_manager(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status = 4 ORDER BY `orders`.date_post ASC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function change_status_otpr($list){
		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 3 WHERE id_order = '$value'");
				}
				header('Location: /manager.tekorders.php');
		} else {header('Location: /manager.tekorders.php');}
		closeDB($mysqli);
}

function change_status_dost($list){
		$mysqli = connectDB();
		$id = $_SESSION['idclient'];

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 4 WHERE id_order = '$value'");
				}
				header('Location: /manager.tekorders.php');
		} else {header('Location: /manager.tekorders.php');}
		closeDB($mysqli);
}

function otmen_orders_ojid($list){
		$mysqli = connectDB();

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 7 WHERE id_order = '$value'");
				}
				header('Location: /manager.tekorders.php');
		} else {header('Location: /manager.tekorders.php');}
		closeDB($mysqli);
}



function client_group($list){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 2 WHERE id_order = '$value'");
				}
				header('Location: /manager.workwithorder.php');
		} else {header('Location: /manager.php');}
		closeDB($mysqli);
}

function auto_group_exit($work){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		if (is_array($work)) {
				foreach ($work as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 1 WHERE id_order = '$value'");
				}
				header('Location: /manager.workwithorder.php');
		} else exit('Это не массив');
		closeDB($mysqli);
}

function get_work_orders() {
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		
		$query = "SELECT `orders`.id_order,`orders`.dogovor, `resurs`.resurs_name,`orders`.kolvo,`orders`.date_order,`orders`.date_post,`addresses`.city, `addresses`.address,`status`.status_name FROM `orders`, `status`, `addresses`, `resurs` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status = 2 ORDER BY `orders`.kolvo ASC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_auto(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];

		$query = "SELECT `auto`.id_auto, `auto`.`number`, `auto`.sections, `auto`.volume, `drivers`.last_name_driver, `status_auto`.status_auto_name FROM `auto`, `drivers`, `status_auto` WHERE `auto`.driver = `drivers`.id_driver AND `auto`.status_auto = `status_auto`.id_status_auto";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();

}

function get_auto_with_trailers(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		
		$query = "SELECT `auto`.id_auto, `auto`.number, `auto`.sections, `auto`.volume, `trailers`.volume, `drivers`.last_name_driver, `status_auto`.status_auto_name FROM `auto`, `trailers`, `drivers`, `status_auto` WHERE  `auto`.id_auto = `trailers`.auto AND `auto`.driver = `drivers`.id_driver AND `auto`.status_auto = `status_auto`.id_status_auto";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_clients(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		$query = "SELECT `users`.id, `users`.login, `users`.email, `info_users`.organization_name, `info_users`.org_address, `info_users`.org_telephone_num FROM `users` LEFT OUTER JOIN `info_users` ON `users`.id = `info_users`.id WHERE `users`.role = 2 ORDER BY `users`.id DESC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_dogovors1() {

		$mysqli = connectDB();
		$id = $_SESSION['read_client_info'];

		$query = "SELECT `dogovors`.no_dogovor_id, `dogovors`.`id_user`, `resurs`.resurs_name, `dogovors`.date_start, `dogovors`.uslovie, `uslovia`.status_dogovor FROM `dogovors`, `resurs`, `uslovia` WHERE `dogovors`.id_resurs = `resurs`.id_resurs AND `dogovors`.status_dogovor = `uslovia`.ID_status_dogovor AND id_user = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_address1() {

		$mysqli = connectDB();
		$id = $_SESSION['read_client_info'];

		$query = "SELECT `id_address`, `city`, `address` FROM `addresses` WHERE id_user = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function get_info1() {

		$mysqli = connectDB();
		$id = $_SESSION['read_client_info'];

		$query = "SELECT `users`.id, `users`.login, `users`.email, `info_users`.organization_name, `info_users`.org_address, `info_users`.org_telephone_num,`info_users`.contact_agent FROM `users` LEFT OUTER JOIN `info_users` ON `users`.id = `info_users`.id WHERE `users`.id = '$id'";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}



function get_user_info($id_user){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		$query = "SELECT `users`.id, `users`.login, `users`.email FROM `users`WHERE `users`.role = 2";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function regUser($login, $password, $email){
		$mysqli = connectDB();
		$mysqli->query("INSERT INTO users (`login`,`password`,`email`,`role`) VALUES ('$login','$password','$email', 2)");
		closeDB($mysqli);
		header('Location: /manager.client-list.php');
}

//модель
function auto_group($work){
		$mysqli = connectDB();	
		$query = "SELECT `orders`.id_order, `orders`.kolvo, `orders`.date_post  FROM `orders` WHERE `orders`.status = 2 ORDER BY `orders`.kolvo ASC";
		$result = $mysqli->query($query);
		$orders = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);

		foreach ($orders as $key) {
			if ($key['kolvo'] >= 6500 and  $key['kolvo'] < 8500) {
				group_s($key['id_order'], $key['kolvo'], $key['date_post']);
			}
			else{
				if ($key['kolvo'] >= 8500 and  $key['kolvo'] < 11500) {
					group_m($key['id_order'], $key['kolvo'], $key['date_post']);
				}
				else{
					if ($key['kolvo'] >= 11500 and  $key['kolvo'] < 16695) {
						group_l($key['id_order'], $key['kolvo'], $key['date_post']);
					}
				}
			}
		}
		//очистить поля S
		$mysqli = connectDB();
		$mysqli->query("UPDATE `auto` SET `S`= 0");
		$mysqli->query("UPDATE `trailers` SET `P`= 0");
		closeDB($mysqli);
		header('Location: /manager.newzayav.php');
}

//группа S
function group_s($id, $z, $d){
		unset($_SESSION['m7']);
		unset($_SESSION['m8']);

		if ($z > 6500 and  $z < 7500) {
			$mysqli = connectDB();
			$query = "SELECT `S` FROM `auto` WHERE id_auto = 8";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count8 = (int) $result;
			if ($s['S'] < 4) {
				$mysqli = connectDB();
				$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (8,'$id','$d')");
				$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
				++$count8;
				$mysqli->query("UPDATE `auto` SET `S`= '$count8' WHERE id_auto = 8");
				closeDB($mysqli);
				$result->free();
			} else{
				$_SESSION['m8'] = 'Null';
			}
		} else{
			if ($z > 7499 and  $z < 8500) {
				$mysqli = connectDB();
				$query = "SELECT `S` FROM `auto` WHERE id_auto = 9";
				$result = $mysqli->query($query); 
				$s = $result->fetch_all(MYSQLI_ASSOC);
				closeDB($mysqli);
				$count9 = (int) $result;
				if ($s['S'] < 3) {
					$mysqli = connectDB();
					$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (9,'$id','$d')");
					$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
					++$count9;
					$mysqli->query("UPDATE `auto` SET `S`= '$count9' WHERE id_auto = 9");
					closeDB($mysqli);
					$result->free();
				} else{
					$mysqli = connectDB();
					$query = "SELECT `S` FROM `auto` WHERE id_auto = 7";
					$result = $mysqli->query($query); 
					$s = $result->fetch_all(MYSQLI_ASSOC);
					closeDB($mysqli);
					$count7 = (int) $result;
					if ($s['S'] < 3) {
						$mysqli = connectDB();
						$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (7,'$id','$d')");
						$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
						++$count7;
						$mysqli->query("UPDATE `auto` SET `S`= '$count7' WHERE id_auto = 7");
						closeDB($mysqli);
						$result->free();
					}else{
						$_SESSION['m7'] = 'Null';
					}
				}
			}
		}
}
//группа M
function group_m($id, $z, $d){
		unset($_SESSION['m5']);
		unset($_SESSION['m6']);
		unset($_SESSION['m10']);
		unset($_SESSION['m10s']);
		unset($_SESSION['m5s']);

		if ($z > 8499 and  $z < 8700) {
			$mysqli = connectDB();
			$query = "SELECT `P` FROM `trailers` WHERE auto = 5";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count5 = (int) $result;
			if ($s['P'] < 1) {
				$mysqli = connectDB();
				$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (5,'$id','$d')");
				$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
				++$count5;
				$mysqli->query("UPDATE `trailers` SET `P`= '$count5' WHERE auto = 5");
				closeDB($mysqli);
				$result->free();
			} else{
				$mysqli = connectDB();
				$query = "SELECT `P` FROM `trailers` WHERE auto = 6";
				$result = $mysqli->query($query); 
				$s = $result->fetch_all(MYSQLI_ASSOC);
				closeDB($mysqli);
				$count6 = (int) $result;
				if ($s['P'] < 1) {
					$mysqli = connectDB();
					$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (6,'$id','$d')");
					$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
					++$count6;
					$mysqli->query("UPDATE `trailers` SET `P`= '$count6' WHERE auto = 6");
					closeDB($mysqli);
					$result->free();
				}else{
					$_SESSION['m5'] = 'Null';
					$_SESSION['m6'] = 'Null';
				}
			}
		}else{
			if ($z > 8699 and  $z < 9999) {
			$mysqli = connectDB();
			$query = "SELECT `P` FROM `trailers` WHERE auto = 10";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count10 = (int) $result;
			if ($s['P'] < 1) {
				$mysqli = connectDB();
				$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (10,'$id','$d')");
				$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
				$count10 = $count10 + 1;
				$mysqli->query("UPDATE `trailers` SET `P`= '$count10' WHERE auto = 10");
				closeDB($mysqli);
				$result->free();
			} else{
				$_SESSION['m10'] = 'Null';
			}
		}else{
			if ($z > 9999 and  $z < 11500) {
			$mysqli = connectDB();
			$query = "SELECT `S` FROM `auto` WHERE id_auto = 5";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count5s = (int) $result;
			if ($s['S'] < 2) {
				$mysqli = connectDB();
				$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (5,'$id','$d')");
				$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
				$count5s = $count5s + 2; //+2
				$mysqli->query("UPDATE `auto` SET `S`= '$count5s' WHERE id_auto = 5");
				closeDB($mysqli);
				$result->free();
			}else{
				$mysqli = connectDB();
				$query = "SELECT `S` FROM `auto` WHERE id_auto = 6";
				$result = $mysqli->query($query); 
				$s = $result->fetch_all(MYSQLI_ASSOC);
				closeDB($mysqli);
				$count6s = (int) $result;
				if ($s['S'] < 2) {
					$mysqli = connectDB();
					$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (6,'$id','$d')");
					$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
					$count6s = $count6s + 2; //+2
					$mysqli->query("UPDATE `auto` SET `S`= '$count6s' WHERE id_auto = 6");
					closeDB($mysqli);
					$result->free();
					}else{
						$mysqli = connectDB();
						$query = "SELECT `S` FROM `auto` WHERE id_auto = 10";
						$result = $mysqli->query($query); 
						$s = $result->fetch_all(MYSQLI_ASSOC);
						closeDB($mysqli);
						$count10s = (int) $result;
						if ($s['S'] < 2) {
							$mysqli = connectDB();
							$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (10,'$id','$d')");
							$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
							$count10s = $count10s + 2; //+2
							$mysqli->query("UPDATE `auto` SET `S`= '$count10s' WHERE id_auto = 10");
							closeDB($mysqli);
							$result->free();
						}else{
							$_SESSION['m10s'] = 'Null';
						}
					}
				}
			}else{
				$_SESSION['m5s'] = 'Null';
			}
		}
	}
}
//группа L
function group_l($id, $z, $d){
		unset($_SESSION['m1']);
		unset($_SESSION['m2']);
		unset($_SESSION['m8l']);
		

		if ($z > 11499 and  $z < 12000) {
			$mysqli = connectDB();
			$query = "SELECT `S` FROM `auto` WHERE id_auto = 2";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count2 = (int) $result;
			if ($s['S'] < 2) {
				$mysqli = connectDB();
				$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (2,'$id','$d')");
				$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
				$count2 = $count2 + 1; 
				$mysqli->query("UPDATE `auto` SET `S`= '$count2' WHERE id_auto = 2");
				closeDB($mysqli);
				$result->free();
			}else{
				$_SESSION['m2'] = 'Null';
			}
		}else{
			if ($z > 11999 and  $z < 14500) {
			$mysqli = connectDB();
			$query = "SELECT `S` FROM `auto` WHERE id_auto = 8";
			$result = $mysqli->query($query); 
			$s = $result->fetch_all(MYSQLI_ASSOC);
			closeDB($mysqli);
			$count8 = (int) $result;
				if ($s['S'] < 4) {
					$mysqli = connectDB();
					$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (8,'$id','$d')");
					$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
					$count8 = $count8 + 2; 
					$mysqli->query("UPDATE `auto` SET `S`= '$count8' WHERE id_auto = 8");
					closeDB($mysqli);
					$result->free();
					}else{
						$_SESSION['m8l'] = 'Null';
					}
				}else{
					if ($z > 14499 and  $z < 16695) {
						$mysqli = connectDB();
						$query = "SELECT `S` FROM `auto` WHERE id_auto = 1";
						$result = $mysqli->query($query); 
						$s = $result->fetch_all(MYSQLI_ASSOC);
						closeDB($mysqli);
						$count1 = (int) $result;
						if ($s['S'] < 2) {
							$mysqli = connectDB();
							$mysqli->query("INSERT INTO `shipping` (`id_auto`,`id_order`,`date_post_index`) VALUES (1,'$id','$d')");
							$mysqli->query("UPDATE orders SET status = 5 WHERE id_order = '$id'");
							$count1 = $count1 + 1; 
							$mysqli->query("UPDATE `auto` SET `S`= '$count1' WHERE id_auto = 1");
							closeDB($mysqli);
							$result->free();
							}else{
								$_SESSION['m1'] = 'Null';
							}
					}
				}
			}
}
//после распределения
function get_shipping_zayav(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		$query = "SELECT `orders`.id_order, `resurs`.resurs_name,`orders`.kolvo, `orders`.date_post,`addresses`.city, `addresses`.address, `auto`.volume FROM `orders`, `status`, `addresses`, `resurs`, `auto` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status = 5 AND `auto`.id_auto = (SELECT id_auto FROM shipping WHERE `orders`.id_order = `shipping`.id_order)";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

function form_Za($list, $date_post){
		$mysqli = connectDB();
		$date_post = (string) $date_post;
		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 6 WHERE id_order = '$value'");
				}

				//сообщение
				$message = "Поступила новая заявка на поставку ГСМ\r\nПросмотрите заявку здесь: ons-orders.ru";
				$to = "samanthared@yandex.ru";
				$from = "ons_zayavka@yandex.ru";
				$subject = "Поступила новая заявка на поставку ГСМ";
				$headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8";
				mail($to, $subject, $message, $headers); 

				header('Location: /manager.Za.php');
		} else exit('Это не массив');
		closeDB($mysqli);
}

function otmena_Za($list){
		$mysqli = connectDB();

		if (is_array($list)) {
				foreach ($list as $key => $value) {
				$mysqli->query("UPDATE orders SET status = 1 WHERE id_order = '$value'");
				$mysqli->query("DELETE FROM shipping WHERE id_order = '$value'");
				}
				header('Location: /manager.php');
		} else exit('Это не массив');
		closeDB($mysqli);
}

function get_date_post(){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		$query = "SELECT DISTINCT date_post_index FROM `shipping` ORDER BY date_post_index DESC";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}





//документы
//Заявка на поставку
function get_shipping_zayav1($date){
		$mysqli = connectDB();
		$id = $_SESSION['idmanager'];
		$query = "SELECT `orders`.id_order, `resurs`.resurs_name,`orders`.kolvo, `orders`.date_post,`addresses`.city, `addresses`.address, `auto`.volume FROM `orders`, `status`, `addresses`, `resurs`, `auto` WHERE `orders`.status = `status`.id_status AND `orders`.address_ship = `addresses`.id_address AND `resurs`.id_resurs = (SELECT id_resurs FROM dogovors WHERE no_dogovor_id = `orders`.dogovor) AND `status`.id_status != 1 AND `status`.id_status != 2 AND `status`.id_status != 7 AND `auto`.id_auto = (SELECT id_auto FROM shipping WHERE `orders`.id_order = `shipping`.id_order) AND `orders`.date_post = '$date' ORDER BY `orders`.kolvo";
		$result = $mysqli->query($query);
		$row = $result->fetch_all(MYSQLI_ASSOC);
		closeDB($mysqli);
		return $row;
		$result->free();
}

?>