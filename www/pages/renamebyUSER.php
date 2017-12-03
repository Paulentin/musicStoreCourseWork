<?php
include_once '../cfg/core.php';
if(isset($_POST['rename'])){
	$link = mysqli_connect("localhost", "root", "", "musiclib");
	if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}
	$getmail=$_POST['e-mail'];
	$prevname=$_GET['prevname'];
	$newname=$_POST['newname'];
	mysql_query('START TRANSACTION');
	$message='Your username changed to'.$newname.'';
	$subject='username changed name';
	$zet=mysql_query("UPDATE  `musiclib`.`user` SET  `Username` =  '$newname' WHERE  `user`.`Username` =  '$prevname'");
	$send=mail($getmail,$subject,$message);
	if($zet>0&&$send)
	{
		mysql_query('COMMIT');
		
		?>
		<script>
		alert('renamed successfully mail sent to <?php echo $getmail?>');
        window.location.href='../pages/user-info.php?success';
        </script>
		<?php
	}
	else
	{
		mysql_query('ROLLBACK');
		?>
		<script>
		alert('Something went wrong, maybe this username already exist');
        window.location.href='../pages/user-info.php?fail';
        </script>
		<?php
	}
	
}