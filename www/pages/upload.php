<?php
include_once '../header.php';
include_once '../cfg/core.php';
if(isset($_POST['btn-upload']))
{	
$Username=$_GET['Username'];
    $link = mysqli_connect("localhost", "root", "", "musiclib");
 
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
     
	 //UPLOAD info about Track (FORM)
	 ///
	 ///
	 ///
	  
		// Escape user inputs for security
		$Age_restriction = mysqli_real_escape_string($link, $_POST['Age_restrict']);

		$AuthorName = mysqli_real_escape_string($link, $_POST['AuthorName']);
		$trackName = mysqli_real_escape_string($link, $_POST['trackName']);
		$genre=mysqli_real_escape_string($link, $_POST['genre']);
		$language=mysqli_real_escape_string($link, $_POST['language']);
		// select&check if this genre exists
		/*$AuthorsID="SELECT idSong_Authors from song_authors where idAuthor=(SELECT idAuthor FROM Author WHERE AuthorName=$AuthorName)";*/
			$Genr="SELECT * from `genres` where NameOfGenre='$genre' limit 1"; 
			$Lang="SELECT * from `language` where Language='$language' limit 1";
			$Authors="SELECT * from `author` where AuthorName='$AuthorName' limit 1";
			
			
			$err = false;
			$rate=1;
			$Date_of_ADD=date("Y-m-d H:i:s");
			$genreArr = mysql_fetch_assoc(mysql_query($Genr));
			$langArr = mysql_fetch_assoc(mysql_query($Lang));
			$idAuthorsArr = mysql_fetch_assoc(mysql_query($Authors));
			$genreID=$genreArr['idGenres'];
			$langID=$langArr['idLanguage'];
			$idAuthors=$idAuthorsArr['idAuthor'];
	///
	///
	 
	//UPLOAD FILE to DB 
	///
	///
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="../uploads/";
	
	$file=translit($file);
		
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	
	/*$final_file=str_replace(' ','-',$new_file_name);*/
	$zet=move_uploaded_file($file_loc,$folder.$new_file_name); 

	if($zet>0)
	{
		
		$insert=mysql_query("INSERT INTO music SET file = '".$new_file_name."',idGenre='".$genreID."',Rate='".$rate."',Date_of_ADD='".$Date_of_ADD."',type='".$file_type."',size='".$new_size."',Age_restriction='".$Age_restriction."',Language_idLanguage='".$langID."',Song_Authors_idSong_Authors='".$idAuthors."',Username='".$Username."'");
		
			
		
		
	
		?>
		<script>
		alert('successfully uploaded');
        window.location.href='../tracks.php?success';
        </script>
		<?php
		
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='../tracks.php?fail';
        </script>
		<?php
	}
	

}

?>
<?php
  function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
  }
?>
