<?php

include '_dbconnect.php';


session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

include 'header.php';

$count = 0;
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
}

?>

<body>
    <section class="top-header">
        <nav class="top-nav-content  navbar-inverse navbar-fixed-top dastopmenu" id="mainNav">
            <div class="container-fluid">
                <div class="row">
                    <div class="logo col-md-2"><a class="js-scroll-trigger" href="dashboard.php"><img src="image/logo1.png" /></a></div>
                    <div class="menu col-md-8">
                        <ul id="top-menu">
                            <li><a class="js-scroll-trigger ds-menu-active" href="index.php">Home</a></li>
                            <li><a class="js-scroll-trigger" href="category.php">Category</a></li>
                            <li><a class="js-scroll-trigger" href="sub_category.php">Sub-Category</a></li>
                            <li><a class="js-scroll-trigger" href="product.php">Product</a></li>
                            <li><a class="js-scroll-trigger" href="orders.php">Orders</a></li>
                        </ul>
                    </div>
                    <div class="socialicons col-md-2">
                        <ul>
                            <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span><?php echo $count; ?></span></a></li>
                            <li><a href="logout.php"><i class="fa fa-user-circle" aria-hidden="true"> Logout</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section class="images-priview" id="sub_category">
        <div class="container">
            <div class="row">
                <h2 class="module align-center text-uppercase wt-100">Sub-Category</h2>
            </div>
            <?php
            if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
                $id = $_GET['category_id'];
                $sql = "SELECT * FROM sub_category WHERE category_id = $id ORDER BY sub_category_name";
            } else {
                $sql = "SELECT * FROM sub_category ORDER BY sub_category_name";
            }
            $result = mysqli_query($conn, $sql);
            $numrows = mysqli_num_rows($result);
            if ($numrows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['sub_category_id'];
                    $images = $row['sub_category_image'];
                    $sub_category = $row['sub_category_name'];
            ?>
                    <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                        <div class="preview-img">
                            <a href="<?php echo 'product.php?sub_category_id=' . $id; ?>"><img src="<?php echo $images; ?>" style="height: 200px;" /><label style="opacity: 0.8; background-color: white; font-weight: bold; display: block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; text-align: center;"><?php echo $sub_category; ?></label></a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No Sub-Categories Available.";
            }
            ?>
        </div>
    </section>
    <?php

    include 'footer.php';

    ?>