<?php
include('includes/config.php');
$ccode = $_GET['ccode'];
$q = "select sub_category_name from tblsubcategory where category_code='" . $ccode . "'";
$r = mysqli_query($con, $q);
?>

<div class="col-md-6 mb-10">
    <label for="validationCustom03">Sub Category</label>
    <select class="form-control custom-select" name="subcategory" required>
        <option value="0">Select Sub category</option>
        <?php
        while ($row = mysqli_fetch_array($r)) { ?>
            <option value="<?php echo $row['sub_category_name']; ?>"><?php echo $row['sub_category_name']; ?></option>
        <?php } ?>
    </select>
    <div class="invalid-feedback">Please select a category.</div>
</div>
