<?php
$active = 1;
$type_user = 2;	

include '../header.php'; 
if (true){
	if(isset($_POST['join']))
	{
		
		$err = true;
		# проверям логин
		
		if (!preg_match("/^[a-zA-Z0-9_]+$/",$_POST['username'])) {
		
			$err = false;
			echo"Username can contain only English letters, numbers and special characters.<br>";
		}
		if(!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i",$_POST['E_mail']))
		{
			$err = false;
			echo "E-mail must contain @ and domain name with dot.<br>";
		}
		else $E_mail = $_POST['E_mail'];
		
		if(strlen($_POST['password']) < 6 or strlen($_POST['password']) > 30)
		{
			$err = false;
			echo "Password must be at least 6 characters and no more than 30.<br>";
		}
		
		if($_POST['license']!="true")
		{
			$err = false;
			
		}
		
		$empty=0;
		# проверяем, не сущестует ли пользователя с таким именем
		$query = mysql_query("SELECT COUNT(username) FROM user WHERE username='".mysql_real_escape_string($_POST['username'])."'");
		if(mysql_result($query, 0) > 0)
		{
			$err = false;
			echo "A user with this username already exists in the database.";
		}
		
		# Если нет ошибок, то добавляем в БД нового пользователя
		if($err)
		{
			
			$Username = $_POST['username'];
			$password = md5(md5(trim($_POST['password'])));
			
			if (strlen($_POST['username'])<1) 
				$Username = NULL;
			else $Username = $_POST['username'];
			
			if (strlen($_POST['FullName'])<1)
				$FullName= NULL;
			else $FullName = $_POST['FullName'];
	
			if (strlen($_POST['birthday'])=="0000-00-00") $birthday = NULL;
			else $birthday = $_POST['birthday'];
			mysql_query("call AddUser('".$Username."','".$FullName."','".$password."','".$empty."','".$E_mail."','".$birthday."')");

			echo'You are registered successfully! <a href="/">Welcome</a>';
		}
		
	}

	echo'
	<div>
		<h3>Add User</h3>
	</div>
			<div>
			<form method="POST" enctype="multipart/form-data">
				<table width="99%">
					<tr>
						<td class="join"><span>*</span>Username:</td>
						<td class="join"><input id="login-form" name="username" type="text"></td>
						<td class="join"><span class="color-4">Username can contain only English letters, numbers and special characters</span></td>
					</tr>
					<tr>
						<td class="join"><span>*</span>Password:</td>
						<td class="join"><input id="login-form" name="password" type="password"></td>
						<td class="join"><span>Password must be at least 6 characters and no more than 30.</span></td>
					</tr>
					<tr>
						<td class="join">Name:</td>
						<td class="join"><input id="login-form" name="FullName" type="text"></td>
						<td class="join"><span>Your Name and Surname.</span></td>
					</tr>
					<tr>
						<td class="join">E-mail:</td>
						<td class="join"><input id="login-form" name="E_mail" type="text"></td>
						<td class="join"><span>E-mail must contain @ and domain name with dot.</span></td>
					</tr>
					<tr>
						<td class="join">Birthday:</td>
						<td class="join"><input type="date" id="login-form" name="birthday"></td>
						<td class="join"><span class="color-4"></span></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="checkbox" name="license" value="true"> I agree with the user agreement.
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input class="login-button" name="join" type="submit" value="Join">
						</td>
					</tr>
				</table>
			</form>
			</div>
	';
}
include '../footer.php'; 
?>