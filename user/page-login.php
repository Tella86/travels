<?php
session_start();
function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$servername = "localhost";
$username   = "root";
$password   = "Elon2508/*-";
$database   = "tour1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

try {
 if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Sanitize email input
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

  // Prepare and bind the SQL statement
  $stmt = $conn->prepare("SELECT id, email, password FROM register WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
   $user = $result->fetch_assoc();

   // Verify password
   if (password_verify($_POST["password"], $user["password"])) {
    $_SESSION["id"]    = $user["id"]; // Storing user ID in session
    $_SESSION["email"] = $user["email"];

    ?>

      
    <div class="popup popup--icon -success js_success-popup popup--visible">
<div class="popup__background"></div>
<div class="popup__content">
<h3 class="popup__content__title">
Success 
</h1>
<p>Login Successfully</p> 
<p>

<?php echo "<script>setTimeout(\"location.href = 'index';\",1500);</script>"; ?>
</p>
</div>
</div> 
<?php
    }
}
else {?>
     <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Invalid Email or Password</p>
    <p>
       <?php echo "<script>setTimeout(\"location.href = 'page-login';\",2000);</script>"; ?>
     
    </p>
  </div>
</div>
<?php

}

}
}
catch(PDOException $e)
{



echo "Error: " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Tours and Travel Management</title>

    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/popup_style.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

   
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Tours and Travel Management</title>

    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     <link href="css/popup_style.css" rel="stylesheet">



</head>

<body class="fix-header fix-sidebar">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                              <center> <img src="../admin/settings/logo-no-background.png" style="height:auto; width: 190px;" alt="homepage" class="dark-logo">
</center><br>
                                <h4><strong>Client Login</strong></h4>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
        										<input type="checkbox"> Remember Me
        									</label>
                                        <label class="pull-right">
        										<a href="forget_password">Forgotten Password?</a>
        									</label>

                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="btn_login">Sign in</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Don't have account ? <a href="register"> Sign Up Here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="js/lib/jquery/jquery.min.js"></script>

    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/jquery.slimscroll.js"></script>

    <script src="js/sidebarmenu.js"></script>

    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

    <script src="js/custom.min.js"></script>

</body>

</html>