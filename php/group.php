<?php
   include 'dbconn.php';
   session_start();
?>
<!DOCTYPE html>
<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>
<html>
<head>
</head>
<body>
<h2 align=center>Group List</h2>
    <?php
        if($_SESSION["u_update"]==1){
    ?>
    <div align=center>
        <form method=post action=groupEx.php>
        <input type=text name=group >&nbsp;<input type=submit value="그룹 추가">
        </form>
    </div>
    <?php
        }
    ?>
    <br>   
    <table border=1 align=center>
        <tr>
            <th>Group Name</th>
            <?php
                if($_SESSION["u_update"]==1){
            ?>
            <th>DELETE</th>
            <?php
                }
            ?>
        </tr>
        <?php 
		$sql="select gname from sig_group;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
		?>
		<tr>
            <td><?=$row["gname"]?></td><?php if($row["gname"]=="DEFAULT") continue; ?>
            <?php
                if($_SESSION["u_update"]==1){
            ?>
            <form method=post action=groupEx.php>
            <input type=hidden value=<?=$row["gname"]?> name="del">
            <td><input type=submit value="삭제" ></td>
            </form>
            <?php
                }
            ?>
           </tr>
		<?php 
				}
			}
		?>
</table>
</body>
</html>
