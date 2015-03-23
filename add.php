<html>
	<body>
		<?php
			session_start();
			$userID = $_SESSION['ID'];
			$sure=false;
			if(isset($_SESSION['SURE'])){
				$sure = $_SESSION['SURE'];
			} else {
				$_SESSION['SURE'] = false;
			}
			require_once('config.php');
			if(isset($_POST['submit']))
			{
				$intersection=$_POST['intersection'];
				$month=$_POST['month'];
				$day=$_POST['day'];
				$year=$_POST['year'];
				$time=$_POST['time'];				
				$query1=mysql_query("SELECT COUNT(`reservations`.`resID`) AS `total` FROM `trafficDB`.`reservations` WHERE `timeID`='$time' AND `monthID`='$month' AND `dayID`='$day' AND `yearID`='$year' AND `intID`='$intersection' AND `data` IS NULL;");
				$query2=mysql_query("SELECT `times`.`timeSlot` FROM `trafficDB`.`times` WHERE `timeID`='$time';");
				$query3=mysql_fetch_array($query2);
				while ($row = $check=mysql_fetch_array($query1)){
					if ($row['total'] < 1 or ($row['total'] >= 1 and $sure==true)){ //Temporary removal of limit
						$query4=mysql_query("INSERT INTO `trafficDB`.`reservations` (`resID`, `userID`, `intID`, `timeID`, `monthID`, `dayID`, `yearID`, `data`) VALUES (NULL, '$userID', '$intersection', '$time', '$month', '$day', '$year', NULL);");
						if($query4)
						{
							$_SESSION['SURE']=false;
							header("location:reserve.php");
						}
						} else {
						
						echo "{$row['total']} reservation(s) exist for that intersection at the chosen date and time.\r\nTo confirm, please reenter you reservation and submit again.";
						$_SESSION['SURE']=true;
					}
				}
			}
		?>
		<form method="post" action="add.php">
			<table>
				<tr>
					<td>Intersection</td>
					<td>
						<select name="intersection" id="intersection" style="width:100%;">
							<?php 
								$intersections = mysql_query("SELECT `intersections`.`intID`,`intersections`.`intName` FROM `trafficDB`.`intersections` ORDER BY `intID`;");
								while ($row = mysql_fetch_array($intersections)){
									echo "<option value=".$row['intID'].">" . "(", $row['intID'], ") ",$row['intName'] . "</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Month</td>
					<td>
						<select name="month" id="month" style="width:100%;">
							<?php 
								$months = mysql_query("SELECT `months`.`monthID`,`months`.`monthName` FROM `trafficDB`.`months` ORDER BY `monthID`;");
								while ($row = mysql_fetch_array($months)){
									echo "<option value=".$row['monthID'].">".$row['monthName']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Day</td>
					<td>
						<select name="day" id="day" style="width:100%;">
							<?php 
								$days = mysql_query("SELECT `days`.`dayID`,`days`.`dayName` FROM `trafficDB`.`days` ORDER BY `dayID`;");
								while ($row = mysql_fetch_array($days)){
									echo "<option value=".$row['dayID'].">".$row['dayName']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Year</td>
					<td>
						<select name="year" id="year" style="width:100%;">
							<?php 
								$years = mysql_query("SELECT `years`.`yearID`,`years`.`yearName` FROM `trafficDB`.`years` ORDER BY `yearID`;");
								while ($row = mysql_fetch_array($years)){
									echo "<option value=".$row['yearID'].">".$row['yearName']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time</td>
					<td>
						<select name="time" id="time" style="width:100%;">
							<?php 
								$time = mysql_query("SELECT `times`.`timeID`,`times`.`timeSlot` FROM `trafficDB`.`times` ORDER BY `timeID`;");
								while ($row = mysql_fetch_array($time)){
									echo "<option value=".$row['timeID'].">".$row['timeSlot']."</option>";
								}
							?>
						</select>
					</td>
				</tr>
			</table>
			<input type="submit" name="submit"/>
			<input type="button" onclick="window.location.href='reserve.php'" value="Cancel"/>
		</form>
		<div>
			<img src="images/hpints.jpg" alt="High Priority Intersections" style="width:1056px;height:816px">
		</div>
	</body>
</html>		