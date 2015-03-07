<?php
	$inputuser = $_POST['user'];
	$inputpass = $_POST['pass'];
	
	if($inputuser&&$inputpass) {
		require_once('config.php');
		$authresult = mysql_query("SELECT `users`.`userID`, `users`.`userName`, `users`.`userPass` FROM `trafficDB`.`users` WHERE `users`.`userName` = '$inputuser' AND `users`.`userPass` = '$inputpass';");
		$autharray = mysql_fetch_array($authresult);
		$serverID = $autharray["userID"];
		$serveruser = $autharray["userName"];
		$serverpass = $autharray["userPass"];
		mysql_close();
		
		if ($inputuser == $serveruser && $inputpass == $serverpass){
			session_start();
			$_SESSION['ID'] = $serverID;
			$_SESSION['UN'] = $serveruser;
			header("Location: reserve.php");
			} else {
			header("Location: fail.php");
		}
		} else {
		header("Location: fail.php");
	}
?>