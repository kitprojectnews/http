<?php
include "php/dbconn.php";

$sql = "CREATE TABLE IF NOT EXISTS account (
    u_num INT UNSIGNED NOT NULL AUTO_INCREMENT,
    u_id VARCHAR(255) NOT NULL, #userid
    u_pw VARCHAR(44) NOT NULL, #userpw
    u_active TINYINT(1) NOT NULL DEFAULT 1, #유저 활성 여부
    u_update TINYINT(1) NOT NULL DEFAULT 0, #유저 변경 권한 여부
    r_update TINYINT(1) NOT NULL DEFAULT 0, #룰 추가/수정/삭제 가능 여부
    PRIMARY KEY (u_num))";

if ($conn->query($sql) == TRUE) {
    echo "ok<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$user = "admin";
$pass = "admin";

$hashpw = base64_encode(hash('sha256', $pass, true));
$sql = "SELECT u_num, u_id, u_active, u_update, r_update FROM account ORDER BY u_num DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "ok<br>";
    header('Location:./index.html');
}
else {
    $sql = "INSERT INTO account (u_id, u_pw, u_active, u_update, r_update) VALUES ( '$user','$hashpw', 1, 1, 1)";

    if ($conn->query($sql) == TRUE) {
        echo "ok<br>";
        header('Location:./index.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>