<?php
session_start();
$zone = "no zone";$txt="";$ratio="no ratio";$i1="";
if (!isset($_SESSION['id'])) {
    $url = $_SERVER['REQUEST_URI'];
    header("location: /studyfocus");
}
include_once ("db.php");

$uid = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE uid='$uid'";

$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {  
    $ucl = $row["cl"];
    $uts = $row["no_session"];
    $name = $row["name"];


    if($uts == 0){ 
    }else{
        $avg = $ucl / $uts ;
        $ratio = $avg / 100 ;

        if ($avg > 95){
            $zone = "Excellent"; 
            $txt = "You are above 90% Students";
            $i1 = "04";
            $i2 = "05";
            $i3 = "06";

        }
        else if (75 < $avg && 95 > $avg){
            $zone = "Good";
            $txt = "You are above 75% Students";
            $i1 = "07";
            $i2 = "08";
            $i3 = "14";
        }
        else if (50 < $avg && 74 > $avg){
            $zone = "Moderate";
            $txt = "You are above 50% Students";
            $i1 = "10";
            $i2 = "11";
            $i3 = "12";
        }
        else {
            $zone = "Need To be improved";
            $txt = "You are below 50% Students";
            $i1 = "13";
            $i2 = "14";
            $i3 = "15";
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile || StudyFocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="head">
      <a href='home'>  <img src="logo.png"></a>
      <br>
      <span><h2> <?php echo $name ?> <i class='bx bx-user-circle' ></i></h1></span>
    </div>
<br><br><br>
   <hr>
<br><br>

<div class="container">
<div class="per">
<h4>Zone "<?php echo $zone ?>"</h4>
</div>
<h5><?php echo $txt; ?></h5><br>
<h4>Average Concentration <br> Ratio <span><?php echo $ratio; ?></span></h4>
<h5>Total Number of sessions : <?php echo $uts ?></h5>


<br><Br><br><br><br>

<?php  
if($i1 == ""){

}else{
    echo "<div class='container'>
    <div id='carouselExampleAutoplaying' class='carousel slide' data-bs-ride='carousel'>
        <div class='carousel-inner'>
          <div class='carousel-item active'>
            <a href='articles/$i1'> <img src='articles/img/$i1.jpg' class='d-block w-100' alt='...'></a><br><br><br>
          </div>
          <div class='carousel-item'>
          <a href='articles/$i2'> <img src='articles/img/$i2.jpg' class='d-block w-100' alt='...'></a><br><br><br>
          </div>
          <div class='carousel-item'>
          <a href='articles/$i3'> <img src='articles/img/$i3.jpg' class='d-block w-100' alt='...'></a><br><br><br>
          </div>
        </div>
        <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleAutoplaying' data-bs-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleAutoplaying' data-bs-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Next</span>
        </button>
      </div>
</div>";
}
?>






<a href="logout"> <p class="log">Logout <i class='bx bx-log-in-circle'></i></p></a>
</div>


<br>
<div class="container">
    
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<style>
    html, body {
      height: 100%;
      width: 100%;
    }
    body {
      background: linear-gradient(180deg, #000 66.02%, #1DB5BE 220.74%);
      color: white;
    }
    .head img{
        height: 290px;
        position: fixed;
        margin-top: -90px;
        margin-left: -60px;
        z-index: 1;
    }
    .head span{
        position: fixed;
        right: 0;
        margin-right: 30px;
        margin-top: 20px;
        z-index: 1;
    }
    .per h4{
        background: linear-gradient(270deg, #000 66.02%, #1DB5BE 110.74%);
        padding : 20px;
        border-radius : 10px 0px 0px 10px;
    }
    .container h4{
        font-size:35px;
    }
    .container h4 span{
        font-size : 55px;
    }
    a{
        color:silver;
        text-decoration : none;
    }
    a:hover{
        color:#1DB5BE;
    }
    .carousel-item img{
        height: 370px; 
    }
    button{
      background-color: transparent;
      border: none;
      color: white;
      text-decoration: underline;
      transition: 0.7s all;
    }
    button:hover{
      color: #1DB5BE;
    }
</style>
</style>
</html>