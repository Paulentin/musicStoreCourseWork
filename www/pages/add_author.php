<?php
include_once '../header.php';
include_once '../cfg/core.php';
if(isset($_POST['add_author']))
{	

$author_name=$_POST['AuthorName'];
$author_info=$_POST['author_info'];
mysql_query('START TRANSACTION');
$q=mysql_query("INSERT into author SET AuthorName='$author_name', Rate=1");
$qa=mysql_query("UPDATE author_data SET Biography='$author_info' WHERE idAuthor=(SELECT idAuthor FROM author WHERE AuthorName='$author_name')");
echo $q;
echo $qa;
if($q>0&&$qa>0){
	
		mysql_query('COMMIT');
	?>
		<script>
		alert('<?php echo $author_name?> added successfully');
        window.location.href='../pages/admin.php?success';
        </script>
		<?php
	}
	else
	{
		mysql_query('ROLLBACK');
		?>
		<script>
		alert('error while adding');
        window.location.href='../pages/admin.php?fail';
        </script>
		<?php
	}
}