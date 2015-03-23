<html>
	<body>
		<?php
			require_once('config.php');
			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				$query1=mysql_query("DELETE FROM `trafficDB`.`reservations` WHERE `resID`='$id';");
				if($query1)
				{
					header('location:reserve.php');
				}
			}
			mysql_close();
		?>
	</body>
</html>