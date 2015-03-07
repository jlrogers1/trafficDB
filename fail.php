<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TrafficDB - Login</title>
		<style>
			body{
			overflow: hidden;
			background: url(images/bg.jpg);
			background-size: 1940px 1080px;
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
			background-color: black;
			opacity: 0.9;
			}
		</style>
	</head>
	<body>
		<div class="outer">
			<div class="middle">
				<div class="inner" align="center">
					<h2 style="color: #FF0000">Incorrect username or password!</h2>
					<form action="connect.php" method="post">
						<table>
							<tr>
								<td align="right"><label for="user" style="color: #FFFFFF">Username</label></td>
								<td align="left"><input type="text" id="user" name="user"></td>
							</tr>
							<tr>
								<td align="right"><label for="pass" style="color: #FFFFFF">Password</label></td>
								<td align="left"><input type="password" id="pass" name="pass"></td>
							</tr>
							<tr>
								<td align="right"></td>
								<td align="left"><input type="submit" id="submitBtn" value="Login" style="width:100%"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>