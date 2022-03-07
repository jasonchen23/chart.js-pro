<?php
require_once("./db-connect.php");
$sql="SELECT * FROM `chart` WHERE `city-id`='A' AND `company-name`='百貨公司' ORDER BY `chart`.`receipt` ASC";
$result= $conn -> query($sql);
$data=$result->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <title>user-list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <canvas id="myChart" width="800" height="400"></canvas>
    
    <script>
        let dataContent=<?=$data?>.map(function(item){
            let newItem={
                x:item["downtown-name"],
                y:item["average-per-cost"]
            }
            return newItem;
        })
        console.log(dataContent);
    </script>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>account</th>
                <th>password</th>
                <th>gender</th>
                <th>phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // method 1
            // if($result -> num_rows> 0):
            //     while($row = $result-> fetch_assoc()):
            // method 2
            if ($result->num_rows > 0):
                foreach($data as $row):
            ?>
            <tr>
                <td><?=$row["id"]?></td>
                <td><?=$row["account"]?></td>
                <td><?=$row["password"]?></td>
                <td><?=$row["gender"]?></td>
                <td><?=$row["phone"]?></td>
                <td> <a href="./user-info.php?id=<?=$row["id"]?>" class="btn btn-info"> Details</a></td>
            </tr>
            <?php
                // method 1
                // endwhile; 
            ?>
            <?php
                // method 2
                endforeach;
            ?>
            <?php else:?>
            <tr>
                <td>No Data</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>