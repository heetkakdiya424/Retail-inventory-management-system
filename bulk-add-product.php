<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else {
    // Add product Code
    if (isset($_POST['submit'])) {
        //Getting Post Values
        $userID = $_SESSION['aid'];
        $catname = $_POST['category'];
        $subcatname = $_POST['subcategory'];
        $company = $_POST['company'];
        $pname = $_POST['productname'];
        $pprice = $_POST['productprice'];
        $expirydate = $_POST['expirydate'];
        $stock = $_POST['stock'];

        if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
            // Your code here        
            $query = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryNameCompanyName,ProductName,ProductPrice,ExpiryDate,Stock) values('$userID','$catname','$subcatname','$company','$pname','$pprice','$expirydate','$stock')");
            if ($query) {
                echo "<script>alert('Product added successfully.');</script>";
                echo "<script>window.location.href='add-product.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
                echo "<script>window.location.href='add-product.php'</script>";
            }
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
            echo "<script>window.location.href='add-product.php'</script>";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Add Product</title>
        <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
        <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
        <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>


        <!-- HK Wrapper -->
        <div class="hk-wrapper hk-vertical-nav">

            <!-- Top Navbar -->
            <?php include_once('includes/navbar.php');
            include_once('includes/sidebar.php');
            ?>



            <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
            <!-- /Vertical Nav -->



            <!-- Main Content -->
            <div class="hk-pg-wrapper">
                <!-- Breadcrumb -->
                <nav class="hk-breadcrumb" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light bg-transparent">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bulk-Add</li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <!-- Container -->
                <div class="container">
                    <!-- Title -->
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="external-link"></i></span></span>Bulk-Add Product</h4>
                    </div>
                    <!-- /Title -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">

                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" method="post" action="bulk-import-product.php" enctype="multipart/form-data" novalidate>

                                            <div class="form-row">
                                                <div class="col-md-6 mb-10">
                                                    <p> Sample Data File (Excel File)</p>
                                                    <a href="ExtraResources/sample-data-product.xlsx">Download</a>
                                                    <br />
                                                    <br />
                                                    <label for="validationCustom03">Select File</label>
                                                    <label for="images" class="drop-container" id="dropcontainer" style="position: relative;
                                                            display: flex;
                                                            gap: 10px;
                                                            flex-direction: column;
                                                            justify-content: center;
                                                            align-items: center;
                                                            height: 200px;
                                                            padding: 20px;
                                                            border-radius: 10px;
                                                            border: 2px dashed #555;
                                                            color: #444;
                                                            cursor: pointer;
                                                            transition: background .2s ease-in-out, border .2s ease-in-out;
                                                        ">
                                                        <span class="drop-title" style=" color: #444;
                                                        font-size: 20px;
                                                        font-weight: bold;
                                                        text-align: center;
                                                        transition: color .2s ease-in-out;
                                                            ">Drop files here</span>
                                                        <p style="color: #838383;">or</p>
                                                        <span class="drop-title" style=" color: #444;
                                                        font-size: 20px;
                                                        font-weight: bold;
                                                        text-align: center;
                                                        transition: color .2s ease-in-out;
                                                            ">Click here</span>
                                                        <span class="drop-title" style=" color: #444;
                                                        font-size: 20px;
                                                        font-weight: bold;
                                                        text-align: center;
                                                        transition: color .2s ease-in-out;
                                                            "></span>
                                                        <input type="file" name="import_file" id="images" accept=".xlsx" style="margin-left: 100px; display: none;" required>
                                                    </label>
                                                    <div class="invalid-feedback">Please provide a valid product name.</div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>


                <!-- Footer -->
                <?php include_once('includes/footer.php'); ?>
                <!-- /Footer -->

            </div>
            <!-- /Main Content -->

        </div>

        <script>
            function validateInput(input) {
                if (input.value < 0) {
                    input.setCustomValidity('Please enter a positive number.');
                } else {
                    input.setCustomValidity('');
                }
            }
        </script>

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
        <script src="dist/js/jquery.slimscroll.js"></script>
        <script src="dist/js/dropdown-bootstrap-extended.js"></script>
        <script src="dist/js/feather.min.js"></script>
        <script src="vendors/jquery-toggles/toggles.min.js"></script>
        <script src="dist/js/toggle-data.js"></script>
        <script src="dist/js/init.js"></script>
        <script src="dist/js/validation-data.js"></script>

    </body>

    </html>
<?php } ?>