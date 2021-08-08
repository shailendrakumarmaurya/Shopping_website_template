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
    $searchQuery = " AND (sub_category_name LIKE '%" . $searchValue . "%') ";
}


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM sub_category");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM sub_category WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


$empQuery = "SELECT c.category_id, c.category_name, c.category_image, s.sub_category_id, s.sub_category_name, s.sub_category_image FROM category c LEFT JOIN sub_category s ON c.category_id = s.category_id WHERE s.sub_category_id IS NOT NULL " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $row . "," . $rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $id = $row['sub_category_id'];
    $data[] = array(
        "sub_category_id" => $row['sub_category_id'],
        "category_name" => $row['category_name'],
        "sub_category_name" => $row['sub_category_name'],
        "category_image" => "<img src=" . $row['category_image'] . " alt='image' />",
        "sub_category_image" => "<img src=" . $row['sub_category_image'] . " alt='image' />",
        "edit" => "<a href='sub_edit.php?sub_category_id=$id'><button name='update' class='btn btn-warning mr-2'>Edit</button></a>",
        "delete" => "<button name='delete' class='btn btn-danger mr-2 sub_delete' data-id='" . $row['sub_category_id'] . "'>Delete</button>",
    );
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
