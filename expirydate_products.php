<?php
session_start();
//error_reporting(0);
include('includes/config.php');


if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Expiry Date Products</title>
        <!-- Data Table CSS -->
        <link href="vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item active" aria-current="page">Manage</li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <!-- Container -->
                <div class="container">

                    <!-- Title -->
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="database"></i></span></span>Expiry Date Products</h4>
                    </div>
                    <!-- /Title -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="table-wrap">
                                            <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Category</th>
                                                        <th>Company</th>
                                                        <th>Product</th>
                                                        <th>Pricing</th>
                                                        <th>Expiry Date</th>
                                                        <th>Stock</th>
                                                        <th>Posting Date</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $userID = $_SESSION['aid'];
                                                    $rno = mt_rand(10000, 99999);
                                                    $noproduct = 0;

                                                    // Fetch the expiration dates from the database
                                                    $exdate = mysqli_query($con, "SELECT * FROM tblproducts where userID='$userID'");

                                                    if ($exdate) {
                                                        // Create a DateTime object for the current date
                                                        $currentDate = new DateTime();
                                                        $cnt = 1;
                                                        while ($row = mysqli_fetch_array($exdate)) {
                                                            // Convert the fetched date to a DateTime object
                                                            $targetDate = new DateTime($row['ExpiryDate']);

                                                            // Calculate the difference in days between targetDate and currentDate
                                                            $interval = $currentDate->diff($targetDate);
                                                            $daysDifference = $interval->days;

                                                            // Check if the difference is less than or equal to 7
                                                            if(empty($row['ExpiryDate'])){

                                                            }else{
                                                            if ($daysDifference <= 7) {
                                                                $noproduct++;

                                                    ?>
                                                                <tr>
                                                                    <td><?php echo $cnt; ?></td>
                                                                    <td><?php echo $row['CategoryName']; ?></td>
                                                                    <td><?php echo $row['CompanyName']; ?></td>
                                                                    <td><?php echo $row['ProductName']; ?></td>
                                                                    <td><?php echo $row['ProductPrice']; ?></td>
                                                                    <td><?php echo $row['ExpiryDate']; ?></td>
                                                                    <td><?php echo $row['Stock']; ?></td>
                                                                    <td><?php echo $row['PostingDate']; ?></td>
                                                                    <td>
                                                                        <a href="edit-product.php?pid=<?php echo base64_encode($row['id'] . $rno); ?>" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i></a>
                                                                        <a href="manage-products.php?del=<?php echo base64_encode($row['id'] . $rno); ?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="icon-trash txt-danger"></i> </a>
                                                                    </td>
                                                                </tr>
                                                    <?php
                                                                $cnt++;
                                                            }
                                                        }
                                                        }
                                                    } else { // Handle the case when the query fails
                                                        echo "Error: " . mysqli_error($con);
                                                    } // Output the number of products that expire within 7 days 
                                                    ?>
                                                    </form>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                    <!-- /Row -->

                </div>
                <!-- /Container -->

                <!-- Footer -->
                <?php include_once('includes/footer.php'); ?>
                <!-- /Footer -->
            </div>
            <!-- /Main Content -->
        </div>
        <!-- /HK Wrapper -->

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="dist/js/jquery.slimscroll.js"></script>
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="dist/js/dataTables-data.js"></script>
        <script src="dist/js/feather.min.js"></script>
        <script src="dist/js/dropdown-bootstrap-extended.js"></script>
        <script src="vendors/jquery-toggles/toggles.min.js"></script>
        <script src="dist/js/toggle-data.js"></script>
        <script src="dist/js/init.js"></script>
    </body>

    </html>
<?php } ?>