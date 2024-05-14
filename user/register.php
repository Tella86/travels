<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fullname'], $_POST['email'], $_POST['password'], $_POST['contact'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $fullname    = $_POST['fullname'];
            $email    = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
            $contact  = $_POST['contact'];

            $sql  = "INSERT INTO register (fullname, email, password, contact) VALUES (:fullname, :email, :password, :contact)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':contact', $contact);
            $stmt->execute();

            $_SESSION['reply'] = "New record created successfully";
            header("Location:page-login"); // Redirect after successful registration
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    } else {
        echo "All fields are required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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



    </head>

<body class="fix-header fix-sidebar">

    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <h4>Register</h4>
                                <?php if (isset($_SESSION['reply'])) : ?>
                                <div class="alert alert-success mb-2" role="alert">
                                    <?= htmlspecialchars($_SESSION['reply']) ?></div>
                                <?php endif; ?>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" name="fullname"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact No</label>
                                        <input type="tel" maxlength="10" class="form-control" placeholder="Contact No"
                                            name="contact" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" placeholder="Upload your Photo"
                                            name="photo" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Document</label>
                                        <input type="file" class="form-control" placeholder="Document" name="docs"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"
                                        name="submit">Register</button>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have an account? <a href="page-login">Sign in</a></p>
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