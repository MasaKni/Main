<?php

session_start();
if ($_SESSION['isLoggedIn'] == 0){
    header("Location: logIn.php");
}else {
    $names = '';
    $Qty = '';
    $sentence = '';
    $conn = mysqli_connect("localhost", "admin", "123456", "sprinkles");
    if (mysqli_connect_error()) {
        echo "Can't connect to database";
        die();
    }
    if (isset($_POST['button'])) {
        if (!empty($_POST["sweet"])) {
            if ($_POST["sweet"] == "Donuts") {
                $strQry = "SELECT `name`,`quantity` FROM `product` WHERE `category`='Donuts'";
                $sentence = 'Donuts In Storage';
            } else if ($_POST["sweet"] == "Macaroons") {
                $strQry = "SELECT `name`,`quantity` FROM `product` WHERE `category`='Macaroons'";
                $sentence = 'Macaroons In Storage';
            } else if ($_POST["sweet"] == "Cookies") {
                $strQry = "SELECT `name`,`quantity` FROM `product` WHERE `category`='Cookies'";
                $sentence = 'Cookies In Storage';
            } else if ($_POST["sweet"] == "Cakes") {
                $strQry = "SELECT `name`,`quantity` FROM `product` WHERE `category`='Cakes'";
                $sentence = 'Cakes In Storage';
            } else {
                $strQry = "SELECT `name`,`quantity` FROM `product` WHERE `category`='pies&tarts'";
                $sentence = 'Pies and Tarts In Storage';
            }
            $res = $conn->query($strQry);
            while ($rows = mysqli_fetch_array($res)) {
                $Qty = $Qty . '"' . $rows['quantity'] . '",';
                $names = $names . '"' . $rows['name'] . '",';
            }
            $Qty = trim($Qty, ",");
            $names = trim($names, ",");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="shortcut icon" href="images/cupcakeIcon.png">
    <title>Sprinkles Chart.js Chart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <style>
        .icon-bar {
            width: 100%; /* Full-width */
            background-color: #555; /* Dark-grey background */
            overflow: auto;
        }

        .icon-bar a {
            float: right;
            text-align: center;
            width: 20%;
            padding: 12px 0;
            transition: all 0.3s ease;
            color: white;
            font-size: 36px;
        }

        .icon-bar a:hover {
            background-color: #000; /* Add a hover color */
        }

        .active {
            background-color: #4fbfa8; /* Add an active/current color */
        }
    </style>


<style>
    .Frm
    {
        text-align: center;
        align-items: center;
        padding-top: 50px;
        font-size: 25px;
    }
    input[type="radio"]{
        margin-left: 20px ;
    }
</style>
</head>
<body style="background-color: #fff2ec">
<div class="icon-bar">
    <a class="active" href="choose.php"><i class="fa fa-home"></i>Home</a>
</div>


<h1 style="text-align: center; color: #191970">Available products and their quantities in Sprinkles</h1>
<form action="chart.php" method="post" class="Frm" >
    <input type="radio" name='sweet' value="Macaroons" id="Macaroons"><label for="Macaroons">Macaroons</label>
    <input type="radio" name='sweet' value="Donuts" id="Donuts"><label for="Donuts">Donuts</label>
    <input type="radio" name='sweet' value="Cakes" id="Cakes"><label for="Cakes">Cakes</label>
    <input type="radio" name='sweet' value="Pies&Tarts" id="Pies&Tarts"><label for="Pies&Tarts">Pies and Tarts</label>
    <input type="radio" name='sweet' value="Cookies" id="Cookies"> <label for="Cookies">Cookies</label><br><br>

    <input type="submit" value="Draw" name='button' style="background-color: midnightblue; color: white ;height: 40px; width: 100px;">
</form>

<canvas id="myChart" style="alignment: center ;width: 200px; height: 100px; float: bottom"></canvas>

<script>
    let myChart = document.getElementById('myChart').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 20;
    Chart.defaults.global.defaultFontColor = '#191970';

    let massPopChart = new Chart(myChart, {
        type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:[<?php echo $names;?>],//names from database
            datasets:[{
                data:[<?php echo $Qty;?>
                ],//quantity from database
                backgroundColor:[
                    '#ABDEE6',
                    '#CBAACB',
                    '#FFFFB5',
                    '#F3B0C3',
                    '#55CBCD',
                    '#97C1A9',
                    '#FF968A',
                    '#981D50'
                ],
                borderWidth:1,
                borderColor:'#777',
                hoverBorderWidth:3,
            }]
        },
        options:{
            title:{
                display:true,
                text:'<?php echo $sentence?>',
                fontSize:30
            },
            legend:{
                display:true,
                position:'left',
                labels:{
                    fontColor:'black'
                }
            },
            layout:{
                padding:{
                    left:50,
                    right:50,
                    bottom:50,
                    top:50
                }
            },
            tooltips:{
                enabled:true
            }
        }
    });
</script>
</body>
</html>
