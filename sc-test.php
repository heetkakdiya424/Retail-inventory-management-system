<?php
session_start();
include('includes/config.php');
$userID = $_SESSION['aid'];

if (isset($_POST['selectedValue'])) {
    $selectedValue = $_GET['selectedValue'];
    list($firstValue, $categoryName) = explode(',', $selectedValue);
}
?>
<div class="col-md-6 mb-10">
    <label for="validationCustom03">Sub Category</label>
    <?php echo $firstValue." hello"; ?>
    <select class="form-control custom-select" name="subcategory" required>
        <option value="0">Select Sub category</option>
        <?php
        if (isset($firstValue)) {
            $ret = mysqli_query($con, "select * from tblsubcategory where userID='$userID' AND category_code='$firstValue'");
            while ($row = mysqli_fetch_array($ret)) { ?>
                <option value="<?php echo $row['sub_category_name']; ?>"><?php echo $row['sub_category_name']; ?></option>
        <?php }
        } ?>
    </select>
    <div class="invalid-feedback">Please select a category.</div>
</div>