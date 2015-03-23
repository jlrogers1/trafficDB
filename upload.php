<html>
	<body>
		<?php
			require_once('config.php');
			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
				if(isset($_POST['submit']) && $_FILES['userfile']['size'] > 0)
				{
					$fileName = $_FILES['userfile']['name'];
					$tmpName  = $_FILES['userfile']['tmp_name'];
					$fileSize = $_FILES['userfile']['size'];
					$fileType = $_FILES['userfile']['type'];
					
					$fp      = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					
					if(!get_magic_quotes_gpc())
					{
						$fileName = addslashes($fileName);
					}
					
					$query=mysql_query("UPDATE `trafficDB`.`reservations` SET `data`='$content' WHERE `resID`='$id';") or die('Error, query failed');
					{
						header("location:reserve.php");
					}
				}
			?>
			<form method="post" enctype="multipart/form-data" action="">
				<table>
					<tr>
						<td>File</td>
						<td>
							<input type="file" id="userfile" name="userfile" class="box" id="upload"/>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="submit"/>
						</td>
						<td>
							<input type="button" onclick="window.location.href='reserve.php'" value="Cancel"/>
						</td>
					</tr>
				</table>		
			</form>
			<?php
			}
			mysql_close();
		?>
	</body>
</html>																	