<?php

include 'header.php';

$category = $sub_category = $product_name = $description = $sku = $images = $price = $status = $success = $id = "";
$category_err = $sub_category_err = $product_name_err = $price_err = $sku_err = $status_err = $img_err = $error = "";

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

    $id = $_GET['product_id'];
    $sql = "SELECT c.category_id, c.category_name, c.category_image, s.sub_category_id, s.sub_category_name, s.sub_category_image, p.product_id, p.product_name, p.description, p.sku, p.img, p.price, p.status FROM category c INNER JOIN sub_category s ON c.category_id = s.category_id INNER JOIN products p ON s.sub_category_id = p.sub_category_id WHERE product_id = $id";

    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result);
    $category = $row1['category_id'];
    $cat_name = $row1['category_name'];
    $sub_category = $row1['sub_category_id'];
    $sub_cat_name = $row1['sub_category_name'];
    $product_name = $row1['product_name'];
    $description = $row1['description'];
    $sku = $row1['sku'];
    $images = $row1['img'];
    $price = $row1['price'];
    $status = $row1['status'];
    if ($row1['status'] == 1) {
        $statusText = "Active";
    } else {
        $statusText = "In-Active";
    }
    $title = "Update Product";
} else {
    $title = "Add New Product";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $description = input_data($_POST['description']);
        if (isset($_POST['category'])) {
            if ($_POST['category'] == 'NULL') {
                $category_err = "Please select Category.";
            } else {
                $category = $_POST['category'];
            }
        }
        if (isset($_POST['sub_category'])) {
            if ($_POST['sub_category'] == 'NULL') {
                $sub_category_err = "Please select Sub-Category.";
            } else {
                $sub_category = $_POST['sub_category'];
            }
        }
        if (empty(trim($_POST['product_name']))) {
            $product_name_err = "Enter Product Name.";
        } else {
            $product_name = input_data($_POST['product_name']);
        }

        if (empty(trim($_POST['sku']))) {
            $sku_err = "Enter Product SKU.";
        } else {
            $sku = input_data($_POST['sku']);
            if (!preg_match("/^[0-9]*$/", $sku)) {
                $sku_err = "SKU Should be numeric.";
            } else {
                if (!empty($_POST['product_id'])) {
                    $id = $_POST['product_id'];
                    $sku_check = "SELECT sku FROM products WHERE NOT product_id=$id";
                    $sku_query = mysqli_query($conn, $sku_check);
                    while ($rowsku = mysqli_fetch_assoc($sku_query)) {
                        if ($rowsku['sku'] == $sku) {
                            $sku_err = "SKU already available.";
                        }
                    }
                } else {
                    $sku_check = "SELECT sku FROM products WHERE 1 AND sku = '$sku'";
                    $sku_query = mysqli_query($conn, $sku_check);
                    $sku_query_result = mysqli_num_rows($sku_query);
                    if ($sku_query_result > 0) {
                        $sku_err = "SKU already available.";
                    }
                }
            }
        }

        if (isset($_POST['status'])) {

            if ($_POST['status'] == 'NULL') {
                $status_err = "Select Product Status.";
            } else {
                $status = input_data($_POST['status']);
            }
        }

        if (empty(trim($_POST['price']))) {
            $price_err = "Enter Product Price.";
        } else {
            $price = input_data($_POST['price']);
            if (!preg_match("/^[0-9]*$/", $price)) {
                $price_err = "Price Should be numeric.";
            }
        }


        $img = $_FILES['image'];
        $img_name = $_FILES['image']['name'];
        $img_tmp_name = $_FILES['image']['tmp_name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];
        $file_ext = explode('.', $img_name);
        $file_act_ext = strtolower(end($file_ext));
        $extension = array('jpg', 'jpeg', 'png');

        if (empty($_GET['product_id'])) {
            $images = 'images/products/';
            if (empty($img_name)) {
                $img_err = "Select Image.";
            } else if (!in_array($file_act_ext, $extension)) {
                $img_err = "Invalid file type.";
            } else if ($img_size > 10000000) {
                $img_err = "File is too large.";
            }
        } else {
            if (!empty($img_name) && !in_array($file_act_ext, $extension)) {
                $img_err = "Invalid file type.";
            } else if ($img_size > 10000000) {
                $img_err = "File is too large.";
            }
        }


        if (empty($category_err) && empty($sub_category_err) && empty($product_name_err) && empty($sku_err) && empty($status_err) && empty($price_err) && empty($img_err)) {
            $target_dir = "images/products/";
            $target_file = $target_dir . basename($img_name);
            move_uploaded_file($img_tmp_name, $target_file);
            if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
                $id = $_POST['product_id'];
                if (!empty($img_name)) {
                    $Isql = ", img = '$target_file'";
                } else {
                    $Isql = "";
                }
                $sql = "UPDATE products SET category_id = '$category', sub_category_id = '$sub_category', product_name = '$product_name', description = '$description', sku = '$sku'" . $Isql . ", price = '$price', status = '$status' WHERE product_id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Product Updated Successfully.";
                } else {
                    $error = "Error occurred.";
                }
            } else {
                $sql = "INSERT INTO products (category_id, sub_category_id, product_name, description, sku, img, price, status) VALUES ('$category', '$sub_category', '$product_name', '$description', '$sku', '$target_file', '$price', '$status')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Product Added Successfully.";
                } else {
                    $error = "Error occurred.";
                }
            }
        } else {
            $error = "Error";
        }
    }
}


