<?php

include '_dbconnect.php';

$email = $pass = "";
$email_err = $pass_err = $error = "";

session_start();
if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
}

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        if (empty(trim($_POST['email']))) {
            $email_err = "Enter Your Email!";
        } else {
            $email = input_data($_POST['email']);
        }

        if (empty(trim($_POST['pass']))) {
            $pass_err = "Enter Your Password!";
        } else {
            $pass = input_data($_POST['pass']);
        }

        if (empty($email_err) && empty($pass_err)) {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $numrows = mysqli_num_rows($result);
            if ($numrows == 1) {
                if ($row = mysqli_fetch_assoc($result)) {
                    if (!password_verify($pass, $row['password'])) {
                        $pass_err = "Invalid Password!";
                    } else {
                        $_SESSION['email'] = $row['email'];
                        header('location: dashboard.php');
                    }
                }
            } else {
                $error = "Invalid Email or Password!";
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
                                <h2 class="text-uppercase text-center mb-5">Login</h2>
                                <span class="error"><?php echo $error; ?></span>
                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Email</label>
                                        <input type="email" name="email" value="<?php echo $email; ?>" id="form3Example3cg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                        <input type="password" name="pass" id="form3Example4cg" class="form-control form-control-lg" />
                                        <span class="error"><?php echo $pass_err; ?></span>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="login" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Login">
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="register.php" class="fw-bold text-body"><u>Register here</u></a></p>
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