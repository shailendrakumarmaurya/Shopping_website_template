<?php

include 'header.php';

$category_name = $images = $success = $id = "";
$category_name_err = $img_error = $error = "";

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {

    $id = $_GET['category_id'];
    $sql = "SELECT * FROM category WHERE category_id = $id";

    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result);
    $category_name = $row1['category_name'];
    $images = $row1['category_image'];

    $title = "Update Category";
} else {
    $title = "Add New Category";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (empty(trim($_POST['category_name']))) {
            $category_name_err = "Enter Category Name.";
        } else {
            $category_name = input_data($_POST['category_name']);
        }

        $img = $_FILES['image'];
        $img_name = $_FILES['image']['name'];
        $img_tmp_name = $_FILES['image']['tmp_name'];
        $img_size = $_FILES['image']['size'];
        $img_type = $_FILES['image']['type'];
        $file_ext = explode('.', $img_name);
        $file_act_ext = strtolower(end($file_ext));
        $extension = array('jpg', 'jpeg', 'png');

        if (empty($_GET['category_id'])) {
            $images = 'images/img/';
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
        if (empty($category_name_err) && empty($img_err)) {
            $target_dir = "images/img/";
            $target_file = $target_dir . basename($img_name);
            move_uploaded_file($img_tmp_name, $target_file);
            if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
                $id = $_POST['category_id'];
                if (!empty($img_name)) {
                    $Isql = ", category_image = '$target_file'";
                } else {
                    $Isql = "";
                }
                $sql = "UPDATE category SET category_name = '$category_name'" . $Isql . " WHERE category_id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Category Updated Successfully.";
                } else {
                    $error = "Error occurred.";
                }
            } else {
                $sql = "INSERT INTO category (category_name, category_image) VALUES ('$category_name', '$target_file')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Category Added Successfully.";
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
                            <label for="exampleInputName1">Category Name</label>
                            <input type="hidden" name="category_id" value="<?php echo $id; ?>">
                            <input type="text" name="category_name" value="<?php echo $category_name; ?>" class="form-control" id="exampleInputName1" placeholder="Category Name">
                            <span class="error"><?php echo $category_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group col-xs-12">
                                <?php if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['category_id'])) { ?>
                                    <img src="<?php echo $images; ?>" alt="image" />
                                <?php } ?>
                                <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image">
                            </div>
                            <span class="error"><?php echo $img_error; ?></span>
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