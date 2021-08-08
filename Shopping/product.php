<?php

include '_dbconnect.php';

$quantity = 1;
$error = "";
session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

$count = 0;
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
}

if (isset($_POST['add_to_cart'])) {
    $quantity = $_POST['quantity'];
    $id = $_GET['product_id'];
    if (!isset($_SESSION['cart'])) {
        $product_array = array(
            'product_id' => $_GET['product_id'],
            'product_name' => $_POST['product_name'],
            'product_image' => $_POST['product_image'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity'],
            'total' => ($_POST['quantity'] * $_POST['price'])
        );
        $_SESSION['cart'][0] = $product_array;
        header('location: product.php?product_id='.$id.'&added');
    } else {
        $product_array_id = array_column($_SESSION['cart'], 'product_id');
        if (!in_array($_GET['product_id'], $product_array_id)) {
            $count = count($_SESSION['cart']);
            $product_array = array(
                'product_id' => $_GET['product_id'],
                'product_name' => $_POST['product_name'],
                'product_image' => $_POST['product_image'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'total' => ($_POST['quantity'] * $_POST['price'])
            );
            $_SESSION['cart'][$count] = $product_array;
            header('location: product.php?product_id='.$id.'&added');
        } else {
            echo $error = "Product Already Added to Cart.";
        }
    }
}

include 'header.php';

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
    <section class="images-priview" id="product">
        <div class="container">
            <div class="row">
                <h2 class="module align-center text-uppercase wt-100">Product</h2>
            </div>
            <?php
            if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
                $id = $_GET['product_id'];
                $sql = "SELECT * FROM products WHERE product_id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $product = $row['product_name'];
                $images = $row['img'];
                $price = $row['price'];
                $desc = $row['description'];
            ?>
                <div class="col-md-4">
                    <h4 class="error"><?php echo $error; ?></h4>
                    <h4 class="success"><?php if(isset($_GET['added'])){ echo "Product Added to Cart.";} ?></h4>
                    <form method="post" action="product.php?product_id=<?php echo $id; ?>">
                        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                            <img src="<?php echo $images; ?>" class="img-responsive" /><br />
                            <h4 class="text-info"><?php echo $product; ?></h4>
                            <h4 class="text-danger">$ <?php echo $price; ?></h4>
                            <input type="number" min="1" name="quantity" class="form-control" value="<?php echo $quantity; ?>" />
                            <input type="hidden" name="product_name" value="<?php echo $product; ?>" />
                            <input type="hidden" name="price" value="<?php echo $price; ?>" />
                            <input type="hidden" name="product_image" value="<?php echo $images; ?>" />
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                            <h5>Description</h5>
                            <h6 class="text-info"><?php echo $desc; ?></h6>
                        </div>
                    </form>
                </div>

            <?php
            } else { ?>
                <?php
                if (isset($_GET['sub_category_id']) && !empty($_GET['sub_category_id'])) {
                    $id = $_GET['sub_category_id'];
                    $sql = "SELECT * FROM products WHERE sub_category_id = $id ORDER BY product_name";
                } else {
                    $sql = "SELECT * FROM products ORDER BY product_name";
                }
                $result = mysqli_query($conn, $sql);
                $numrows = mysqli_num_rows($result);
                if ($numrows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['product_id'];
                        $images = $row['img'];
                        $product = $row['product_name'];
                ?>
                        <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                            <div class="preview-img">
                                <a href="product.php?product_id=<?php echo $id; ?>"><img src="<?php echo $images; ?>" style="height: 225px;" />
                                    <span class="text-info" style="opacity: 0.8; background-color: white; font-weight: bold; display: block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; text-align: center;"><?php echo $product; ?></span>
                                </a>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "No Products Available.";
                }
            }
            ?>

        </div>
    </section>
    <?php

    include 'footer.php';

    ?>