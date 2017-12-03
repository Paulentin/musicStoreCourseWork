<?php
include 'cfg/core.php';
header('Content-Type: text/html; charset=utf-8');

$type_users = 0;
$content = true;

$AgeRestriction=mysql_query('SELECT Username FROM user where (curdate()-Age)>18');
$agearray=mysql_fetch_array($AgeRestriction);

	#функуии
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}

function login(){
	
	echo'
	  <div class="clientlogin">
		<form method="POST" enctype="multipart/form-data">
			 <legend>Site Login</legend>
			  <input id="login-form" name="Username" type="text" placeholder="Username"></td>
			  <input id="login-form" name="password" type="password" placeholder="Password"></td>
			  <input class="login-button" name="submit" type="submit" value="Sign in"></form>			
			  <form method="POST" enctype="multipart/form-data" action="cfg/join.php"><input class="login-button" name="register" type="submit" value="Register">
		</form>
      </div>';  
		
}

function check($Username){
	echo "
	<div id='clientlogin'>
		<form method='POST' enctype='multipart/form-data'>
					<table>
						<tr>
							<th>Username: <a href='pages/user-info.php'>$Username</a></th>
							<th><input class='exit-button' name='exit' type='submit' value='Exit'></th>
						</tr>
					</table>	
		</form>
	</div>
	<div id='search'>
            <form action='pages/search.php' method='post'>
				  <legend>Site Search</legend>
				  <input type='text' placeholder='Search Our Website&hellip;' name='query' id='query'  />
				  <input type='submit' name='go' id='go' value='GO' />
				</fieldset>
			  </form>
	</div>
			
	";
	$type_users = 1;
	
}

function errors($text, $Username, $pass){
	
				echo "$text";
	
	if ($button){
		?>
			<button class="close" title="Close" onclick="document.getElementById('overlay').style.display='none';"></button>
		<?php
	}
	?>
		</div>
		</div>
		<script type="text/javascript">
			setTimeout("document.getElementById('overlay').style.display='block'", 1);
		</script>
	<?php
}

######################################################################################
######################################################################################

function menuhead(){
	?>
		<html lang="ru">
		</html>
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
		<head>
		<title>Music Library</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<script src='uppod-0.6.4.js' type='text/javascript'></script>
		<script src='swfobject.js' type='text/javascript'></script>
		<script type="text/javascript" src="audio236-361.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta charset="utf-8">
		<base href="http://musiclib.nure.ua/" />
		<link rel="stylesheet" href="layout/styles/layout.css	" type="text/css" />
		
		</head>

		<body id="top">
		<div class="wrapper col1">
		  <div id="topbar">
			<div id="clientlogin">
			</div>
		
	<?php
}
echo $counter[0];
function menufoot($Username,$Password){								
	$counter=mysql_fetch_assoc(mysql_query("SELECT Counter() AS 'amount'"));

	?>
		 </div>
		</div>
		
		<div class='wrapper col2'>
		  <div id='bar2'>
			<ul>
			  <li>Tel: +38(066)021-98-30</li>
			  <li>|</li>
			  <li class='last'>Mail: zabarapasha09@gmail.com</li>
			  <li>|</li>
			  <li class='last'> pavlo.zabara@nure.ua</li>
			  <li>|</li>
			  <li>Already registered users:<?php echo $counter[amount]?></li>
			</ul>
			<p>I need FIVE 4 it</p>
		  </div>
		</div>
		<div class='wrapper col3'>
		  <div id='header'>
			<h1><a href='index.php'>Music library</a></h1>
			<a href='http://nure.ua'><img link='http://www.nure.ua/' src="images/knure_logo.png" alt="NURE" height="42" width="42"></a>
			<ul id='topnav'>
			<?php
				if(($Username=='admin')&& ($Password=='4f208e87dbf1f6ded475ec7a7c8dea87'))
				{
					?>
					<li><a href='pages/admin.php'>Administrating</a></li>
					<?php	
				}
				?>

			  <li><a href='#'>Tracks</a>
				<ul>
				  <li><a href='tracks.php'>Tracks</a></li>
				  <li><a href='pages/genres.php'>Tracks by genre</a></li>
				</ul>
			  </li>
			  <li><a href='pages/authors.php'>Authors</a></li>
			  
			  <li class='active'><a href='index.php'>Home</a></li>
			</ul>
			<br class='clear' />
		  </div>
		</div>
		</body>
	<?php
}
######################################################################################
######################################################################################

# кнопки

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysql_query("SELECT * FROM user WHERE Username='".mysql_real_escape_string($_POST['Username'])."' LIMIT 1");
    $data = mysql_fetch_assoc($query);
    
    # Сравниваем пароли
    if($data[Password] === md5(md5($_POST['password'])))
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        
        # Записываем в БД новый хеш авторизации и IP
        mysql_query("UPDATE user SET hash='".$hash."' WHERE Username='".$data['Username']."'");
        
        # Ставим куки
		SetCookie("Username",$data[Username],time()+60*60*24*30,'/');
		SetCookie("user_hash",$hash, time()+60*60*24*30,'/');
	}	
}
else if(isset($_POST['exit']))
{
		SetCookie("Username","",time()+60*60*24*30,'/');
		SetCookie("user_hash","", time()+60*60*24*30,'/');
}

######################################################################################

menuhead($active);
######################################################################################

if(isset($_POST['submit']))
{
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysql_query("SELECT * FROM user WHERE Username='".mysql_real_escape_string($_POST['Username'])."' LIMIT 1");
    $data = mysql_fetch_assoc($query);
    
    # Сравниваем пароли
    if($data[Password] === md5(md5($_POST['password'])))
    {		
			check($data[Username]);
			$type_users = 1;
	}	
    else
    {
        errors("You have entered the wrong <b>Username address</b> and/or <b>password</b>.","","");
		$type_users = 2;
		login();
    }
}
else if(isset($_POST['exit']))
{
	login();
	$type_users = 2;
}
else if (isset($_COOKIE['Username']) and isset($_COOKIE['user_hash']))
{   
	$query = mysql_query("SELECT * FROM user WHERE Username='".mysql_real_escape_string($_COOKIE['Username'])."' LIMIT 1");
	$data = mysql_fetch_assoc($query);

	if(($data[hash] == $_COOKIE['user_hash']) and ($data[Username] == $_COOKIE['Username']))
	{
		check($data[Username]);
		$type_users = 1;
	}
	else {
		login();
		$type_users = 2;
	}
}
else {
	login();
	$type_users = 2;
}

######################################################################################

######################################################################################

if (($type_users!=$type_user)&& ($type_user!=0)) {
	
	$content = false;
}

menufoot($data[Username],$data[Password]);
?>