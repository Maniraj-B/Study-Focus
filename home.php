<?php
session_start();
if (!isset($_SESSION['id'])) {
    $url = $_SERVER['REQUEST_URI'];
    header("location: /studyfocus");
}
include_once ("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyFocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="head">
        <img src="logo.png">
        <a href="profile"> <span><i class='bx bx-user-circle' ></i> Profile</span></a>
    </div>

   <br><br><br><br><br>
    <div class="container text-center">
        <div class="row align-items-start">
          <div class="col">
          <a href="studyfocusglobalsearch"> <img src="globalsearch.png" style="height: 90px;width: 90px;"><br><br>
            Global Search</a>
          </div>
          <div class="col">
          <a href="http://127.0.0.1:5000/"> <img src="sessionstart.png" style="height: 90px;width: 90px;"><br><br>
            Start Your Session </a> 
          </div>
          <div class="col">
          <a href="studyfocusAi"> <img src="aichatbot.png" style="height: 90px;width: 90px;"><br><br>
            AI Chatbot</a>
          </div>
        </div>
      </div>

<br><br><br>


<div class="container">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="1.png.jpg" class="d-block w-100" alt="...">
            <br><br><br><br><br><br><br><br>
            <div class="carousel-caption d-none d-md-block">
                <h5>Here are detailed tips to help you develop a disciplined and productive study routine:</h5>
                <p>1.	Create a Dedicated Study Space Your environment plays a significant role in determining your focus levels.</p>
                <button onclick="read1()">read more</button>
                <script>
                  function read1(){
                    window.location.href = "articles/02.php"
                  }
                  </script>
              </div>
          </div>
          <div class="carousel-item">
            <img src="2.png.jpg" class="d-block w-100" alt="...">
            <br><br><br><br><br><br><br><br>
            <div class="carousel-caption d-none d-md-block">
                <h5>The food we consume plays a significant role in determining our concentration levels </h5>
                <p>1.	Glucose as Brain Fuel:	The brain relies on glucose from carbohydrates as its primary energy source.</p>
                <button onclick="read2()">read more</button>
                <script>
                  function read2(){
                    window.location.href = "articles/01.php"
                  }
                  </script>
              </div>
          </div>
          <div class="carousel-item">
            <img src="3.png.jpg" class="d-block w-100" alt="...">
            <br><br><br><br><br><br><br><br>
            <div class="carousel-caption d-none d-md-block">
                <h5>A student’s ability to focus is influenced significantly by their sleeping schedule</h5>
                <p>1.	The Role of a Healthy Sleeping Schedule</b> Sleep is essential for cognitive health, memory consolidation, </p>
                <button onclick="read3()">read more</button>
                <script>
                  function read3(){
                    window.location.href = "articles/03.php"
                  }
                  </script>
              </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
</div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<style>
    html, body {
      height: 95%;
      width: 100%;
    }
    body {
      background: linear-gradient(180deg, #000 66.02%, #1DB5BE 220.74%);
      color: white;
    }
    body span{
      font-size:30px;
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
    a{
      color: white;
      text-decoration: none;
    }
    a:hover{
      color:#1DB5BE;
    }
</style>
</html>