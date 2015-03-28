<?php
	session_start();
	$userID = $_SESSION['ID'];
	$userName = $_SESSION['UN'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TrafficDB - <?= $userName;?></title>
		<style>
			body{
			y-overflow: hidden;
			background-color: #3A6EA5;
			<!--background: url(images/bg.jpg);
			background-size: 1940px 1080px;-->
			}
			.outer {
			display: table;
			position: absolute;
			height: 100%;
			width: 100%;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			}
			.middle {
			display: table-cell;
			vertical-align: middle;
			}
			.inner {
			margin-left: auto;
			margin-right: auto;	
			background-color: #C0C0C0;
			opacity: 0.9;
			}
			table, th, td {
			border: 1px solid grey;
			}
		</style>
	</style>
	<link rel="stylesheet" href="js/jquery-ui-1.11.2/jquery-ui.min.css">
	<script src="js/jquery-1.11.2/jquery-1.11.2.min.js"></script>
	<script src="js/jquery-ui-1.11.2/jquery-ui.min.js"></script>
</head>
<body>
	<div class="outer">
		<div class="middle">
			<div class="inner" align="center">
				<h2 style="color: #000000">Welcome to the TrafficDB,  <?= $userName;?>!</h2>
				<h3 style="color: #000000">YOUR CURRENT RESERVATIONS</h3>
				
				<?php
					require_once('config.php');
					$query1=mysql_query("SELECT `reservations`.`resID`, `reservations`.`userID`, `reservations`.`intID`, `reservations`.`timeID`, `reservations`.`yearID`, `reservations`.`monthID`, `reservations`.`dayID`, `intersections`.`intName`, `times`.`timeSlot`, `years`.`yearName`, `months`.`monthName`, `days`.`dayName` FROM `trafficDB`.`reservations`, `trafficDB`.`intersections`, `trafficDB`.`times`, `trafficDB`.`months`, `trafficDB`.`days`, `trafficDB`.`years` WHERE `reservations`.`intID` = `intersections`.`intID` AND `reservations`.`timeID` = `times`.`timeID` AND `reservations`.`monthID` = `months`.`monthID` AND `reservations`.`dayID` = `days`.`dayID` AND `reservations`.`yearID` = `years`.`yearID` AND `reservations`.`userID` = '$userID' AND `reservations`.`data` IS NULL;");
					echo "<table style=\"background-color:white;width:90%\"><tr><td><strong>Date</strong></td><td><strong>Time</strong></td><td><strong>Intersection</strong></td><td colspan=\"3\"><a href='add.php'>NEW RESERVATION</a></td>";
					$pretty=0;
					while($query2=mysql_fetch_array($query1))
					{
						if ($pretty % 2 == 0){
							echo "<tr style=\"background-color:#e8e8e8\"><td>".$query2['dayName'],"-",$query2['monthName'],"-",$query2['yearName']."</td>";
						}
						else {
							echo "<tr style=\"background-color:#FFFFFF\"><td>".$query2['dayName'],"-",$query2['monthName'],"-",$query2['yearName']."</td>";
						}		
						echo "<td>".$query2['timeSlot']."</td>";
						echo "<td>"."(",$query2['intID'],") ",$query2['intName']."</td>";
						echo "<td><a href='upload.php?id=".$query2['resID']."'>Upload</a></td>";
						echo "<td><a href='edit.php?id=".$query2['resID']."'>Edit</a></td>";
						echo "<td><a href='delete.php?id=".$query2['resID']."' onclick=\"return confirm('Are you sure? Deleted reservations are gone FOREVER!\\n\\nDate: " .$query2['dayName'],"-",$query2['monthName'],"-",$query2['yearName']."\\nTime: ".$query2['timeSlot']."\\nLoc: "."(",$query2['intID'],") ",$query2['intName']."')\">Delete [X]</a></td></tr>";
						$pretty++;
					}
				?>
			</table>
			<h3 style="color: #000000">YOUR UPLOAD HISTORY</h3>
			<?php
				$query3=mysql_query("SELECT `reservations`.`resID`, `reservations`.`userID`, `reservations`.`intID`, `reservations`.`timeID`, `reservations`.`yearID`, `reservations`.`monthID`, `reservations`.`dayID`, `intersections`.`intName`, `times`.`timeSlot`, `years`.`yearName`, `months`.`monthName`, `days`.`dayName` FROM `trafficDB`.`reservations`, `trafficDB`.`intersections`, `trafficDB`.`times`, `trafficDB`.`months`, `trafficDB`.`days`, `trafficDB`.`years` WHERE `reservations`.`intID` = `intersections`.`intID` AND `reservations`.`timeID` = `times`.`timeID` AND `reservations`.`monthID` = `months`.`monthID` AND `reservations`.`dayID` = `days`.`dayID` AND `reservations`.`yearID` = `years`.`yearID` AND `reservations`.`userID` = '$userID' AND `reservations`.`data` IS NOT NULL;");
				echo "<table style=\"background-color:white;width:90%\"><tr><td><strong>Date</strong></td><td><strong>Time</strong></td><td><strong>Intersection</strong></td>";
				$pretty=0;
				while($query4=mysql_fetch_array($query3))
				{
					if ($pretty % 2 == 0){
						echo "<tr style=\"background-color:#e8e8e8\"><td>".$query4['dayName'],"-",$query4['monthName'],"-",$query4['yearName']."</td>";
					}
					else {
						echo "<tr style=\"background-color:#FFFFFF\"><td>".$query4['dayName'],"-",$query4['monthName'],"-",$query4['yearName']."</td>";
					}		
					echo "<td>".$query4['timeSlot']."</td>";
					echo "<td>"."(",$query4['intID'],") ",$query4['intName']."</td></tr>";
					$pretty++;
				}
				mysql_close();
			?>
		</table>
		<h3 style="color: #000000">TRAFFIC COUNT INSTRUCTIONS</h3>
		<iframe src="http://docs.google.com/gview?url=http://isoptera.lcsc.edu/~trafficDB/documents/traffic_count_instructions.pdf&embedded=true" style="width:718px; height:700px;" frameborder="0"></iframe>
	</div>
</div>
</div>
</body>
</html>