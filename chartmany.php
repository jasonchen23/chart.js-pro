<?php
require_once("./db-connect.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    body {
        font-family: "微軟正黑體", Arial, Helvetica, sans-serif;
        background-color: #f8f9fe;
    }
    .main {
        display: flex;
        flex-wrap: wrap;
        margin: 0 30px;
    }
    .chart-box {
        width: calc(50% - 2%);
        margin: 2% 1%;
        background-color: #fff;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, 0.15);
        border-radius: 5px;
    }
    @media only screen and (max-width: 1200px) {
        .chart-box {
            width: calc(50% - 2%);
        }
    }
    @media only screen and (max-width: 767px) {
        .chart-box {
            width: calc(100% - 2%);
        }
    }
    .chart-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .chart-header span {
        display: block;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #01050a;
    }
    .chart-header h3.title {
        margin: 2px 0;
        font-size: 20px;
    }
    .chart-box.dark {
        background-color: #ffffff;
    }
    .chart-header.dark {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    .chart-header.dark h3.title {
        color:black;
    }
    .chart-body {
        box-sizing: border-box;
        padding: 1.5rem;
        margin: 0 auto;
        position: relative;
        min-height: 220px;
        width: 100%;
    }
    /* radr */
    .card {
                background: #fff;
                box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
                width: 80%;
                height: 80%;
                border-radius: 10px;
                /*邊角鈍化 */
                overflow: hidden;
                /*定義元素超過某個範圍的時候該如何呈現 */
            }
    
            .card .information h3,
            .card .information p {
                font-weight: 300;
                margin: 0;
            }
    
            .card .information h3 {
                font-size: 28px;
            }
    
            .card .information p {
                color: #aaa;
                font-size: 18px;
            }
</style>

<body>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> -->

    <div class="main">

        <div class="chart-box">
            <div class="chart-body text-center">
                <h4>109-110年台北市各區之平均客單價</h4>
                <canvas id="myChart-7"></canvas>
                <?php
                $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 201901 AND 201912 group by `downtown-id` ORDER BY `chart_clear`.`downtown-id` ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $data109= json_encode($data);
                ?><?php
                $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 202001 AND 202012 group by `downtown-id` ORDER BY `chart_clear`.`downtown-id` ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $data110= json_encode($data);
                ?>
                <script>
                    let dataContent109=<?=$data109?>.map(function(item){
                        let newItem={
                            x:item["downtown-name"],
                            y:item["average-per-cost"]
                        }
                        return newItem;
                    })
                    console.log(dataContent109);
                    let dataContent110=<?=$data110?>.map(function(item){
                        let newItem={
                            x:item["downtown-name"],
                            y:item["average-per-cost"]
                        }
                        return newItem;
                    })
                    console.log(dataContent110);
                    var ctx = document.getElementById('myChart-7');
                    const data1 = {
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
                            data: dataContent110,
                            fill: false,
                            borderColor: 'rgb(54, 162, 235)'
                        }]
                    };

                    const config = {
                        type: 'scatter',
                        data: data1,
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
                    const myChart = new Chart(ctx, config);
                </script>
            </div>
        </div>

        <!-- 2 -->

        <div class="chart-box ">
            <div class="chart-body text-center">
                <!-- <h3 >Chart.js 雷達圖</h3> -->
                <h4>台灣三大都會區各零售業客單價統計</h4>
                <canvas id="myChart-8" width="800" height="400"></canvas>
            </div>
        </div>
        <?php
                $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 201901 AND 201912 AND `downtown`=group by `downtown-id` AND `comany-name` ORDER BY `chart_clear`.`downtown-id` ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $data1= json_encode($data);
                ?>
                <?php
                $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 202001 AND 202012 group by `downtown-id` ORDER BY `chart_clear`.`downtown-id` ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $data2= json_encode($data);
                $sql="SELECT `receipt`,`city-id`,`downtown-id`,`downtown-name`,`company-name`,sum(`average-per-cost`) AS `average-per-cost` FROM `chart_clear` WHERE `receipt` BETWEEN 202001 AND 202012 group by `downtown-id` ORDER BY `chart_clear`.`downtown-id` ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $data3= json_encode($data);
                ?>
        <script>
            let dataContent1=<?=$data1?>.map(function(item){
                        let newItem={
                            x:item["comany-name"],
                            y:item["average-per-cost"]
                        }
                        return newItem;
                    })
                    console.log(dataContent1);
                    let dataContent2=<?=$data2?>.map(function(item){
                        let newItem={
                            x:item["company-name"],
                            y:item["average-per-cost"]
                        }
                        return newItem;
                    })
                    console.log(dataContent2);
                    let dataContent3=<?=$data3?>.map(function(item){
                        let newItem={
                            x:item["company-name"],
                            y:item["average-per-cost"]
                        }
                        return newItem;
                    })
                    console.log(dataContent3);
            var ctx = document.getElementById('myChart-8');
            const data2 = {
                // labels: [
                //     '百貨公司',
                //     '零售式量販店',
                //     '超級市場',
                //     '便利商店',
                //     '綜合商品零售業',
                // ],
                datasets: [{
                    // label: '台北市',
                    data: dataContent1,
                    fill: true,
                    backgroundColor: 'rgba(255, 65, 164, 0.3)',
                    borderColor: '#fff0',
                    pointBackgroundColor: 'rgb(233, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#ff0',
                    pointHoverBorderColor: 'rgb(111, 2, 12)'
                }, {
                    // label: '台中市',
                    data: dataContent2,
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235,0)',
                    pointBackgroundColor: 'rgb(54, 162, 235)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 23)'
                },
                {
                    // label: '高雄市',
                    data: dataContent3,
                    fill: true,
                    backgroundColor: 'rgba(121, 255, 121,0.6)',
                    borderColor: '#fff0',
                    pointBackgroundColor: '#007500',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(54, 162, 235)'
                }]
            };
    
    
            const config = {
                type: 'radar',
                data: data,
                options: {
                    aspectRatio: 1,
                    elements: {
                        line: {
                            borderWidth: 1
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(0,0,0,0)'
                            },
                            grid: {
                                color: '#eee'
                            },
                            pointLabels: {
                                color: '	#000',
                                font: {
                                    size: 16
                                }
                            },
                            ticks: {
                                color: 'red'
                            },
                            min: 0,
                            max: 100
                        }
                    },
    
                },
            };
    
    
    
            const myChart8 = new Chart(ctx, config)
        </script>


        <!-- 3 -->
        <div class="chart-box dark">

            <div class="chart-header dark text-center">
                <h4>109年全北市各行業之電子發票B2C開立之平均客單價</h4>
                <!-- <h3 class="title">圓餅圖樣式</h3> -->

            </div>

            <div class="chart-body">
                <canvas id="myChart-4"></canvas>
                <script>
                    var ctx = document.getElementById('myChart-4');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區',
                                '南港區', '文山區'
                            ],
                            datasets: [{
                                backgroundColor: [
                                    'rgba(0, 74, 255, 0.72)',
                                    'rgba(54, 255, 235, 0.5)',
                                    'rgba(199, 255, 55, 1)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 0, 0, 0.72)',
                                    'rgba(245, 40, 33, 0.43)', 'rgba(245, 208, 33, 0.43)',
                                    'rgba(58, 208, 33, 0.43)', 'rgba(58, 208, 171, 0.43)',
                                    'rgba(255, 86, 171, 0.43)', 'rgba(255, 86, 0, 0.4)',
                                    'rgba(31, 0, 0, 0.18)'
                                ],
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 3,
                                label: '標籤名稱',
                                data: [88720, 95424, 137013, 76543, 104554, 37751, 112401, 54208, 56856,
                                    30673, 88873,
                                    12102
                                ],
                                fill: false, // 是否填滿色彩
                            }]
                        },
                        options: {
                            legend: {
                                labels: {
                                    fontColor: 'black' // 標籤顏色 
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <!-- 4 -->
        <div class="chart-box dark">

            <div class="chart-header dark text-center">
                <h4>110年全北市各行業之電子發票B2C開立之平均客單價</h4>
                <!-- <h3 class="title">圓餅圖樣式2</h3> -->

            </div>

            <div class="chart-body">
                <canvas id="myChart-6"></canvas>
                <script>
                    var ctx = document.getElementById('myChart-6');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['中正區', '大同區', '中山區', '松山區', '大安區', '萬華區', '信義區', '士林區', '北投區', '內湖區',
                                '南港區', '文山區'
                            ],
                            datasets: [{
                                backgroundColor: [
                                    'rgba(0, 74, 255, 0.72)',
                                    'rgba(54, 255, 235, 0.5)',
                                    'rgba(199, 255, 55, 1)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 0, 0, 0.72)',
                                    'rgba(245, 40, 33, 0.43)', 'rgba(245, 208, 33, 0.43)',
                                    'rgba(58, 208, 33, 0.43)', 'rgba(58, 208, 171, 0.43)',
                                    'rgba(255, 86, 171, 0.43)', 'rgba(255, 86, 0, 0.4)',
                                    'rgba(31, 0, 0, 0.18)'
                                ],
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 3,
                                label: '標籤名稱',
                                data: [81645, 40040, 64244, 78722, 112983, 48389, 101189, 57170, 51766,
                                    63018, 44479,
                                    88720
                                ],
                                fill: false, // 是否填滿色彩
                            }]
                        },
                        options: {
                            legend: {
                                labels: {
                                    fontColor: 'black' // 標籤顏色 
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>