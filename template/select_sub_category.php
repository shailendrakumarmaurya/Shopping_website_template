<?php

include_once 'pages/samples/_dbconnect.php';

$category_id = $_POST['category_id'];
$sql = "SELECT * FROM sub_category WHERE category_id = $category_id ORDER BY sub_category_name ASC";
$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);
?>

<option value="NULL">Select Sub-Category</option>

<?php
if ($numrows > 0) {
    while ($row = mysqli_fetch_array($result)) {
?>
        <option value="<?php echo $row['sub_category_id']; ?>"><?php echo $row['sub_category_name']; ?></option>
<?php }
} ?>