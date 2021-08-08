<?php

include 'pages/samples/_dbconnect.php';

$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = mysqli_real_escape_string($conn, $_POST['search']['value']);


$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND (category_name LIKE '%" . $searchValue . "%') ";
}
$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM category");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM category WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


$empQuery = "SELECT * FROM category WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $row . "," . $rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $id = $row['category_id'];
    $data[] = array(
        "category_id" => $row['category_id'],
        "category_name" => $row['category_name'],
        "category_image" => "<img src=".$row['category_image']." alt='image' />",
        "edit" => "<a href='edit.php?category_id=$id'><button name='update' class='btn btn-warning mr-2'>Edit</button></a>",
        "delete" => "<button name='delete' class='btn btn-danger mr-2 delete' data-id='".$row['category_id']."'>Delete</button>",
    );
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
