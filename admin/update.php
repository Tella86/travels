<?php
require_once('check_login.php');
?>
<?php include"header.php"?>

<?php include"sidebar.php"?>
<?php
 include('config.php');
 try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM admin where id='".$_SESSION['id']."'"); 
    $stmt->execute();
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    $db_pass = $data['password'];
     if(isset($_POST["submit"]))
       {
  
           $old = hash('sha256',$_POST['old_password']);
           $pass_new = hash('sha256', $_POST['new_password']);
           $confirm_new = hash('sha256', $_POST['confirm_password']);


function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$old_pass =  hash('sha256', $salt . $old); 
$new_pass =  hash('sha256', $salt . $pass_new); 
$confirm =  hash('sha256', $salt . $confirm_new);

  if($db_pass!=$old_pass){ ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
            </h1>
            <h2>Old Password is not Matched</h2>
            <p>
                <?php echo "<script>
  setTimeout(\"location.href='change_password.php'\", 2000);

</script>"?>
            </p>
    </div>
</div>

<?php } else if($new_pass!=$confirm){ ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
            </h1>
            <h2>New Password and Confirm Password Not Matched</h2>
            <p>
                <?php echo "<script>
  setTimeout(\"location.href='change_password.php'\", 2000);

</script>"?>
            </p>
    </div>
</div>

<?php } else {
    
 
         $abc = "UPDATE admin SET `password`='$confirm' where id = '".$_SESSION['id']."'";


    $stmt = $conn->prepare($abc);


    $stmt->execute();
   
  ?>

<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Success </h3>
        </h1>
        <h2>Password Change Successfully</h2>
        <p>

            <?php echo "<script>setTimeout(\"location.href = 'change_password.php';\",1500);</script>"; ?>
        </p>
    </div>
</div>

<?php
    
  }
}
}

catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


    

$conn = null;

?>

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Change Password</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Change Password</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" method="post">

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password"> Old Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-password"
                                            name="old_password" placeholder="Enter your old password.." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">New Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-confirm-password"
                                            name="new_password" placeholder="..Enter your New password!" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm Password
                                        <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-confirm-password"
                                            name="confirm_password" placeholder="..and confirm it!" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php include"footer.php"?>