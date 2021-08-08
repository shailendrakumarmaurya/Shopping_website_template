<?php

include '_dbconnect.php';

if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
}

$uname = $email = $pass = $cpass = $success = "";
$uname_err = $email_err = $pass_err = $cpass_err = $error = "";

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        if (empty(trim($_POST['uname']))) {
            $uname_err = "Enter Your Name!";
        } else {
            $uname = input_data($_POST['uname']);
            if (!preg_match("/^[a-zA-z ]*$/", $uname)) {
                $uname_err = "Only Alphabets and Whitespaces are allowed!";
            }
        }

        if (empty(trim($_POST['email']))) {
            $email_err = "Enter Your Email!";
        } else {
            $email = input_data($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid Email!";
            }
        }

        if (empty(trim($_POST['pass']))) {
            $pass_err = "Enter Password!";
        } else {
            $pass = input_data($_POST['pass']);
            if (strlen($pass) < 8) {
                $pass_err = "Password must contain Minimum 8 characters!";
            } elseif (strlen($pass) > 20) {
                $pass_err = "Password can contain Maximum of 20 characters!";
            } elseif (!preg_match('#[a-z]+#', $pass)) {
                $pass_err = "Password must contain 1 Lowercase character!";
            } elseif (!preg_match('#[A-Z]+#', $pass)) {
                $pass_err = "Password must contain 1 Uppercase character!";
            } elseif (!preg_match('#[0-9]+#', $pass)) {
                $pass_err = "Password must contain 1 Number!";
            } elseif (!preg_match('/[\'^£$%&*()}{@#~?><,|=_+-]/', $pass)) {
                $pass_err = "Password must contain 1 Special character!";
            } else {
                if (empty(trim($_POST['cpass']))) {
                    $cpass_err = "Confirm Password!";
                } else {
                    $cpass = input_data($_POST['cpass']);
                    if ($pass != $cpass) {
                        $cpass_err = "Passwords Must Match!";
                    }
                }
                $pass = password_hash($pass, PASSWORD_DEFAULT);
            }
        }

        if (empty($uname_err) && empty($email_err) && empty($pass_err) && empty($cpass_err)) {
            $query = "SELECT email FROM users WHERE email = '$email'";
            $queryResults = mysqli_query($conn, $query);
            $numrows = mysqli_num_rows($queryResults);
            if ($numrows > 0) {
                $error = "User Already Registered!";
            } else {
                $sql = "INSERT INTO users (name, email, password) VALUES ('$uname', '$email', '$pass')";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $error = "Failed!";
                } else {
                    $success = "Registered Successfully!";
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
                    <div class="logo col-md-2"><a class="js-scroll-trigger" href="#"><img src="image/logo1.png" /></a></div>
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
                            <li><a href="cart.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                            <li><a href="login.php"><i class="fa fa-user-circle" aria-hidden="true"> Login</i></a></li>
                            <li><a href="register.php"><i class="fa fa-user-circle" aria-hidden="true"> Register</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.jpg');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                                <span class="success"><?php echo $success; ?></span>
                                <span class="error"><?php echo $error; ?></span>
                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" name="uname" value="<?php echo $uname; ?>" id="form3Example1cg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $uname_err; ?></span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="email" name="email" value="<?php echo $email; ?>" id="form3Example3cg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                        <input type="password" name="pass" id="form3Example4cg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $pass_err; ?></span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                        <input type="password" name="cpass" id="form3Example4cdg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $cpass_err; ?></span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Register">
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    include 'footer.php';

    ?>