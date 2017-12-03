<?php
include_once '../header.php';
include_once '../cfg/core.php';
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
mysql_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 2) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT *
                  FROM `music` WHERE `file` LIKE '%$query%'
                  OR `username` LIKE '%$query%'";

            $result = mysql_query($q);
            $num = mysql_num_rows($result);
			$q = "SELECT *
		    FROM `music` WHERE `file` LIKE '%$query%'
			 OR `username` LIKE '%$query%'";

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
?>
<body>


	   <div id="breadcrumb">	

		<div id="content">
			<table>
			<tr>
						<td><h3>File Name</td>
						<td><h3>File Type</td>
						<td><H3>File Size(KB)</td>
						<td><H3>Username</td>
						<?php 
							if($agearray[Username]==$data[Username])
								{?>
								<td><H3>Download</td>
								<?php 
								}
						?>
						<td><H3></td>
						</tr>


<?php
              while($row=mysql_fetch_array($result))
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
					echo"<a href='uploads/deletetrack.php?action=delete&file=$row[file]'>Delete</a>";
					?>
				</td>	
						
				</tr>
					<?php
					}
			}?>
			</table>
		
			<?php
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 
?>
</div>
</div>