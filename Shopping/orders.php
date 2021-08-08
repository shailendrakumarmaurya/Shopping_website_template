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
    <section class="productblock" id="orders">
        <div class="container">
            <h1 class="text-center module" style="margin-bottom:40px;">ORDER DETAILS</h1>
            <div class="row">
                <table class="table table-image" style="background-color: white;">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Billing Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT o.order_id, o.firstname, o.lastname, o.email, o.address, o.zip, o.product_name, o.product_image, o.price, o.quantity, o.total, c.country, s.state FROM orders o INNER JOIN country c ON o.country_id = c.country_id INNER JOIN state s ON c.country_id = s.country_id GROUP BY order_id ORDER BY product_name ASC";
                        $result = mysqli_query($conn, $sql);
                        $numrows = mysqli_num_rows($result);
                        if ($numrows == 0) {
                        ?>
                            <tr>
                                <td colspan="6" style="text-align:center;">No Orders Placed</td>
                            </tr>
                            <?php
                        } else {
                            foreach ($result as $keys => $values) {
                            ?>
                                <tr>
                                    <td class="w-25" style="height: 200px;">
                                        <img src="<?php echo $values['product_image']; ?>" class="img-fluid img-thumbnail" alt="">
                                    </td>
                                    <td><?php echo $values['product_name']; ?></td>
                                    <td><?php echo $values['price']; ?></td>
                                    <td><?php echo $values['quantity']; ?></td>
                                    <td><?php echo $values['total']; ?></td>
                                    <td><?php echo $values['firstname'] . " " . $values['lastname'] . "<br>" . $values['email'] . "<br>" . $values['address'] . "<br>" . $values['country'] . "<br>" . $values['state'] . "<br>" . $values['zip']; ?></td>
                                    <td>
                                        <button class="btn btn-danger mr-2 cancel_order" data-id="<?php echo $values['order_id']; ?>">Cancel Order</button>
                                    </td>
                                </tr>
                        <?php  }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).on('click', '.cancel_order', function() {
            var id = $(this).data("id");
            var del = $(this);
            $.ajax({
                url: "cancel_order.php",
                method: "POST",
                data: {
                    order_id: id
                },
                success: function(data) {
                    del.parent().parent().remove();
                }
            });
        });
    </script>
    <?php

    include 'footer.php';

    ?>