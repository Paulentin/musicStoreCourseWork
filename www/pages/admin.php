<?php include('../header.php');
if(($data[Username]=='admin')&&($data[Password]=='4f208e87dbf1f6ded475ec7a7c8dea87')){
?>



<body>	
<div class="wrapper col4">
  <div id="breadcrumb">
  </div>
</div>
<div class="wrapper col5">
  <div id="container">   
      <table summary="Summary Here" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Username</th>
			<th></th>
            <th>Rename USR</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
			<?php
			$sql="SELECT * FROM user ORDER BY Username";
			$result_set=mysql_query($sql);
			while($row=mysql_fetch_array($result_set))
			{
				?>
				<tr>
					<td>
						<?php echo $row['Username'] ?>
					</td>
					<td class="text-left">
						<?php 
						echo'
						<form action="pages/rename.php?prevname='.$row['Username'].'" method="POST">'; ?>
						<input type="text" name="newname" id="newname" value="" size="22" />
						<input type="hidden" name='e-mail' id='e-mail' value="<?php echo $row['E_mail']?>">
					</td>
					<td class="text-left">
						<button type="submit" name="rename">Rename</button>
					</td>
					</form>
					<td><a href='pages/delete.php?user="<?php echo $row['Username']?>"'>del user</a></td>
				</tr>
				<?php
			}
			?>
        </tbody>
      </table>
	  <p><h3> Add author</p>
	  <form action="pages/add_author.php" method="POST" enctype="multipart/form-data">
			<table cellpadding="0" cellspacing="0" >
				<tr>
				  <td class="text-left"><label for="AuthorName"><small>Name of Author</small></label>
				  <td class="text-left"><input type="text" name="AuthorName" id="AuthorName" value="" size="22" />
				</tr>  
				<tr>
				  <td><label for="author_info"><small>Info about author</small></label>
				  <td> <input type="text" name="author_info" value="" type="text" cols="40" rows="5" style="width:500px; height:80px;" /></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit" name="add_author">Add author</button></td>
				</tr>	
				</table>
	</form>
    </div>
</div>
<?php include '../footer.php';

	}
			?> 
 
</body>