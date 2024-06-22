<?php
session_start();
include ('includes/config.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST["submit"])) {

    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $flag = 0;
        $addCount = count($data);

        foreach ($data as $row) {

            if ($flag == 0) {
                if ($row[0] == 'CategoryCode' & $row[1] == 'CategoryName' & $row[2] == 'SubCategoryCode' & $row[3] == 'SubCategoryName' & $row[4] == 'CompanyName' & $row[5] == 'ProductName' & $row[6] == 'ProductPrice' & $row[7] == 'ExpiryDateCheck' & $row[8] == 'ExpiryDate' & $row[9] == 'Stock' & $row[10] == 'ImagePath') {
                } else {
                    echo "<script>alert('Some filled are missing! please check an excel file.');</script>";
                    echo "<script>window.location.href='bulk-add-product.php'</script>";
                    break;
                }
            }

            if ($flag != 0) {
                $userID = $_SESSION['aid'];
                $catcode = $row[0];
                $catname = $row[1];
                $subcatcode = $row[2];
                $subcatname = $row[3];
                $companyname = $row[4];
                $pname = $row[5];
                $pprice = $row[6];
                $expirycheck = $row[7];
                $expirydate = $row[8];
                $stock = $row[9];
                $imagepath = $row[10];

                // product not
                $qp = mysqli_query($con, "SELECT * FROM tblproducts WHERE ProductName='$pname' AND userID = '$userID'");
                if (mysqli_num_rows($qp) == 0) {

                    // CategoryName
                    $qc = mysqli_query($con, "SELECT * FROM tblcategory WHERE CategoryName='$catname' AND userID = '$userID'");
                    if (mysqli_num_rows($qc) != 0) {

                        // SubCategoryName
                        $qsc = mysqli_query($con, "SELECT * FROM tblsubcategory WHERE sub_category_name='$subcatname' AND userID = '$userID'");
                        if (mysqli_num_rows($qsc) != 0) {

                            // CompanyName
                            $qcn = mysqli_query($con, "SELECT * FROM tblcompany WHERE CompanyName='$companyname' AND userID = '$userID'");
                            if (mysqli_num_rows($qcn) != 0) {

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            } else {
                                // insert company name
                                $qicon = mysqli_query($con, "insert into tblcompany(userID,CompanyName) values('$userID','$companyname')");

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            }
                        } else {
                            // insert sub category name
                            $qisc = mysqli_query($con, "insert into tblsubcategory(userID,category_code,sub_category_code,sub_category_name) values('$userID','$catcode','$subcatcode','$subcatname')");
                            // CompanyName
                            $qcn = mysqli_query($con, "SELECT * FROM tblcompany WHERE CompanyName='$companyname' AND userID = '$userID'");
                            if (mysqli_num_rows($qcn) != 0) {

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            } else {
                                // insert company name
                                $qicon = mysqli_query($con, "insert into tblcompany(userID,CompanyName) values('$userID','$companyname')");

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            }
                        }
                    } else {
                        //insert category
                        $qic = mysqli_query($con, "insert into tblcategory(userID,CategoryName,CategoryCode) values('$userID','$catname','$catcode')");

                        // SubCategoryName
                        $qsc = mysqli_query($con, "SELECT * FROM tblsubcategory WHERE sub_category_name='$subcatname' AND userID = '$userID'");
                        if (mysqli_num_rows($qsc) != 0) {

                            // CompanyName
                            $qcn = mysqli_query($con, "SELECT * FROM tblcompany WHERE CompanyName='$companyname' AND userID = '$userID'");
                            if (mysqli_num_rows($qcn) != 0) {

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            } else {
                                // insert company name
                                $qicon = mysqli_query($con, "insert into tblcompany(userID,CompanyName) values('$userID','$companyname')");

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            }
                        } else {
                            // insert sub category name
                            $qisc = mysqli_query($con, "insert into tblsubcategory(userID,category_code,sub_category_code,sub_category_name) values('$userID','$catcode','$subcatcode','$subcatname')");
                            // CompanyName
                            $qcn = mysqli_query($con, "SELECT * FROM tblcompany WHERE CompanyName='$companyname' AND userID = '$userID'");
                            if (mysqli_num_rows($qcn) != 0) {

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            } else {
                                // insert company name
                                $qicon = mysqli_query($con, "insert into tblcompany(userID,CompanyName) values('$userID','$companyname')");

                                if (intval($expirycheck) == 1) {
                                    if (strtotime($expirydate) > strtotime(date("d-m-Y"))) {
                                        $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPrice,ExpiryDate,Stock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$expirydate','$stock','$imagepath')");
                                    }
                                } else {
                                    $padd = mysqli_query($con, "insert into tblproducts(userID,CategoryName,SubCategoryName,CompanyName,ProductName,ProductPriceStock,ImagePath) values('$userID','$catname','$subcatname','$companyname','$pname','$pprice','$stock','$imagepath')");
                                }
                            }
                        }
                    }
                }
            }
            $addCount--;
            $flag++;
        }
        echo "<script>alert('Product list successfully added');</script>";
        echo "<script>window.location.href='bulk-add-product.php'</script>";
    } else {
        echo "<script>alert('Please select proper file, Only xlsx file will be accepted.');</script>";
        echo "<script>window.location.href='bulk-add-product.php'</script>";
    }
}
