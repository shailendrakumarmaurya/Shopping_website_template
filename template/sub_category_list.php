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
          <h4 class="card-title">Sub-Category List</h4>
          <div class="table-responsive">
            <table class="table table-striped" id="sub_category">
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
                    Category Image
                  </th>
                  <th>
                    Sub-Category Image
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
                $sql = "SELECT * FROM category c INNER JOIN sub_category s ON c.category_id = s.category_id ORDER BY category_name ASC";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $srno = 0;
                if ($num > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['sub_category_id'];
                    $srno = $srno + 1;

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
                      <td class="py-1">
                        <img src="<?php echo $row['category_image']; ?>" alt="image" />
                      </td>
                      <td class="py-1">
                        <img src="<?php echo $row['sub_category_image']; ?>" alt="image" />
                      </td>
                      <td>
                        <a href='<?php echo "add_sub_category.php?sub_category_id=" . $id; ?>' class="btn btn-warning mr-2">Edit</a>
                      </td>
                      <td>
                        <button class="btn btn-danger mr-2 sub_delete" data-id="<?php echo $row['sub_category_id']; ?>">Delete</button>
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