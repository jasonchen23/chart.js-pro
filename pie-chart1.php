<?php
require_once("./db-connect.php");
$sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 201901 AND 201912 group by `downtown-id` ORDER BY `chart_clear`.`downtown-id` ASC;";
$result= $conn -> query($sql);
$data=$result->fetch_all(MYSQLI_ASSOC);
$data109= json_encode($data);
// $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,`average-per-cost` FROM `chart` WHERE `city-id`='A' AND `company-name`='百貨公司' AND `receipt`BETWEEN 202001 AND 202012 ORDER BY `chart`.`downtown-id` ASC;";
// $result= $conn -> query($sql);
// $data=$result->fetch_all(MYSQLI_ASSOC);
// $data110= json_encode($data);
?>

<!doctype html>
<html lang="en">
  <head>
    <title>mix-chart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
  <div class="container">
        <div class="row">
            <div>
                <h1 class="text-center">109年全北市各行業之電子發票B2C開立之平均客單價</h1>
            </div>
        </div>
    </div>
        <canvas id="myChart" width="800" height="400"></canvas>
    
    
    <script>
        let dataContent109=<?=$data109?>.map(function(item){
            let newItem={
                x:item["downtown-name"],
                y:item["average-per-cost"]
            }
            return newItem;
        })
        console.log(dataContent109);

        var ctx = document.getElementById('myChart');
        const data = {
            // labels: ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區', '南港區', '文山區'],
            datasets: [{
                label: 'My First Dataset',
                data: dataContent109,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 255, 255)',
                    'rgb(162, 201, 159)',
                    'rgb(224, 181, 198)',
                    'rgb(224, 204, 239)',
                    'rgb(141, 178, 239)',
                    'rgb(141, 242, 239)',
                    'rgb(141, 242, 48)',
                    'rgb(141, 27, 48)',
                    'rgb(255, 7, 117)',

                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                // maintainAspectRatio: false
                aspectRatio: 2
            },
        };


        const myChart = new Chart(ctx, config)
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>