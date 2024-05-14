<?php
session_start(); // Start session if not started already

include "header.php";
include "sidebar.php";
include "config.php";


  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM sms_setting WHERE id = ?");
    $id = 1; // Assuming you want to search for a specific ID, replace 1 with the actual ID value you're looking for
    $stmt->execute([$id]);

    // Check if data is fetched successfully
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : $row['uname']; // Initialize with session value or from database
        $password = isset($_SESSION['password']) ? $_SESSION['password'] : $row['password']; // Initialize with session value or from database
        $sender_id = isset($_SESSION['sender_id']) ? $_SESSION['sender_id'] : $row['sender_id']; // Initialize with session value or from database
    } else {
        // Handle case when no data is found
        $uname = '';
        $password = '';
        $sender_id = '';
        // You might also set some default values or display an error message
    }
    // Rest of the code remains the same

    if(isset($_POST['update'])) {
        $sql = "UPDATE sms_setting SET uname=?, password=?, sender_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['uname'], $_POST['password'], $_POST['sender_id'], $id]);

        $_SESSION['success'] = 'Record Updated Successfully';
        header("location:sms_setting.php");
        exit(); // Exit after redirect
    } 
}
catch(PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header("location: ../sms_setting.php");
    exit(); // Exit after redirect
}

$conn = null;
?>

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add SMS Settings</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">SMS Settings</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-primary">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-body">
                                <h3 class="card-title m-t-15">SMS Settings</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" value="<?php echo $uname;?>" name="uname" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" value="<?php echo $password;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sender Id</label>
                                            <input type="text" name="sender_id" value="<?php echo $sender_id;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success" name="update"><i class="fa fa-check"></i> Update</button>
                                <a href="email_setup.php"><button type="button" class="btn btn-inverse">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<?php if(!empty($_SESSION['success'])) { ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">Success</h3>
        <p><?php echo $_SESSION['success']; ?></p>
        <?php echo "<script>setTimeout(\"location.href='sms_setting.php'\", 2000);</script>" ?>
    </div>
</div>
<?php unset($_SESSION["success"]); } ?>

<?php if(!empty($_SESSION['error'])) { ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">Error</h3>
        <p><?php echo $_SESSION['error']; ?></p>
        <?php echo "<script>setTimeout(\"location.href='sms_setting.php'\", 2000);</script>" ?>
    </div>
</div>
<?php unset($_SESSION["error"]); } ?>

<script>
    var addButtonTrigger = function addButtonTrigger(el) {
        el.addEventListener('click', function () {
            var popupEl = document.querySelector('.' + el.dataset.for);
            popupEl.classList.toggle('popup--visible');
        });
    };

    Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
</script>
