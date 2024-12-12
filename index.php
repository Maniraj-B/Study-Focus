<?php 
include_once ("db.php");
$error = '';
// Signup process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypt_pass = md5($password);
    function generateUniqueID($length = 8) {
        $characters = '0123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
        $randomString = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $max)];
        }
        return $randomString;
    }
    $uid = generateUniqueID(8);
    // Checking user credentials
    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql1);
    if ($result->num_rows !== 1) {
            $sql = "INSERT INTO users (uid, name, email, password) VALUES ('$uid', '$name', '$email', '$encrypt_pass')";
            if ($conn->query($sql) === TRUE) {
                $rand_id = mt_rand(100000, 999999);
                $sql3 = "UPDATE `users` SET `code`='$rand_id', `status`='na' WHERE email='$email' ";
                $result3 = $conn->query($sql3);
                if ($result3->num_rows !== 1) {
                    $receiver = $email;
                    $subject = "Your Account Verification - Team studyfocus";
                    $body = "    
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>OTP Verification</title>
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
  h1 {
    text-align: center;
  }
  p {
    line-height: 1.6;
  }
  .button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
  }
  .button:hover {
    background-color: #0056b3;
  }
  .footer {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
  }
  </style>
</head>
<body>
  <div class='container'>
    <p>Dear <b>$name</b>,</p>
    <p>Thank you for choosing our platform. To ensure the security of your account, we require a one-time password (OTP) verification process.</p>
    <p>Your OTP: <span style='font-size:17px;'> <strong>$rand_id</strong></span></p>
    <p>Please enter this code in the designated field on our website to complete the activation process.</p>
    <p>We value your trust and are committed to providing you with a secure experience.</p>
    <p>Best regards,<br><b>Team StudyFocus<b></p>
  </div>
  <div class='footer'>
    <p>If you have any questions, please contact us at adhvikreddy02@gmail.com.</p>
  </div>
</body>
</html>";
                    $headers = "From:adhvikreddy02@gmail.com\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    if (mail($receiver, $subject, $body, $headers)) {
                        $error = "Email sent to " . $receiver ;
                        header("location: otp.php?mail=$receiver");
                    } else {
                        $error = "Sorry Failed to send email";
                    }
                }

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $error = "Email id is already in use" ;
        }}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | studyfocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>window.onload = function () {document.getElementById('name').focus();}</script></head>
</head>
<body>
    <div class="container mt-5">
          <h1><img src="logo.png" style="height:220px;width:250px"> Register</h1>
        <form id="signup-form" action="#" method="post">
            <div class="row">
                <div class="col-md-6"><br>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                    </div>
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
                    <button id="btn" class="btn btn-primary" onclick="dis()">Continue</button>
                     &nbsp;&nbsp;<a href="login">already have an account ?</a>
                    <script>
                        function dis() {
                            var form = document.getElementById("signup-form");
                            var i1 = document.getElementById("name").value;
                            var i2 = document.getElementById("email").value;
                            var i3 = document.getElementById("password").value;
                            if (i1 === '' || i2 === '' || i3 === '' || i3.length < 8) {
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
        input:focus {
          
}
</style>
</html>