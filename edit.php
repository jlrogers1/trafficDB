<html>
<body>
<?php
include('config.php');
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$intersection=$_POST['intersection'];
$month=$_POST['month'];
$day=$_POST['day'];
$year=$_POST['year'];
$time=$_POST['time'];
$query3=mysql_query("UPDATE `trafficDB`.`reservations` SET `intID`='$intersection', `timeID`='$time', `monthID`='$month', `dayID`='$day', `yearID`='$year', `timeID`='$time' WHERE `resID`='$id';");
if($query3)
{
header('location:reserve.php');
}
}
$query1=mysql_query("SELECT `reservations`.`resID`, `reservations`.`userID`, `reservations`.`intID`, `reservations`.`timeID`, `reservations`.`yearID`, `reservations`.`monthID`, `reservations`.`dayID`, `intersections`.`intName`, `times`.`timeSlot`, `years`.`yearName`, `months`.`monthName`, `days`.`dayName` FROM `trafficDB`.`reservations`, `trafficDB`.`intersections`, `trafficDB`.`times`, `trafficDB`.`months`, `trafficDB`.`days`, `trafficDB`.`years` WHERE `reservations`.`intID` = `intersections`.`intID` AND `reservations`.`timeID` = `times`.`timeID` AND `reservations`.`monthID` = `months`.`monthID` AND `reservations`.`dayID` = `days`.`dayID` AND `reservations`.`yearID` = `years`.`yearID` AND `reservations`.`resID`='$id';");
$query2=mysql_fetch_array($query1);
?>
<form method="post" action="">
<table>
<tr>
<td>Intersection</td>
<td>
<select name="intersection" id="intersection" style="width:100%;">
<?php 
$intersections = mysql_query("SELECT `intersections`.`intID`,`intersections`.`intName` FROM `trafficDB`.`intersections` ORDER BY `intID`;");
while ($row = mysql_fetch_array($intersections)){
	if ($row['intName'] == $query2['intName']){
		echo "<option value=".$row['intID']." selected>" . "(", $row['intID'], ") ",$row['intName'] . "</option>";
	} else {
		echo "<option value=".$row['intID'].">" . "(", $row['intID'], ") ",$row['intName'] . "</option>";
	}
}
?>
</select>
</td>
</tr>
<tr>
<td>Month</td>
<td> <!--<input type="text" name="month" value="<?php echo $query2['monthName']; ?>" />-->
<select name="month" id="month" style="width:100%;">
<?php 
$months = mysql_query("SELECT `months`.`monthID`,`months`.`monthName` FROM `trafficDB`.`months` ORDER BY `monthID`;");
while ($row = mysql_fetch_array($months)){
	if ($row['monthName'] == $query2['monthName']){
		echo "<option value=".$row['monthID']." selected>".$row['monthName']."</option>";
	} else {
		echo "<option value=".$row['monthID'].">".$row['monthName']."</option>";
	}
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
	if ($row['dayName'] == $query2['dayName']){
		echo "<option value=".$row['dayID']." selected>".$row['dayName']."</option>";
	} else {
		echo "<option value=".$row['dayID'].">".$row['dayName']."</option>";
	}
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
	if ($row['yearName'] == $query2['yearName']){
		echo "<option value=".$row['yearID']." selected>".$row['yearName']."</option>";
	} else {
		echo "<option value=".$row['yearID'].">".$row['yearName']."</option>";
	}
}
?>
</select>
</td>
</tr>
<td>Time</td>
<td>
<select name="time" id="time" style="width:100%;">
<?php 
$time = mysql_query("SELECT `times`.`timeID`,`times`.`timeSlot` FROM `trafficDB`.`times` ORDER BY `timeID`;");
while ($row = mysql_fetch_array($time)){
	if ($row['timeSlot'] == $query2['timeSlot']){
		echo "<option value=".$row['timeID']." selected>".$row['timeSlot']."</option>";
	} else {
		echo "<option value=".$row['timeID'].">".$row['timeSlot']."</option>";
	}
}
?>
</select>
</td>
</tr>
<table>
<input type="submit" name="submit"/>
<input type="button" onclick="window.location.href='reserve.php'" value="Cancel"/>
</form>
<?php
}
?>
</body>
</html>