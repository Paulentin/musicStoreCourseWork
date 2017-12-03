<?php include('../header.php');
?>
<div class="wrapper col4">
  <div id="breadcrumb">
  <form method = "POST">
    <select name="select2">
	<?php
	$sql="SELECT * FROM author";
	$result_set=mysql_query($sql);
	?>
		<option selected="selected">Choose AuthorNAME</option>
    <?php 
    while($row=mysql_fetch_array($result_set)){
		?>
		<option><?php echo $row['AuthorName'] ?></option>
		<?php 
	}
	
	?>

    </select>
    <input type = "submit" value = "SELECT" name="SELECT">
  </form>
  </div>
</div>
		<?php
		if(isset($_POST['SELECT'])){
?>		<div class="wrapper col5">
			 <div id="container">
				<div id="content">
	<?php	$AuthorName = $_POST['select2'];
	
			if(($data[Username]=='admin')&&($data[Password]=='4f208e87dbf1f6ded475ec7a7c8dea87')){
				echo '<form action="pages/photo_author.php?AuthorName='.$AuthorName.'"  method="post" enctype="multipart/form-data">';
				?>
				<table>
				<tr>
					<td> </td>
					<td><input type="file" name="file" accept="image/jpeg,image/png,image/gif"/>
					<button type="submit" name="btn-upload">Upload</button></td>
					</td>
				</tr>
				</form>
			<?php
			
			}
	
		
			
			$sql="SELECT Biography from author_data where idAuthor=(SELECT idAuthor from author where AuthorName='$AuthorName')";
			$result_set=mysql_fetch_array(mysql_query($sql));
			$sqlphot="SELECT Photo FROM author_data WHERE idAuthor=(SELECT idAuthor FROM author where AuthorName='$AuthorName')";
			$result_phot=mysql_query($sqlphot);
			$result_phot=mysql_fetch_array(mysql_query($sqlphot));
			$photo=$result_phot['Photo'];
			
			?>
			<p>
					<?php
					echo "$result_set[Biography]";
					?>
				</p>	
			<?php echo "<p><img src='/uploads/authors/$photo'></p>";?>
			
				
				<table>
				<thead>
				<tr><h3 align='center'><?php echo"$AuthorName"; ?></h3></tr>

					<tr>
						<th><h3>File Name</th>
						<th><h3>File Type</th>
						<th><H3>File Size(KB)</th>
						<th><H3>Username</th>
					<?php
					if($agearray[Username]==$data[Username])
						{
						?>
						<th><H3>View</th>
						<th><H3>Listen</th>
						<?php 
						} 
						?>
					</tr>
				</thead>
				<tbody>
				
			<?php
					
			$sql="SELECT * from music 
					where Song_Authors_idSong_Authors=(Select idSong_Authors from song_authors 
					where Author_idAuthor=(SELECT idAuthor from author where AuthorName='$AuthorName'))";
			$result_set=mysql_query($sql);
			?>
			<?php
			while($row=mysql_fetch_array($result_set))
			{
				?>
				
				<tr>
					<td><?php echo $row['file'] ?></td>
					<td><?php echo $row['type'] ?></td>
					<td><?php echo $row['size'] ?></td>
					<td><?php echo $row['Username'] ?></td>
					
					 <?php 
					if($agearray[Username]==$data[Username])
					{
						?>
					<td><?php
							echo "<a href='uploads/download.php?file=$row[file]'>view file</a>";
						
						?>
					</td>
					<td><audio controls>
						<source src="uploads/<?php echo $row['file']?>">
					</audio></td>
			
					</tr>
					<?php
					}
			}
		?>
		 </tbody>
		</table>
	   </div>
		<?php   
		 }?>
	   
   
    <br class="clear" />
  </div>
</div>
		<?php

		 if(isset($_GET['success']))
			{
			 ?>
				<label>File Uploaded Successfully...  </label>
			 <?php
			}
			else if(isset($_GET['fail']))
			{
			?>
				<label>Problem While File Uploading !</label>
			<?php
			}
							

		 ?>
<?php include '../footer.php';
  ?>
</body>
</html>

