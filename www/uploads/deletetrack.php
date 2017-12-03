<?php
include_once '../cfg/core.php';
if (isset($_GET['idMusic'])){
	 $link = mysqli_connect("localhost", "root", "", "musiclib");
 
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$idMusic = ($_GET['idMusic']);
	//$zet=mysql_query("DELETE FROM music WHERE idMusic=(SELECT idMusic FROM music WHERE `file`=$file");
	$zet=mysql_query('Call DeleteTrack('.$idMusic.')');
	
	if($zet>0)
	{
		?>
		<script>
		alert('successfully deleeted');
        window.location.href='../tracks.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while deleting');
        window.location.href='../tracks.php?fail';
        </script>
		<?php
	}
}

?>

<!--
if (isset($_GET[])){
$file = ("$_GET['file']");
mysql_query("call DeleteTrack($file)");

}

?>
