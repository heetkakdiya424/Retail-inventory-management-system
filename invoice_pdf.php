<?php
session_start();

require('C:\xampp\htdocs\zzABCzz\vendor\tecnickcom\tcpdf\tcpdf.php');
require('includes/config.php'); // Include your database configuration

$invoice_date = ''; // Initialize with an empty string
$invoice_number = 0;
$cus_name = '';
$cus_mobile = 0;
$payment_mode = '';
$total_amount = 0;

// Consumer Details
$inid = substr(base64_decode($_GET['invid']), 0, -5);
$query = mysqli_query($con, "SELECT * FROM tblorders WHERE InvoiceNumber = '$inid'");
$cnt = 1;
$row = mysqli_fetch_assoc($query);

// Assign values from the query result
$invoice_date = $row['InvoiceGenDate'];
$invoice_number = $row['InvoiceNumber'];
$cus_name = $row['CustomerName'];
$cus_mobile = $row['CustomerContactNo'];
$payment_mode = $row['PaymentMode'];

$query1 = mysqli_query($con, "select tblproducts.CategoryName,tblproducts.ProductName,tblproducts.CompanyName,tblproducts.ProductPrice,tblorders.Quantity  from tblorders join tblproducts on tblproducts.id=tblorders.ProductId where tblorders.InvoiceNumber='$inid'");

// Create a new TCPDF instance
$pdf = new TCPDF();
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();

// Set the font and size for the invoice
$pdf->SetFont('helvetica', '', 12);

// Define your invoice data

$invoiceContent = "
<!DOCTYPE html>
<html lang=\"en\">

<body>
    <!-- Main Content -->
    <div class=\"hk-pg-wrapper\">
        <!-- Container -->
        <div>
            <!-- Row -->
                <section>
                <div>
                    <table>
                        <tr>    
                            <td>
                                <div style=\"margin-bottom: 20px; text-align: left;\">
                                    <h3 style=\"font-weight: 600; font-size: 24px;\">EasyTex</h3>
                                    <h6 style=\"font-size: 14px;\">Retail Shop Management System</h6>
                                </div>
                            </td>
                            <td>
                                <div style=\"text-align: right;\">
                                    <h4 style=\"font-weight: 600; font-size: 20px;\">Invoice / Receipt</h4>
                                    <div>
                                        <span style=\"display: block; font-size: 14px;\">Date:<span style=\"margin-left: 10px; color: #333;\">$invoice_date</span></span>
                                        <br />
                                        <span style=\"display: block; font-size: 14px;\">Invoice / Receipt #<span style=\"margin-left: 10px; color: #333;\">$invoice_number</span></span>
                                        <br />
                                        <span style=\"display: block; font-size: 14px;\">Customer #<span style=\"margin-left: 10px; color: #333;\">$cus_name</span></span>
                                        <br />
                                        <span style=\"display: block; font-size: 14px;\">Customer Mobile No #<span style=\"margin-left: 10px; color: #333;\">$cus_mobile</span></span>
                                        <span style=\"display: block; font-size: 14px;\">Payment Mode #<span style=\"margin-left: 10px; color: #333;\">$payment_mode</span></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    </div>

                    <hr style=\"margin-top: 0;\">
                <div>
                    <div>
                        <table style=\"width: 100%; border-collapse: collapse; border: 1px solid #333;\">
                            <thead>
                                <tr>
                                    <th style=\"border: 1px solid #333; padding: 5px; text-align: center;\">#</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Product Name</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Category</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Company</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Quantity</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Unit Price</th>
                                    <th style=\"border: 1px solid #333; padding: 5px;\">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Add your invoice items here -->

";

// Product Details
$cnt = 1;
$grandtotal = 0;
$totalqty = 0;
while ($row = mysqli_fetch_array($query1)) {
    $product_name = $row['ProductName'];
    $category_name = $row['CategoryName'];
    $company_name = $row['CompanyName'];
    $quantity = $row['Quantity'];
    $unit_price = $row['ProductPrice'];
    $subtotal = number_format($unit_price * $quantity, 2);
    $grandtotal += $unit_price * $quantity;
    $totalqty += $quantity;
    $invoiceContent .= "
    <tr>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$cnt</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$product_name</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$category_name</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$company_name</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$quantity</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$unit_price</td>
        <td style=\"border: 1px solid #333; padding: 5px; text-align: center;\">$subtotal</td>
    </tr>
    ";

    $cnt++;
}

$invoiceContent .= "
                                <tr>
                                <td></td>
                                </tr>
                                <tr>
                                    <td style=\"padding: 5px; text-align: center;\"></td>
                                    <td style=\"padding: 5px; text-align: center;\"></td>
                                    <td style=\"padding: 5px; text-align: center;\"></td>
                                    <td style=\"padding: 5px; text-align: center;\">Total</td>
                                    <td style=\"padding: 5px; text-align: center;\"></td>
                                    <td style=\"padding: 5px; text-align: center;\">$totalqty</td>
                                    <td style=\"padding: 5px; text-align: center;\">$grandtotal</td>
                                </tr>
                                <tr>
                                <td></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
                </section>
            <!-- /Row -->
        </div>
    </div>
</body>

</html>
";

// Now $invoiceContent contains the HTML content with the dynamic invoice data.


// Convert the HTML and CSS content to PDF
$pdf->writeHTML($invoiceContent, true, false, true, false);

// Output the PDF as a download
$pdf->Output('invoice.pdf', 'i');
