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
                    <h4 class="card-title">Banner List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="banners">
                            <thead>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Banner Image
                                    </th>
                                    <th>
                                        Position
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
                                $sql = "SELECT * FROM banners";
                                $result = mysqli_query($conn, $sql);
                                $num = mysqli_num_rows($result);
                                $srno = 0;
                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['banner_id'];
                                        $status = $row['status'];
                                        if ($row['status'] == 1) {
                                            $statusClass = "btn-success";
                                            $statusText = "Active";
                                        } else {
                                            $statusClass = "btn-danger";
                                            $statusText = "In-Active";
                                        }
                                        $srno = $srno + 1;

                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $srno; ?>
                                            </td>
                                            <td class="py-1">
                                                <img src="<?php echo $row['banner_image']; ?>" alt="image" />
                                            </td>
                                            <td>
                                                <?php echo $row['position']; ?>
                                            </td>
                                            <td>
                                                <button name='status' class='btn mr-2 <?php echo $statusClass; ?> status_update' value='<?php echo $status; ?>' data-id='<?php echo $id; ?>'><?php echo $statusText; ?></button>
                                            </td>
                                            <td>
                                                <a href='<?php echo "add_banners.php?banner_id=" . $id; ?>' class=" btn btn-warning mr-2">Edit</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger mr-2 banner_delete" data-id="<?php echo $row['banner_id']; ?>">Delete</button>
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