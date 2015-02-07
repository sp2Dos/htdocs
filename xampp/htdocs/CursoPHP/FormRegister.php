<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center><h1>Formulario de registro</h1>
		<form action="Register.php" method="post">
			
			<table width="300" border="0">
				<tr>
					<td>Name:</td>
					<td><input type="text" name="name"/></td>
				</tr>
				<tr>
					<td>User:</td>
					<td><input type="text" name="user"/></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="pwd"/></td>
				</tr>
				<tr>
					<td> Repeat Pwd:</td>
					<td><input type="password" name="RptPwd"/></td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td><input type="text" name="email"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Enviar"/></td>
				</tr>
			</table>
		</form>

	</center>
</body>
</html>