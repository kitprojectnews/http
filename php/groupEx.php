<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   die('접근권한이 없습니다. ');
}
    include 'dbconn.php';
    $del=$_POST["del"];
    if($del){
        $sql="select gid from sig_group where gname='".$del."';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $Rule_gid=$row["gid"];

        $sql="select * from signature where sig_gid='".$Rule_gid."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
        <script>
            alert("해당 그룹명을 사용하는 룰이 있어 그룹을 삭제할 수 없습니다.");
        </script>
        <meta http-equiv="refresh" content="0,group.php">
        <?php
                }else{
                $sql="delete from sig_group where gname='".$del."' ;";
                $result = $conn->query($sql);
        ?>
                <meta http-equiv="refresh" content="0,group.php">
        <?php 
                }
        }
    else{
    $group=trim($_POST["group"]);
    if($group==""){
?>
<script>
        alert("공백은 사용할 수 없습니다.");
</script>
        <meta http-equiv="refresh" content="0,group.php">
<?php
    }else{
        $sql="select gname from sig_group where gname='".$group."' ;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
?>
<script>
        alert("해당 그룹이 이미 있습니다.");
</script>
        <meta http-equiv="refresh" content="0,group.php">
<?php
        }else{
        $sql="insert into sig_group(gname) values('".$group."');";
        $result = $conn->query($sql);
?>
        <meta http-equiv="refresh" content="0,group.php">
<?php
        }
    }   
  }
?>
