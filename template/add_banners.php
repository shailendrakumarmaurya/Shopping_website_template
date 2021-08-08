<?php

include 'header.php';

$position = $status = $images = $success = $id = "";
$position_err = $status_err = $img_err = $error = "";

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['banner_id']) && !empty($_GET['banner_id'])) {

    $id = $_GET['banner_id'];
    $sql = "SELECT * FROM banners WHERE banner_id = $id";

    $result = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($result);
    $position = $row1['position'];
    $status = $row1['status'];
    $images = $row1['banner_image'];
    if ($row1['status'] == 1) {
        $statusText = "Active";
    } else {
        $statusText = "In-Active";
    }

    $title = "Update Banner";
} else {
    $title = "Add New Banner";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (empty(trim($_POST['position']))) {
            $position_err = "Enter Position.";
        } else {
            $position = input_data($_POST['position']);
            if (!preg_match("/^[0-9]*$/", $position)) {
                $position_err = "Position Should be numeric.";
            }
        }

        if (isset($_POST['status'])) {
            if ($_POST['status'] == 'NULL') {
                $status_err = "Select Product Status.";
            } else {
                $status = input_data($_POST['status']);
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

        if (empty($_GET['banner_id'])) {
            $images = 'images/banners/';
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
            $target_dir = "images/banners/";
            $target_file = $target_dir . basename($img_name);
            move_uploaded_file($img_tmp_name, $target_file);
            if (isset($_POST['banner_id']) && !empty($_POST['banner_id'])) {
                $id = $_POST['banner_id'];
                if (!empty($img_name)) {
                    $Isql = ", banner_image = '$target_file'";
                } else {
                    $Isql = "";
                }
                $sql = "UPDATE banners SET position = '$position', status = '$status'" . $Isql . " WHERE banner_id = $id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Banner Updated Successfully.";
                } else {
                    $error = "Error occurred.";
                }
            } else {
                $sql = "INSERT INTO banners (position, status, banner_image) VALUES ('$position', '$status', '$target_file')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Banner Added Successfully.";
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
                            <label for="exampleFormControlSelect1">Status</label>
                            <input type="hidden" name="banner_id" value="<?php echo $id; ?>">
                            <select class="form-control form-control-lg" name="status">
                                <option value="NULL">Select Status</option>
                                <option value="0" <?php if ($status == 0) { ?> selected='<?php echo 'selected'; ?>' <?php } ?>>In-Active</option>
                                <option value="1" <?php if ($status == 1) { ?> selected='<?php echo 'selected'; ?>' <?php } ?>>Active</option>
                            </select>
                            <span class="error"><?php echo $status_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Position</label>
                            <input type="text" name="position" value="<?php echo $position; ?>" class="form-control" id="exampleInputName1" placeholder="Position">
                            <span class="error"><?php echo $position_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="input-group col-xs-12">
                                <?php if (($_SERVER['REQUEST_METHOD'] == 'GET') && !empty($_GET['banner_id'])) { ?>
                                    <img src="<?php echo $images; ?>" alt="image" />
                                <?php } ?>
                                <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Images" multiple>
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