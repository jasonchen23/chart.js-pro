<?php
$servername = "localhost";
$username= "chart";
$password= "1234";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}else {
    // echo "success";
}
?>
