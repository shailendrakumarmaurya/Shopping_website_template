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
    $searchQuery = " AND (status LIKE '%" . $searchValue . "%' OR position LIKE '%" . $searchValue . "%') ";
}


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM banners");

$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM banners WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


$Query = "SELECT * FROM banners WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $row . "," . $rowperpage;
$Records = mysqli_query($conn, $Query);
$data = array();

while ($row = mysqli_fetch_assoc($Records)) {
    $id = $row['banner_id'];
    if ($row['status'] == 1) {
        $statusClass = "btn-success";
        $statusText = "Active";
    } else {
        $statusClass = "btn-danger";
        $statusText = "In-Active";
    }
    $data[] = array(
        "banner_id" => $row['banner_id'],
        "banner_image" => "<img src=" . $row['banner_image'] . " alt='image' />",
        "position" => $row['position'],
        "status" => "<button name='status' class='btn mr-2 " . $statusClass . " status_update' value='" . $row['status'] . "' data-id='" . $row['banner_id'] . "'>" . $statusText . "</button>",
        "edit" => "<a href='banner_edit.php?banner_id=$id'><button name='update' class='btn btn-warning mr-2'>Edit</button></a>",
        "delete" => "<button name='banner_delete' class='btn btn-danger mr-2 banner_delete' data-id='" . $row['banner_id'] . "'>Delete</button>",
    );
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
