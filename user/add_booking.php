<?php
// require_once('check_login.php');
?>
<?php include "header.php"?>

<?php include"sidebar.php"?>
<?php

$servername = 'localhost';
$username = 'root';
$password = 'Elon2508/*-';
$dbname = 'tour1';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM travellers where id='"."'"); 
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $travellers=$stmt->fetchAll();


    $stmt9 = $conn->prepare("SELECT id,state_name FROM travellers group by state_name"); 
    $stmt9->execute();

    $result9 = $stmt9->setFetchMode(PDO::FETCH_ASSOC); 
    $state=$stmt9->fetchAll();


     $stmt1 = $conn->prepare("SELECT * FROM packages"); 
    $stmt1->execute();

    $result1 = $stmt1->setFetchMode(PDO::FETCH_ASSOC); 
    $packages=$stmt1->fetchAll();

     $stmt1 = $conn->prepare("SELECT * FROM travellers"); 
    $stmt1->execute();

    $result1 = $stmt1->setFetchMode(PDO::FETCH_ASSOC); 
    $travellers1=$stmt1->fetchAll();
    
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Booking Details</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Booking</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card card-outline-primary">
                    <div class="card-body">
                        <form action="user_operations/booking.php" method="post">
                            <div class="form-body">
                                <h3 class="card-title m-t-15">Booking Info</h3>
                                <hr>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <select name="state_id" class="form-control custom-select"
                                            data-toggle="dropdown" required>
                                            <option value=""> Select State</option>
                                            <option value="Diani Beach">Diani Beach</option>
                                            <option value="Likoni Ferry">Likoni Ferry</option>
                                            <option value="Serena/Sarova">Serena/Sarova</option>
                                            <option value="Pirates">Pirates</option>
                                            <option value="Mtwapa">Mtwapa</option>
                                            <option value="Kilifi Bridge">Kilifi Bridge</option>
                                            <option value="Kilifi Bofa">Kilifi Bofa</option>
                                            <option value="Malindi">Malindi</option>
                                            <option value="Lamu">Lamu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                    </div>


                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Package Name </label>
                                <select name="package_id" id="package_id" onchange="calculate();"
                                    class="form-control custom-select" required>
                                    <option value=""> Select Packages</option>
                                    <?php
                                                   foreach ($packages as $value) { ?>
                                    <option
                                        value="<?php echo $value['id'].','.$value['price_adult'].','.$value['price_children']?>">
                                        <?php echo $value['pname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">No Of Adults</label>
                                <input type="number" min="0" onchange="calculate();" onkeyup="calculate();"
                                    class="form-control" id="no_of_adults" name="no_of_adults"
                                    placeholder="Enter no of adults.." required>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">No Of Children</label>
                                <input type="number" min="0" onchange="calculate();" onkeyup="calculate();"
                                    class="form-control" id="no_of_children" name="no_of_children"
                                    placeholder="Enter No of Children.." required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">From Date</label>
                                <input type="date" onchange="calculate();" onkeyup="calculate();" class="form-control"
                                    id="from_date" name="from_date" placeholder="From Date" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">To Date</label>
                                <input type="date" onchange="calculate();" onkeyup="calculate();" class="form-control"
                                    id="to_date" name="to_date" placeholder="To Date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Sub Total</label>
                                <input type="text" class="form-control" id="total_amount" name="total_amount"
                                    placeholder=" SubTotal Amount.." required readonly>
                            </div>
                        </div>

                    </div>


                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Tax</label>
                                <input type="text" class="form-control" id="taxprice1" name="tax" onkeyup="sum2()"
                                    placeholder="Enter Tax.." required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Total</label>
                                <input type="text" class="form-control" id="ttt2" name="total"
                                    placeholder="Total Amount.." required readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Advance Amount</label>
                                <input type="number" class="form-control" id="advance_amount" min="0"
                                    max="<?php echo $total; ?>" name="adv_amount" placeholder="Enter Advance Amount.."
                                    required>
                            </div>
                        </div>

                    </div>





                </div>
                <div class="form-actions">

                    <button type="submit" class="btn btn-success" name="submit" id="btnValidate"> <i
                            class="fa fa-check"></i> Save</button>
                    <a href="add_booking.php"><button type="button" class="btn btn-inverse">Cancel</button></a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>


<?php include"footer.php"?>

<div class="popup popup--icon -error js_error-popup" id="show_error">
    <div class="popup__background"></div>
    <div class="popup__content">
        <h3 class="popup__content__title">
            Error
            </h1>
            <p>Please Enter Valid Date.</p>
            <p>

                <button class="button button--error" data-for="js_error-popup">Close</button>

            </p>
    </div>
</div>


<script>
function calculate() {

    var package = $('#package_id').val();
    var details = package.split(",");
    var p_id = details[0];
    var price_adult = details[1];
    var price_children = details[2];
    if ($("#from_date").val() != "" && $("#to_date").val() != "") {

        var From_date = new Date($("#from_date").val());
        var To_date = new Date($("#to_date").val());
        var diff_date = To_date - From_date;
        var years = Math.floor(diff_date / 31536000000);
        var months = Math.floor((diff_date % 31536000000) / 2628000000);
        var days = Math.floor(((diff_date % 31536000000) % 2628000000) / 86400000);
    } else {
        var days = 0;
    }

    if ($('#no_of_children').val() != '') {
        var no_of_children = $('#no_of_children').val();
    } else {
        var no_of_children = 0;
    }
    if ($('#no_of_adults').val() != '') {
        var no_of_adults = $('#no_of_adults').val();
    } else {
        var no_of_adults = 0;
    }
    var total = (parseInt(price_adult) * parseInt(no_of_adults)) + (parseInt(price_children) * parseInt(
    no_of_children));
    var total_amount = total * days;
    $('#total_amount').val(total_amount);
    $('#advance_amount').attr('max', total_amount);

    if (total_amount < 0) {
        $('#show_error').addClass('popup--visible');
    }

}

function sum2() {
    var total1 = parseInt(document.getElementById('total_amount').value);
    var tx = parseInt(document.getElementById('taxprice1').value);
    var total2 = (parseInt(total1) * (parseFloat(tx) / 100)) + parseInt(total1);
    document.getElementById('ttt2').value = total2;
    $('#advance_amount').attr('max', total2);
}


$(function() {
    $("#btnValidate").click(function() {


        if (fromdate > todate) {

            $('#show_error').addClass('popup--visible');
        }
    });
});



var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function() {
        var popupEl = document.querySelector('.' + el.dataset.for);
        popupEl.classList.toggle('popup--visible');
    });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
</script>