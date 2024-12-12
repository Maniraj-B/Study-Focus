<?php
session_start(); 
if (!isset($_SESSION['id'])) {
    $url = $_SERVER['REQUEST_URI'];
    header("location: /studyfocus");
}
include_once ("db.php");

$ct = $_GET['ct'];
$dt = $_GET["dt"];
$tst = $_GET["tst"];
$cl = $_GET["cl"];
$uid = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE uid='$uid'";
$result = $conn->query($sql);
   while ($row = mysqli_fetch_array($result)) {  
    $ucl = $row["cl"];
    $uts = $row["no_session"];
   
    $icl = $ucl + $cl;
    $its = $uts + 1;
    
    $sql1 = "UPDATE users SET cl='$icl', no_session='$its'  WHERE uid='$uid' ";
    $result1 = $conn->query($sql1);

   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics || StudyFocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<div class="head">
       <a href='home'> <img src="logo.png"></a>
       <a href="profile"> <span><i class='bx bx-user-circle' ></i> Profile</span></a>
       </div>
    <br><br><br><br><br>
    <hr>
    <div class="container">
    <h4><b>Concentration Time</b> : <?php echo $ct; ?></h4>
    <h4><b>Distraction Time</b> : <?php echo $dt; ?></h4>
    <h4><b>Total Session Time</b> : <?php echo $tst; ?></h4>
    <h4><b>Concentration level</b> : <?php echo $cl; ?></h4><br><Br>
    <div class="chart-container">
        <div class="chart">
            <svg viewBox="0 0 200 200">
                <circle class="background" cx="100" cy="100" r="85"></circle>
                <circle class="concentration" cx="100" cy="100" r="85"></circle>
                <text x="100" y="110" text-anchor="middle" class="percentage-label"></text>
            </svg>
        </div>
        <div class="chart-text">
            <div class="percentage"><?php echo $cl; ?></div>
            <div class="label">Concentration</div>
        </div>
    </div>
    </div>

   

    <script>
        // Get the dynamic concentration time and total session time from template
        const concentrationTime = <?php echo $ct; ?>;
        const totalTime = <?php echo $tst; ?>;
        
        // Calculate the concentration level percentage
        const concentrationLevel = (concentrationTime / totalTime) * 100;

        // Update the chart text
        document.querySelector('.percentage').textContent = `${Math.round(<?php echo $cl; ?>)}%`;

        // Update the pie chart based on the concentration level
        const circle = document.querySelector('.concentration');
        
        // Calculate circumference of the circle
        const radius = 85;
        const circumference = 2 * Math.PI * radius;

        // Calculate dasharray for percentage
        const dashArray = (concentrationLevel / 100) * circumference;

        // Apply styles to circle
        circle.style.strokeDasharray = `${dashArray} ${circumference}`;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
<style>
          html, body {
      height: 99%;
      width: 99%;
    }
    body {

      background: linear-gradient(180deg, #000 66.02%, #1DB5BE 160.74%);
      color: white;
    }
    .head img{
        height: 290px;
        position: fixed;
        margin-top: -90px;
        margin-left: -60px;
        z-index: 1;
    }
    body span{
      font-size:30px;
    }
    .head span{
        position: fixed;
        right: 0;
        margin-right: 30px;
        margin-top: 20px;
        z-index: 1;
    }
    .chart-container {
            display: inline-block;
            position: relative;
            width: 200px;
            height: 200px;
        }

        .chart {
            width: 100%;
            height: 100%;
        }

        .chart-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .chart-text .percentage {
            font-size: 24px;
            font-weight: bold;
            color: #39CEF3;
        }

        .chart-text .label {
            font-size: 14px;
            color: #666;
        }

        svg {
            transform: rotate(-90deg);
        }

        .background {
            fill: none;
            stroke: #f0f0f0;
            stroke-width: 30;
        }

        .concentration {
            fill: none;
            stroke: #39CEF3;
            stroke-width: 30;
            stroke-linecap: round;
            stroke-dasharray: 0 534;
            stroke-dashoffset: 0;
            transition: stroke-dasharray 0.3s ease;
        }
        a{
      color: white;
      text-decoration: none;
    }
    a:hover{
      color:#1DB5BE;
    }
        </style>
</html>