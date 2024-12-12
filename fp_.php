<?php
include_once ("db.php");
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['mail'];
    $otp = $_POST['otp'];
    // Checking user credentials
    $sql = "SELECT * FROM users WHERE email='$email' AND code='$otp'";
    $result = $conn->query($sql);
    if ($result->num_rows !== 1) {
     
        $error = "Invalid otp";

        
    } else {
        $sql1 = "UPDATE `users` SET `stpass`='a' WHERE email='$email' ";
        $result = $conn->query($sql1);

        if ($result->num_rows !== 1) { 
            header("location: cp?mail=$email");
        }
        else{
            $error = "none";
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
    <title>otp | studyfocus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>window.onload = function () {document.getElementById('otp').focus();}</script></head>
  </head>
  <body>
    <div class="container mt-5">
        <h1><img src="logo.png" style="height:220px;width:250px"> Forgot Password</h1>
        <form id="otp-form" action="#" method="post">
            <div class="row">
                <div class="col-md-6"><br>
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter Otp (sent to your mail id) :</label>
                        <input type="text" class="form-control" id="otp" name="otp" autocomplete="off" minlength="6"
                        maxlength="6" required>
                    </div> 
                    <?php echo "<p style='color:red;'>$error</p>";  ?>
                <button type="submit" id="btn" class="btn btn-primary" onclick="dis()">Continue</button>
                <script>
                     function dis() {
                            var form = document.getElementById("otp-form");
                            var i1 = document.getElementById("otp").value;
                            if (i1 === '') {
                                document.getElementById("alert").value = 'Please fill in all fields.';
                            } else {
                                document.getElementById("btn").disabled = true;
                                form.submit();
                             }
                        }
                </script>
                                </div>
                <div class="col-md-6">
                    <img src="bg.png" >
                </div>
            </div>
                </form>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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