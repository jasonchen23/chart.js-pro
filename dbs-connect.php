<?php
//DB_Server, DB_Name, DB_Username, DB_Password	
try {
    $conn = new PDO("sqlsrv:Server=jasonchen23.database.windows.net;Database=test", "Cart", "2022Azure");
    $conn->exec("SET CHARACTER SET utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
    // if($conn)
    //     echo 'success';
} catch (PDOException $e) {
    echo "Connection Failed :".$e->getMessage();
}
?>