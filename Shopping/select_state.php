<?php

include '_dbconnect.php';

$country_id = $_POST['country_id'];
$sql = "SELECT * FROM state WHERE country_id = $country_id ORDER BY state ASC";
$result = mysqli_query($conn, $sql);
$numrows = mysqli_num_rows($result);

if ($numrows > 0) {
    while ($row = mysqli_fetch_array($result)) {
?>
        <option value="<?php echo $row['state_id']; ?>"><?php echo $row['state']; ?></option>
<?php }
} ?>