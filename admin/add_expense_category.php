<?php
require_once('check_login.php');
?>
<?php include"header.php"?>

<?php include"sidebar.php"?>

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Expense Category Details</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Expense</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>


    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline-primary">

                    <div class="card-body">
                        <form action="operations/expense_category.php" method="post">
                            <div class="form-body">
                                <h3 class="card-title m-t-15">Expense Category Info</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Expense Name </label>
                                            <input type="text" class="form-control" name="expense_name"
                                                pattern="[a-zA-Z][a-zA-Z ]+" placeholder="Enter a Expense Name.."
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" required>Status</label><br>

                                            <input type="radio" name="status" value="Active" checked> Active
                                            &nbsp; &nbsp; &nbsp; <input type="radio" name="status"
                                                value="Deactive">Deactive<br>

                                        </div>
                                    </div>

                                </div>




                            </div>
                            <div class="form-actions">

                                <button type="submit" class="btn btn-success" name="submit"> <i class="fa fa-check"></i>
                                    Save</button>
                                <a href="add_expense_category.php"><button type="button"
                                        class="btn btn-inverse">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php include"footer.php"?>