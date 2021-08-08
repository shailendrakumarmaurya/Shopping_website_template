<?php

include 'header.php';

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?php echo $_SESSION['username']; ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Products List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="product">
                            <thead>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Category Name
                                    </th>
                                    <th>
                                        Sub-Category Name
                                    </th>
                                    <th>
                                        Product Name
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        SKU
                                    </th>
                                    <th>
                                        Category Image
                                    </th>
                                    <th>
                                        Sub-Category Image
                                    </th>
                                    <th>
                                        Product Image
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Edit
                                    </th>
                                    <th>
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT c.category_id, c.category_name, c.category_image, s.sub_category_id, s.sub_category_name, s.sub_category_image, p.product_id, p.product_name, p.description, p.sku, p.img, p.price, p.status FROM category c INNER JOIN sub_category s ON c.category_id = s.category_id INNER JOIN products p ON s.sub_category_id = p.sub_category_id ORDER BY category_name ASC";
                                $result = mysqli_query($conn, $sql);
                                $num = mysqli_num_rows($result);
                                $srno = 0;
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['product_id'];
                                        $srno = $srno + 1;
                                        if ($row['status'] == 1) {
                                            $statusText = "Active";
                                            $statusClass = "btn-success";
                                        } else {
                                            $statusText = "In-Active";
                                            $statusClass = "btn-danger";
                                        }
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $srno; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['category_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['sub_category_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['product_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['description']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['sku']; ?>
                                            </td>
                                            <td class="py-1">
                                                <img src="<?php echo $row['category_image']; ?>" alt="image" />
                                            </td>
                                            <td class="py-1">
                                                <img src="<?php echo $row['sub_category_image']; ?>" alt="image" />
                                            </td>
                                            <td class="py-1">
                                                <img src="<?php echo $row['img']; ?>" alt="image" />
                                            </td>
                                            <td>
                                                <?php echo $row['price']; ?>
                                            </td>
                                            <td>
                                                <a href='<?php echo "pro_status_update.php?product_id=" . $id; ?>' class="btn <?php echo $statusClass; ?> mr-2"><?php echo $statusText; ?></a>
                                            </td>
                                            <td>
                                                <a href='<?php echo "add_products.php?product_id=" . $id; ?>' class="btn btn-warning mr-2">Edit</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger mr-2 product_delete" data-id="<?php echo $row['product_id']; ?>">Delete</button>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->

    <?php

    include 'footer.php';

    ?>