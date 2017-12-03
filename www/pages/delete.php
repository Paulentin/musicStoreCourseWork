<?php
include_once '../cfg/core.php';
if (isset($_GET['user'])){
	 $link = mysqli_connect("localhost", "root", "", "musiclib");
 
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$user = ($_GET['user']);
	$zet=mysql_query("DELETE FROM user WHERE Username=$user");
	if($zet>0)
	{?>
		<script>
		alert('User <?php echo $user?>deleted successfully ');
        window.location.href='../pages/admin.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='../pages/admin.php?fail';
        </script>
		<?php
	}
}

?>

		

<!--удалять файл из бд и из ПАПКИ-->