<?php
include_once '../header.php';
include_once '../cfg/core.php';
if(isset($_POST['btn-upload'])){
	if(($data[Username]=='admin')&&($data[Password]=='4f208e87dbf1f6ded475ec7a7c8dea87'))
		{
		$AuthorName=$_GET['AuthorName'];
		$link = mysqli_connect("localhost", "root", "", "musiclib");
		if($link === false){die("ERROR: Could not connect. " . mysqli_connect_error());}
			$file = rand(1000,100000)."-".$_FILES['file']['name'];
			$file_loc = $_FILES['file']['tmp_name'];
			$file_size = $_FILES['file']['size'];
			$file_type = $_FILES['file']['type'];
			$folder="../uploads/authors/";
			$file=translit($file);
			// new file size in KB
			$new_size = $file_size/1024;  
			// make file name in lower case
			$new_file_name = strtolower($file);
			
			$zet=move_uploaded_file($file_loc,$folder.$new_file_name);
					if($zet>0)
					{
				mysql_query("UPDATE `musiclib`.`author_data` SET `Photo` = '".$new_file_name."' WHERE idAuthor=(SELECT idAuthor FROM `author` WHERE `AuthorName`='$AuthorName')");

						?>
						<script>
						alert('successfully uploaded');
						window.location.href='/pages/authors.php?success';
						</script>
						<?php
					}
					else
					{
						?>
						<script>
						alert('error while uploading file');
						window.location.href='/pages/authors.php?fail';
						</script>
						<?php
					}}}
	function translit($str) {
    $rus = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', '¨', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', '×', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Þ', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', '¸', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'þ', 'ÿ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
  }
?>