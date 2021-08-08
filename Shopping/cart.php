<?php

include '_dbconnect.php';

$firstname = $lastname = $email = $address = $country = $state = $zip = "";
$firstname_err = $lastname_err = $email_err = $address_err = $country_err = $state_err = $zip_err = $error = "";


function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

$count = 0;
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
}

if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $keys => $values) {
            if ($values['product_id'] == $id) {
                unset($_SESSION['cart'][$keys]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header('location: cart.php');
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['checkout'])) {
        if (empty(trim($_POST['firstname']))) {
            $firstname_err = "First Name is required.";
        } else {
            $firstname = input_data($_POST['firstname']);
            if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
                $firstname_err = "First Name should only contain alphabets and Whitespaces.";
            }
        }

        if (empty(trim($_POST['lastname']))) {
            $lastname_err = "Last Name is required.";
        } else {
            $lastname = input_data($_POST['lastname']);
            if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
                $lastname_err = "Last Name should only contain alphabets and Whitespaces.";
            }
        }

        if (empty(trim($_POST['email']))) {
            $email_err = "Email is required.";
        } else {
            $email = input_data($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid Email format.";
            }
        }

        if (empty(trim($_POST['address']))) {
            $address_err = "Address is required.";
        } else {
            $address = input_data($_POST['address']);
            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $address)) {
                $address_err = "Address should only contain alphabets, Numbers and Whitespaces.";
            }
        }

        if (isset($_POST['country'])) {
            if ($_POST['country'] == 'NULL') {
                $country_err = "Please select your Country.";
            } else {
                $country = $_POST['country'];
            }
        }

        if (isset($_POST['state'])) {
            if ($_POST['state'] == 'NULL') {
                $state_err = "Please select your State.";
            } else {
                $state = $_POST['state'];
            }
        }

        if (empty(trim($_POST['zip']))) {
            $zip_err = "Zip is required.";
        } else {
            $zip = input_data($_POST['zip']);
            if (!preg_match("/^[0-9]*$/", $zip)) {
                $zip_err = "Zip should only contain Numbers.";
            }
        }

        if (empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($address_err) && empty($country_err) && empty($state_err) && empty($zip_err)) {
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $keys => $values) {
                    $product_id = $values['product_id'];
                    $product_name = $values['product_name'];
                    $product_image = $values['product_image'];
                    $quantity = $values['quantity'];
                    $price = $values['price'];
                    $total = $values['total'];
                    $sql = "INSERT INTO orders (firstname, lastname, email, address, country_id, state_id, zip, product_id, product_name, product_image, quantity, price, total) VALUES ('$firstname', '$lastname', '$email', '$address', '$country', '$state', '$zip', '$product_id', '$product_name', '$product_image', '$quantity', '$price', '$total')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        unset($_SESSION['cart']);
                        header('location: cart.php?checkout=success');
                    } else {
                        $error = "error";
                    }
                }
            }
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
    <?php
    if (isset($_GET['place_order'])) {
    ?>
        <section>
            <div class="container">
                <div class="py-5 text-center" style="margin-top: 40px;">
                    <h2>Shipping Details</h2>
                </div>
                <div class="row" style="justify-content: center;">
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Billing address</h4>
                        <span class="error"><?php echo $error; ?></span>
                        <form class="needs-validation" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstName" placeholder="First Name" value="<?php echo $firstname; ?>">
                                    <span class="error"><?php echo $firstname_err; ?></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastName" placeholder="Last name" value="<?php echo $lastname; ?>">
                                    <span class="error"><?php echo $lastname_err; ?></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
                                <span class="error"><?php echo $email_err; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $address; ?>">
                                <span class="error"><?php echo $address_err; ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country</label>
                                    <select class="custom-select d-block w-100" name="country" id="country">
                                        <option value="NULL">Select Country</option>
                                        <?php
                                        $csql = "SELECT * FROM country ORDER BY country ASC";
                                        $cresult = mysqli_query($conn, $csql);
                                        foreach ($cresult as $cvalues) {
                                        ?>
                                            <option value="<?php echo $cvalues['country_id']; ?>"><?php echo $cvalues['country']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error"><?php echo $country_err; ?></span>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <select class="custom-select d-block w-100" name="state" id="state">
                                        <option value="NULL">Select State</option>
                                    </select>
                                    <span class="error"><?php echo $state_err; ?></span>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip" value="<?php echo $zip; ?>">
                                    <span class="error"><?php echo $zip_err; ?></span>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <h4 class="mb-3">Payment</h4>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="payment_method" value="credit_card" type="radio" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="payment_method" value="debit_card" type="radio" class="custom-control-input">
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="payment_method" value="paypal" type="radio" class="custom-control-input">
                                    <label class="custom-control-label" for="paypal">PayPal</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" name="cc_name" id="cc-name" placeholder="Name on card">
                                    <small class="text-muted">Full name as displayed on card</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" name="cc_number" id="cc-number" placeholder="Credit card number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiry Date</label>
                                    <input type="text" class="form-control" name="cc_expiration" id="cc-expiration" placeholder="Expiry date">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-cvv">CVV</label>
                                    <input type="text" class="form-control" name="cc_cvv" id="cc-cvv" placeholder="CVV">
                                </div>
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="checkout">Continue to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php } elseif (isset($_GET['checkout'])) {
        if ($_GET['checkout'] == 'success') {
        ?>
            <section>
                <div class="container">
                    <div class="py-5 text-center" style="margin-top: 40px;">
                        <h2 class="success">Order Placed Successfully.</h2>
                    </div>
                </div>
            </section>
        <?php
        }
    } else { ?>
        <section class="productblock" id="product">
            <div class="container">
                <h1 class="text-center module" style="margin-bottom:40px;">CART</h1>
                <div class="row">
                    <table class="table table-image" style="background-color: white;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION['cart'])) {
                                $total = 0;
                                foreach ($_SESSION['cart'] as $keys => $values) {
                            ?>
                                    <tr>
                                        <td class="w-25" style="height: 200px;">
                                            <img src="<?php echo $values['product_image']; ?>" class="img-fluid img-thumbnail" alt="">
                                        </td>
                                        <td><?php echo $values['product_name']; ?></td>
                                        <td><?php echo $values['price']; ?></td>
                                        <td><?php echo $values['quantity']; ?></td>
                                        <td><?php echo $values['total']; ?></td>
                                        <td>
                                            <a href="cart.php?product_id=<?php echo $values['product_id']; ?>" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                                <?php
                                $totalprice = array_column($_SESSION['cart'], 'total');
                                $total = array_sum($totalprice);
                                ?>
                                <div class="d-flex justify-content-end">
                                    <h4>Cart Value:<span class="price text-success">$<?php echo $total; ?></span></h4>
                                </div>
                            <?php
                            } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">You have no products added in your Shopping Cart</td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
                <?php if (!empty($_SESSION['cart'])) { ?>
                    <a href="cart.php?place_order" name="place_order" style="margin-top:5px;" class="btn btn-success">Place order</a>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                var country_id = $(this).val();
                $.ajax({
                    url: "select_state.php",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    success: function(result) {
                        $('#state').html(result);
                    }
                });
            });
        });
    </script>
    <?php
    include 'footer.php';

    ?>