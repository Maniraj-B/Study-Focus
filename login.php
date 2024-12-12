<?php 
include_once ("db.php");
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypt_pass = md5($password);
    // Checking user credentials
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$encrypt_pass'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        while ($row = mysqli_fetch_array($result)) {
            if($row["status"] == 'na'){
            $error = " activate your accouont to continue";
            }
            else if($row["status"] == 'd'){
                $error = "user account deleted";  
                }
            else{                 
                        session_start();
                        $_SESSION['id'] = $row['uid']; 
                        
                        if(isset($_GET['to'])){
                            $back = $_GET['to'];
                            echo "<script> window.location.href = '$back'; </script>";
                        }
                        else{
                            header('location: /studyfocus/home.php');
                        }
                                            
                    }           
        }
    } else {
                    $error =  "Invalid mailid or password.";           
        }
    }
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | studyfocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>window.onload = function () {document.getElementById('name').focus();}</script></head>
</head>
<body>
    <div class="container mt-5">
        <h1><img src="logo.png" style="height:220px;width:250px"> Login</h1>
        <form id="login-form" action="#" method="post">
            <div class="row">
                <div class="col-md-6"><br>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8"
                            maxlength="16" required>
                    </div>
                     <?php echo "<p style='color:red;'>$error</p>";  ?>
                    <button id="btn" class="btn btn-primary" onclick="dis()">Continue</button><br><br>
                    &nbsp;&nbsp;<a href="index">don't have an account ?</a>&nbsp;|&nbsp;<a href="fp">forgot password ?</a>&nbsp;|&nbsp;<a href="verify">verify ?</a>
                    <script>
                        function dis() {
                            var form = document.getElementById("login-form");
                            var i1 = document.getElementById("email").value;
                            var i2 = document.getElementById("password").value;
                            if ( i1 === '' || i2 === '' || i2.length < 8) {
                                document.getElementById("alert").value = 'Please fill in all fields.';
                            } else {
                                document.getElementById("btn").disabled = true;
                                form.submit();
                             }
                        }
                    </script>
                </div>
                <div class="col-md-6">
                    <img src="log.jpg"><br><br>
                    <p style="font-size:22px;margin-left:220px;">WELCOME BACK </P>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<style>
    html, body {
      height: 100%;
      width: 100%;
      overflow: hidden;
    }
    body {
      background: linear-gradient(180deg, #000 66.02%, #1DB5BE 130.74%);
      color: white;
    }

    .container a{color: white;}
    .container a:hover{color: #1db5be;}
    .btn{
     background : linear-gradient(271deg, #1DB5BE -28.59%, #000 64.27%);
     border : 1px solid black;
        }
        .btn:hover{
          background : linear-gradient(71deg, #1DB5BE -28.59%, #000 64.27%);
          border : 1px solid #1db5be;

        }
</style>

</html>