?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $title; ?></h4>
                    <span class="success"><?php echo $success; ?></span>
                    <span class="error"><?php echo $error; ?></span>
                    <form class="forms-sample" method="post" enctype="multipart/form-data" id="form">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Category</label>
                            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            <select class=" form-control form-control-lg" name="category" id="category">
                                <option value="NULL">Select Category</option>
                                <?php
                                $query = "SELECT * FROM category ORDER BY category_name ASC";
                                $queryresult = mysqli_query($conn, $query);
                                while ($rows = mysqli_fetch_assoc($queryresult)) {
                                    $cat_id1 = $rows['category_id'];
                                ?>
                                    <option <?php if ($category == $cat_id1) { ?> selected='<?php echo 'selected'; ?>' <?php } ?> value='<?php echo $cat_id1; ?>'><?php echo $rows['category_name']; ?></option>
                                <?php }
                                ?>
                            </select>
                            <span class="error"><?php echo $category_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Sub-Category</label>
                            <select class="form-control form-control-lg" name="sub_category" id="sub_category">
                                <option value="NULL">Select Sub-Category</option>
                                <?php
                                $sub_query = "SELECT * FROM sub_category WHERE category_id = $category ORDER BY sub_category_name ASC";
                                $sub_queryresult = mysqli_query($conn, $sub_query);
                                while ($row2 = mysqli_fetch_assoc($sub_queryresult)) {
                                    $sub_cat_id1 = $row2['sub_category_id'];
                                ?>
                                    <option <?php if ($sub_category == $sub_cat_id1) { ?> selected='<?php echo 'selected'; ?>' <?php } ?> value='<?php echo $sub_cat_id1; ?>'><?php echo $row2['sub_category_name']; ?></option>
                                <?php }
                                ?>

                            </select>
                            <span class="error"><?php echo $sub_category_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Product Name</label>
                            <input type="text" name="product_name" value="<?php echo $product_name; ?>" class="form-control" id="exampleInputName1" placeholder="Product Name">
                            <span class="error"><?php echo $product_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Description</label>
                            <textarea class="form-control" id="exampleTextarea1" rows="3" placeholder="Description" name="description"><?php echo $description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">SKU</label>
                            <input type="text" name="sku" value="<?php echo $sku; ?>" class="form-control" id="sku" placeholder="SKU">
                            <span class="error"><?php echo $sku_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group col-xs-12">
                                <?php if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['product_id'])) { ?>
                                    <img src="<?php echo $images; ?>" alt="image" />
                                <?php } ?>
                                <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Images">
                            </div>
                            <span class="error"><?php echo $img_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Price</label>
                            <input type="text" name="price" value="<?php echo $price; ?>" class="form-control" id="exampleInputName1" placeholder="Price">
                            <span class="error"><?php echo $price_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control form-control-lg" name="status">
                                <option value="NULL">Select Status</option>
                                <option value="0" <?php if ($status == 0) { ?> selected='<?php echo 'selected'; ?>' <?php } ?>>In-Active</option>
                                <option value="1" <?php if ($status == 1) { ?> selected='<?php echo 'selected'; ?>' <?php } ?>>Active</option>
                            </select>
                            <span class="error"><?php echo $status_err; ?></span>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var category_id = $(this).val();
            $.ajax({
                url: "select_sub_category.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                success: function(result) {
                    $('#sub_category').html(result);
                }
            });
        });
    });
</script>
<?php

include 'footer.php';

?>