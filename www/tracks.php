<?php 
$type_user=1;
include "header.php";?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<body>
<link rel="stylesheet" href="layout/styles/style.css" type="text/css" />
<div class="wrapper col4">
  <div id="breadcrumb">	
    
	<?php
	if($content){
		echo'<form action="pages/upload.php?Username='.$data[Username].'"  method="post" enctype="multipart/form-data">';?>
		<table cellpadding="0" cellspacing="0" >
			<tr>
			  <td class="text-left"><label for="AuthorName"><small>Name of Author</small></label>
			  <td class="text-left"><input type="text" name="AuthorName" id="AuthorName" value="" size="22" />
			</tr>  
			<tr>
			  <td><label for="ageRestriction"><small>Age restriction </small></label>
			  <td> <input type="radio" name="Age_Restrict" value="1"><small>Adults only</small>
					<input type="radio" name="Age_Restrict" value="0"><small>Free access</small>
			</tr>
			<tr>
			  <td><label for="genre"><small>Genre of track</small></label>
				<td>	<select name="genre">
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
				</td>
			</tr>
			<tr>
			  <td><label for="language"><small>Language</small></label>
			  <td>
			  <select name="language">
						<?php
						$sql="SELECT * FROM language";
						$result_set=mysql_query($sql);
						?>
							<option selected="selected">Choose language</option>
						<?php 
						while($row=mysql_fetch_array($result_set)){
							?>
							<option><?php echo $row['Language'] ?></option>
							<?php 
						}
						?>
					</select>
			</tr>
			<tr>
				<td> </td>
				<td><input type="file" name="file" accept="audio/*"/>
				<button type="submit" name="btn-upload">Upload</button></td>
				</td>
			</tr>
			<tr>
				<td>
				<td><input name="reset" type="reset" id="reset" tabindex="5" value="Reset Form" />
			</tr>
			</table>
		
          </p>
        </form>
	<?php
	}
	?>
		<div id="body">
<!-- <form action="pages/upload.php" method="post" enctype="multipart/form-data">
 <input type="file" name="file" />
 <button type="submit" name="btn-upload">Upload</button>
 </form>-->
    <br /><br />
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
</div>
  <form method = "POST">
    <select name="choice">
	<?php
	$sql="SELECT * FROM user";
	$result_set=mysql_query($sql);
	$sqldel=mysql_fetch_array(mysql_query("SELECT * FROM music WHERE username='deleted user'"));
	?>
		<option selected="selected">Choose user which tracks to show</option>
    <?php 
    while($row=mysql_fetch_array($result_set)){
		?>
		<option><?php echo $row['Username'] ?></option>
		<?php 
	}
	?>
	<option><?php echo $sqldel['Username'] ?></option>
    </select>
    <input type = "submit" value = "ChooseUser" name="ChooseUser">
  </form>
  
  
  <?php
		if(isset($_POST['ChooseUser'])){
			$username = $_POST['choice'];
			
			$resultSETTIO=mysql_query("SELECT * FROM user WHERE Username='$username'");
			$row=mysql_fetch_array($resultSETTIO);
				?>
			
				<p><?php echo "Users name: ".$row['FullName'].""; ?></p>
				<p><?php echo "E-mail: ".$row['E_mail']."" ;?></p>
				<p><?php echo "Rate: ".$row['RateOfUser']."" ;?></p>
				<p><?php echo "Date of birth: ".$row['Age']."" ;?></p>
	
		<table width="80%" border="1" class="table-fill">
		<tr><h3 align='center' font='Colibri'>Tracks of user <b><?php echo $username;?></b></h3>
			</tr>
			<tr>
			<th><h3>File Name</th>
			<th><h3>File Type</th>
			<th><H3>File Size(KB)</th>
			<th><H3>Username</th>
			<?php 
				if($agearray[Username]==$data[Username])
					{?>
					<th><H3>Download</th>
					<?php 
					}
			?>
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
					<?php if(($data[Username]==$username)||($data[Username]=='admin')){
					?>
				</td>
				
				<td>
					<?php
					echo"<a href='uploads/deletetrack.php?action=delete&file=$row[idMusic]'>Delete</a>";
					?>
				</td>	
						
				</tr>
					<?php
					}
			}
			?>
		</table>
		<table width="80%" border="1">
		 <tr>
		<td>File Name</td>

		<td>Play</td>
		</tr>
		<?php
		$sql="SELECT * FROM music WHERE Username='$username'";
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
	<!--
		<php
		 $MySQLRecordSet = mysql_query('SELECT Title,NameOfGenre,Language,user.Username FROM music,genres,language,user  LIMIT 10');
		 /*$MySQLRecordSet = mysql_query('SELECT * FROM music WHERE idGenre AS $NameOfGenre LIMIT 10');*/
			echo"
			<div>
				<table>";
				
			$iter = 0;
			while($name = @mysql_field_name($MySQLRecordSet, $iter++))
			{
				echo'<th>'.$name.'</th>'; 

			}
			echo'</tr>';
			while($Result = mysql_fetch_assoc($MySQLRecordSet))
			{
			   echo' <tr>';
				foreach($Result as $k => $val)
				{
					echo' <td>'.$val.'</td>';               
				}
				echo'</tr>';
			}
			echo"
				</table>
			";
		?>-->

  </div>
</div>
<!--
<div class="wrapper col5">
	<center>
			<div id="myplayer" style="width:500px;height:50px"></div>
			<SCRIPT type=text/javascript>this.videoplayer = new Uppod({m:"audio",comment:"Alicia Keys - New York",uid:"myplayer",file:"Alicia Keys - New York.mp3"});</script>
			
			
	<center>	
</div>-->
<?php include 'footer.php';
  ?>
  
</body>
</html>