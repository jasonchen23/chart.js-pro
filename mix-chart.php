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
            <h1 class="text-center">109~110年全北市各行業之電子發票B2C開立之平均客單價</h1>
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
                type: 'bar',
                label: '109年台北市各區之平均客單價',
                data: dataContent109,
                borderColor: [
                    'rgba(255,99,132,1)',
                    // 'rgba(54, 162, 235, 1)',
                    // 'rgba(255, 206, 86, 1)',
                    // 'rgba(75, 192, 192, 1)'
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
            }, {
                type: 'line',
                borderWidth: 1,
                label: '110台北市各區之平均客單價',
                data: dataContent109,
                fill: false,
                borderColor: 'rgb(54, 162, 235)'
            }]
        };

        const config = {
            type: 'scatter',
            data: data,
            options: {
                scales: {
                    y: {
                        display: true,
                        position:'left',
                        title:{
                            display: true,
                            text:'TWD'
                        }
                    }
                }
            }
        };


        const myChart = new Chart(ctx, config)
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>