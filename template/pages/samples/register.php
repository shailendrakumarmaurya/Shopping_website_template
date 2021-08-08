<?php

include '_dbconnect.php';

$username = $email = $country = $password = $success = $error = $checkbox = "";
$username_err = $email_err = $country_err = $password_err = "";
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        if (empty(trim($_POST['username']))) {
            $username_err = "Username is required.";
        } else {
            $username = input_data($_POST['username']);
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
                $username_err = "Username should only contain alphabets and numbers.";
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
        if (isset($_POST['country'])) {
            if ($_POST['country'] == 'NULL') {
                $country_err = "Please select your Country.";
            } else {
                $country = $_POST['country'];
            }
        }
        if (!empty(trim($_POST['password']))) {
            $password = input_data($_POST['password']);
            if (strlen($password) < '8') {
                $password_err = "Password must contain atleast 8 characters.";
            } elseif (!preg_match('#[A-Z]+#', $password)) {
                $password_err = "Password should contain atleast 1 Capital letter.";
            } elseif (!preg_match('#[a-z]+#', $password)) {
                $password_err = "Password should contain atleast 1 lowercase letter.";
            } elseif (!preg_match('#[0-9]+#', $password)) {
                $password_err = "Password should contain atleast 1 number.";
            } elseif (!preg_match('/[\'^£$%&*()}{@#~?><,|=_+-]/', $password)) {
                $password_err = "Password Must Contain At Least 1 special character.";
            } elseif (strlen($password) >= '20') {
                $password_err = "Password must less than 20 characters.";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        } else {
            $password_err = "Enter Password.";
        }

        if (empty($username_err) && empty($email_err) && empty($country_err) && empty($password_err)) {
            $query = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";
            $queryresult = mysqli_query($conn, $query);
            $numrows = mysqli_num_rows($queryresult);
            if ($numrows == 0) {
                $sql = "INSERT INTO user (username, email, country, password) VALUES ('$username', '$email', '$country', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success = "Registered Successfully.";
                } else {
                    $error = "error";
                }
            } else {
                $error = "User already registered.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <style>
        .error {
            color: #FF0000;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <span class="success"><?php echo $success; ?></span>
                            <span class="error"><?php echo $error; ?></span>
                            <form class="pt-3" action="register.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username" id="exampleInputUsername1" placeholder="Username">
                                    <span class="error"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                                    <span class="error"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="country" id="exampleFormControlSelect2">
                                        <option value="NULL">Country</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="USA">United States of America</option>
                                        <option value="IN">India</option>
                                        <option value="GM">Germany</option>
                                        <option value="AR">Argentina</option>
                                    </select>
                                    <span class="error"><?php echo $country_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                                    <span class="error"><?php echo $password_err; ?></span>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="checkbox" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="register" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP">
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login.php" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>