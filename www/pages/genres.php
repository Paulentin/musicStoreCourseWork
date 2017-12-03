<?php include('../header.php');?>
<div class="wrapper col4">
  <div id="breadcrumb">
  <form method = "POST">
    <select name="select2">
	<?php
	$sql="SELECT * FROM genres";
	$result_set=mysql_query($sql);
	?>
		<option selected="selected">Choose genre</option>
    <?php 
    while($row=mysql_fetch_array($result_set)){
		?>
		<option><?php echo $row['NameOfGenre'] ?></option>
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
			$NameOfGenre = $_POST['select2'];
			$sql="SELECT Description from genres where idGenres=(SELECT idGenres from genres where NameOfGenre='$NameOfGenre')";
			$result_set=mysql_fetch_array(mysql_query($sql));
			?>
			
			<div class="wrapper col5">
			  <div id="container">
				<div id="content">
				<p>
					<?php
					echo "$result_set[Description]";
					?>
				</p>	
				<table>
				<thead>
				<tr><h3 align='center'><?php echo"$NameOfGenre"; ?></h3></tr>

					<tr>
						<th><h3>File Name</th>
						<th><h3>File Type</th>
						<th><H3>File Size(KB)</th>
						<th><H3>Username</th>
						<th><H3>View</th>
						<th><H3>Listen</th>
					</tr>
				</thead>
				<tbody>
				
			<?php
					
			$sql="SELECT * from music where idGenre=(select idGenres from genres where NameOfGenre='$NameOfGenre')";
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
		?>
		 </tbody>
		</table>
	   </div>
		<?php   
		 }?>
	   
   
    <br class="clear" />
  </div>
</div>
<?php include '../footer.php';
  ?>
</body>
</html>