<?php include('../header.php');?>
<div class="wrapper col4">
<div id="breadcrumb">
    
  </div>
</div>
<div class="wrapper col5">
  <div id="container">
   
	<?php 
	$username=$data[Username];
	if(($data[Username]==$username)||($data[Username]=='admin')){
		
		$resultSETTIO=mysql_query("SELECT * FROM user WHERE Username='$username'");
			$row=mysql_fetch_array($resultSETTIO);
				?>
			
				<p><?php
				echo "Username: ".$row['Username'].""; ?></p>
				<?php 
						echo'
						<form action="pages/renamebyUSER.php?prevname='.$row['Username'].'" method="POST">'; ?>
						<input type="text" name="newname" id="newname" value="" size="22" />
						<input type="hidden" name='e-mail' id='e-mail' value="<?php echo $row['E_mail']?>">
						<button type="submit" name="rename">Rename</button>
						</form>
				<p><?php echo "Users name: ".$row['FullName'].""; ?></p>
				<p><?php echo "E-mail: ".$row['E_mail']."" ;?></p>
				<p><?php echo "Rate: ".$row['RateOfUser']."" ;?></p>
				<p><?php echo "Date of birth: ".$row['Age']."" ;?></p>
	
	<table width="80%" border="1" class="table-fill">
	<tr><h3 align='center' font='Colibri'>Your TRACKS</h3>
    </tr>
	<tr>
    <th><h3>File Name</th>
    <th><h3>File Type</th>
    <th><H3>File Size(KB)</th>
	<th><H3>Username</th>
  	<th><H3>Download</th>
	<th><H3></th>
    </tr>
    <?php
	
	$sql="SELECT * FROM music WHERE Username='$username'";
	$result_set=mysql_query($sql);
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
		
		<td>
			<?php
			echo"<a href='uploads/deletetrack.php?action=delete&idMusic=$row[idMusic]'>Delete</a>";
			?>
		</td>		
        </tr>
    <?php
	}
	?>
		</table>
		<table width="80%" border="1">
		 <tr>
		<td>File Name</td>

		<td>Play</td>
		</tr>
		<?php
		$sql="SELECT * FROM music WHERE username='$username'";
		$result_set=mysql_query($sql);
			
		while($row=mysql_fetch_array($result_set))
		{?>
		
			<tr>
			<td>
				<?php echo $row['file'] ?>
			</td>
				<td>
				<audio controls>
					<source src="uploads/<?php echo $row['file']?>">
				</audio>
				</td>
			</tr>
		
		<?php 
		}
	}
		?>
	
</table>	
	</div>
   </div>
	 
<?php include '../footer.php';
  ?>
</body>
</html>