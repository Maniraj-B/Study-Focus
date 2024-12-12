<?php 
include_once ("db.php");
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql1);
    if ($result->num_rows !== 1) {
        $error = "Email Id Is Not founded." ;      
    }
    else{

        $ran_id = mt_rand(100000, 999999);
        $sql = "UPDATE `users` SET `code`='$ran_id' WHERE email='$email' ";
        $result = $conn->query($sql);
        if ($result->num_rows !== 1){
            $receiver = $email;
            $subject = "Your Password Change OTP Verification - Team studyfocus";
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
<p>Dear <b>User</b>,</p>
<p>To ensure the security to change the account password, we require a one-time password (OTP) verification process.</p>
<p>Your OTP: <span style='font-size:17px;'> <strong>$ran_id</strong></span></p>
<p>Please enter this code in the designated field on our website to complete the forgot password verification process.</p>
<p>We value your trust and are committed to providing you with a secure experience.</p>
<p>Best regards,<br><b>Team StudyFocus<b></p>
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
                $error = "Email sent to " . $receiver;
                header("location: fp_?mail=$receiver");

    
            }else{
                $error = "Sorry Failed to send email";
            }

        }
        else{

           $error = "failed";
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
    <title>Forgot Password | studyfocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>window.onload = function () {document.getElementById('name').focus();}</script></head>
</head>
<body>
    <div class="container mt-5">
        <h1><img src="logo.png" style="height:220px;width:250px"> Forgot Password</h1>
        <form id="fp-form" action="#" method="post">
            <div class="row">
                <div class="col-md-6"><br>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                    </div>

                     <?php echo "<p style='color:red;'>$error</p>";  ?>
                    <button id="btn" class="btn btn-primary" onclick="dis()">Continue</button>
                    <script>
                        function dis() {
                            var form = document.getElementById("fp-form");
                            var i1 = document.getElementById("email").value;
                            if ( i1 === '') {
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