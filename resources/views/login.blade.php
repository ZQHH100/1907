<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h3>登录</h3>
	<form action="{{url('dologin')}}" method="post">
	
		@csrf
		<table>
			<tr>
				<td>账号</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
			<td><input type="submit" value="登录"></td>
			</tr>
		</table>
	</form>
</body>
</html>