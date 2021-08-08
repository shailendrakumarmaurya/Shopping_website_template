<?php

include 'header.php';

$category = $sub_category_name = $images = $success = $id = "";
$category_err = $sub_category_name_err = $img_err = $error = "";

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['sub_category_id']) && !empty($_GET['sub_category_id'])) {

    $id = $_GET['sub_category_id'];
    $sql = "SELECT * FROM category c INNER JOIN sub_category s ON c.category_id = s.category_id WHERE sub_category_id = $id";

    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result);
    $category = $row1['category_id'];
    $sub_category_name = $row1['sub_category_name'];
    $images = $row1['sub_category_image'];

    $title = "Update Sub-Category";
} else {
    $title = "Add New Sub-Category";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (isset($_POST['category'])) {
            if ($_POST['category'] == 'NULL') {
                $category_err = "Please select Category.";
            } else {
                $category = $_POST['category'];
            }
        }
        if (empty(trim($_POST['sub_category_name']))) {
            $sub_category_name_err = "Enter Sub-Category Name.";
        } else {
            $sub_category_name = input_data($_POST['sub_category_name']);
        }

        $img = $_FILES['image'];
        $img_name = $_FILES['image']['name'];
        $img_tmp_name = $_FILES['image']['tmp_name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];
        $file_ext = explode('.', $img_name);
        $file_act_ext = strtolower(end($file_ext));
        $extension = array('jpg', 'jpeg', 'png');

        if (empty($_GET['sub_category_id'])) {
            $images = 'images/sub_img/';
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

        if (empty($category_err) && empty($sub_category_name_err) && empty($img_err)) {
            $target_dir = "images/sub_img/";
            $target_file = $target_dir . basename($img_name);
            move_uploaded_file($img_tmp_name, $target_file);
            if (isset($_POST['sub_category_id']) && !empty($_POST['sub_category_id'])) {
                $id = $_POST['sub_category_id'];
                if (!empty($img_name)) {
                    $Isql = ", sub_category_image = '$target_file'";
                } else {
                    $Isql = "";
                }
                $sql = "UPDATE sub_category SET category_id = '$category', sub_category_name = '$sub_category_name'" . $Isql . " WHERE sub_category_id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Sub-Category Updated Successfully.";
                } else {
                    $error = "Error occurred.";
                }
            } else {
                $sql = "INSERT INTO sub_category (category_id, sub_category_name, sub_category_image) VALUES ('$category', '$sub_category_name', '$target_file')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Sub-Category Added Successfully.";
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
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Category</label>
                            <input type="hidden" name="sub_category_id" value="<?php echo $id; ?>">
                            <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="category">
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
                            <label for="exampleInputName1">Sub-Category Name</label>
                            <input type="text" name="sub_category_name" value="<?php echo $sub_category_name; ?>" class="form-control" id="exampleInputName1" placeholder="Sub-Category Name">
                            <span class="error"><?php echo $sub_category_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group col-xs-12">
                                <?php if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['sub_category_id'])) { ?>
                                    <img src="<?php echo $images; ?>" alt="image" />
                                <?php } ?>
                                <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image">
                            </div>
                            <span class="error"><?php echo $img_err; ?></span>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include 'footer.php';

?>