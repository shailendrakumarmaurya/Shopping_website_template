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
    $searchQuery = " AND (product_name LIKE '%" . $searchValue . "%' OR description LIKE '%" . $searchValue . "%' OR sku LIKE'%" . $searchValue . "%' OR price LIKE'%" . $searchValue . "%' OR status LIKE'%" . $searchValue . "%') ";
}


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM products");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];


$sel = mysqli_query($conn, "SELECT COUNT(*) AS allcount FROM products WHERE 1 " . $searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


$Query = "SELECT c.category_id, c.category_name, c.category_image, s.sub_category_id, s.sub_category_name, s.sub_category_image, p.product_id, p.product_name, p.description, p.sku, p.img, p.price, p.status FROM category c INNER JOIN sub_category s ON c.category_id = s.category_id INNER JOIN products p ON s.sub_category_id = p.sub_category_id WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT " . $row . "," . $rowperpage;
$Records = mysqli_query($conn, $Query);
$data = array();

while ($row = mysqli_fetch_assoc($Records)) {
    if ($row['status'] == 1) {
        $statusClass = "btn-success";
        $statusText = "Active";
    } else {
        $statusClass = "btn-danger";
        $statusText = "In-Active";
    }
    $id = $row['product_id'];
    $data[] = array(
        "product_id" => $row['product_id'],
        "category_name" => $row['category_name'],
        "sub_category_name" => $row['sub_category_name'],
        "product_name" => $row['product_name'],
        "description" => $row['description'],
        "sku" => $row['sku'],
        "category_image" => "<img src=".$row['category_image']." alt='image' />",
        "sub_category_image" => "<img src=".$row['sub_category_image']." alt='image' />",
        "product_image" => "<img src=".$row['img']." alt='image' />",
        "price" => $row['price'],
        "status" => "<button name='status' class='btn mr-2 " . $statusClass . " pro_status_update' value='" . $row['status'] . "' data-id='" . $row['product_id'] . "'>" . $statusText . "</button>",
        "edit" => "<a href='product_edit.php?product_id=$id'><button name='update' class='btn btn-warning mr-2'>Edit</button></a>",
        "delete" => "<button name='product_delete' class='btn btn-danger mr-2 product_delete' data-id='".$row['product_id']."'>Delete</button>",
    );
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
