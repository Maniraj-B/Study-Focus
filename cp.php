<?php
include_once ("db.php");
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_GET['mail'];
    $password = $_POST['password'];
    $enp = md5($password);
    // Checking user credentials
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows !== 1) {
     
        $error = "Invalid emailid" ;

        
    } else {


        while ($row = mysqli_fetch_array($result)) {

            if($row["stpass"] == 'na'){
             
                $error = "no otp registered";
            }
            else{


                


                $sql1 = "UPDATE `users` SET `password`='$enp', `code`='0', `stpass`='na'  WHERE email='$email' ";
                $result1 = $conn->query($sql1);
        
                if ($result1->num_rows !== 1) { 
                
                    $receiver = $email;
                    $subject = "Password Changed - Team studyfocus";
                    $body = "
                    <html>
                    <head>
                        <style>
                            
        body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        }
        
        .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background: linear-gradient(to right, #1db5be 0%, #4481eb 51%, #1db5be 100%);
        color : white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #666;
        }
        .header {
        text-align: center;
        margin-bottom: 30px;
        }
        .message {
        text-align: center;
        margin-bottom: 30px;
        }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>Account Password Changed!</h2>
                            </div>
                            <div class='message'>
                                <p>Your account  password has been successfully changed.</p>
                                <p>Thank you for choosing <b>studyfocus</b>.</p>
                            </div>
                        </div>
                        <div class='footer'>
                             <p>If you have any questions, please contact us at adhvikreddy02@gmail.com.</p>
                        </div>
                    </body>
                    </html>
                    ";
                    
                    $headers = "From:adhvikreddy02@gmail.com\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
                    if(mail($receiver, $subject, $body, $headers)){
        
                        header("location: http://localhost/studyfocus/");
                    }
                    
                }
                else{
                  
                    $error = "none";
        
                }
 

            }
        }  
        

        
                          }
          
         }     

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password | studyfocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>window.onload = function () {document.getElementById('name').focus();}</script></head>
</head>
<body>
    <div class="container mt-5">
          <h1><img src="logo.png" style="height:220px;width:250px"> Change Your Password</h1>
        <form id="signup-form" action="#" method="post">
            <div class="row">
                <div class="col-md-6"><br>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8"
                            maxlength="16" required>
                    </div> 
                     <?php echo "<p style='color:red;'>$error</p>";  ?>
                    <button id="btn" class="btn btn-primary" onclick="dis()">Continue</button>
                    <script>
                        function dis() {
                            var form = document.getElementById("signup-form");
                            var i1 = document.getElementById("password").value;
                            if (i1 === '' || i1.length < 8) {
                                document.getElementById("alert").value = 'Please fill in all fields.';
                            } else {
                                document.getElementById("btn").disabled = true;
                                form.submit();
                             }
                        }
                    </script>
                </div>
                <div class="col-md-6">
                    <img src="bg.png">
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