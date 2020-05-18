<?php 

  if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
  } else {

 ?>

<?php //fetches the category based on id passed from the url{GET}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $edit_category = $_GET['edit_category'];

    $sql = "SELECT * FROM categories WHERE cat_id={$edit_category}";
    $exec = mysqli_query($conn, $sql);
    confirm($exec);
    while ($rows = mysqli_fetch_array($exec)) {
        $cat_name = $rows['cat_name'];
        $cat_description = $rows['cat_desc'];
        $cat_quantity = $rows['cat_quantity'];
        $cat_price = $rows['cat_price'];
        $cat_fee      = $rows['cat_booking_fee'];
        $cat_image = $rows['cat_image'];
        $cat_pov_image = $rows['cat_pov_image'];
    }
}
?>


<div class="row">
    <div class="col-lg-12 content-header">
        <h1>Categories</h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard </a></li>
            <li class="active">Categories</li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> Edit Category
                </h3>
            </div>

            <div class="panel-body">
                <form action="" method="post"
          autocomplete="off" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
            <label for="cat_name" class="col-md-3 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cat_name" id="cat_name"
                   value="<?php echo isset($cat_name) ? $cat_name : ''; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="cat_desc" class="col-md-3 control-label">Description</label>
           <div class="col-md-6">
                <input type="text" class="form-control" name="cat_desc" id="cat_desc"
                   value="<?php echo isset($cat_description) ? $cat_description : ''; ?>" required>
           </div>
        </div>
        <div class="form-group">
            <label for="cat_quantity" class="col-md-3 control-label">Quantity</label>
            <div class="col-md-6">
                <input type="number" class="form-control" name="cat_quantity" id="cat_quantity"
                   value="<?php echo isset($cat_quantity) ? $cat_quantity : ''; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="cat_price" class="col-md-3 control-label">Price</label>
            <div class="col-md-6">
                <div class="input-group">
                <input type="number" class="form-control" name="cat_price" id="cat_price"
                       value="<?php echo isset($cat_price) ? $cat_price : ''; ?>" required>
                <span class="input-group-addon ">ksh.</span>
            </div>
            </div>
            
        </div>
        <div class="form-group">
            <label for="cat_price" class="col-md-3 control-label">Fee</label>
            <div class="col-md-6">
                <div class="input-group">
                <input type="number" class="form-control" name="cat_fee" id="cat_fee"
                       value="<?php echo isset($cat_fee) ? $cat_fee : ''; ?>" required>
                <span class="input-group-addon ">ksh.</span>
            </div>
            </div>
            
        </div>
        <div class="form-group">
            <label for="cat_image" class="col-md-3 control-label">Image</label>
            <div class="col-md-6">
                <img src="../images/<?php echo $cat_image; ?>" width='150px' height='80px' alt=""
                 class="img-rounded"><br>
            <input type="hidden" id="_cat_image" class="form-control" name="_cat_image"
                   value="<?php echo $cat_image; ?>">
            <input type="file" id="cat_image" class="form-control" name="cat_image">
            </div>
        </div>

        <div class="form-group">
            <label for="cat_pov_image" class="col-md-3 control-label">POV Image</label>
            <div class="col-md-6">
                <img src="../images/<?php echo $cat_pov_image; ?>" width='150px' height='80px'
                 alt="" class="img-rounded"><br>
                <input type="hidden" id="_cat_pov_image" class="form-control" name="_cat_pov_image"
                       value="<?php echo $cat_pov_image; ?>">
                <input type="file" id="cat_pov_image" class="form-control" name="cat_pov_image">
            </div>
            
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-6">
                <input type="submit" value="Update" class="btn btn-primary form-control" name="submit">
            </div>
        </div>


        </form>

            </div>
        </div>
    </div>
</div>






<?php //updates the category
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edit_category = $_GET['edit_category'];
    $cat_name = $_POST['cat_name'];
    $cat_description = $_POST['cat_desc'];
    $cat_quantity = $_POST['cat_quantity'];
    $cat_price = $_POST['cat_price'];

    //    stores cat img
    $cat_image = $_FILES['cat_image']['name'];
    $cat_image_temp = $_FILES['cat_image']['tmp_name'];
    move_uploaded_file($cat_image_temp, "../images/$cat_image");

    //    stores cat pov img
    $cat_pov_image = $_FILES['cat_pov_image']['name'];
    $cat_pov_image_temp = $_FILES['cat_pov_image']['tmp_name'];
    move_uploaded_file($cat_pov_image_temp, "../images/$cat_pov_image");

    $cat_name = escape($cat_name);
    $cat_description = escape($cat_description);
    $cat_quantity = escape($cat_quantity);
    $cat_price = escape($cat_price);
    $cat_image = escape($cat_image);
    $cat_pov_image = escape($cat_pov_image);

    if (empty($cat_image)) $cat_image = $_POST['_cat_image'];
    if (empty($cat_pov_image)) $cat_pov_image = $_POST['_cat_pov_image'];

    $sql = "UPDATE categories SET cat_name='{$cat_name}', cat_desc='{$cat_description}', cat_quantity={$cat_quantity}, 
    cat_price={$cat_price}, cat_image='{$cat_image}', cat_pov_image='{$cat_pov_image}' WHERE cat_id={$edit_category} ";
    $exec = mysqli_query($conn, $sql);
    confirm($exec);

    if ($exec) {
        echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Category updated successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'index.php?view_categories'
                           }
                        });

                </script>";
    }

}
?>

<?php } ?>






        




