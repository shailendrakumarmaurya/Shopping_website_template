<?php

include '_dbconnect.php';

$username = $password = $error = "";
$username_err = $password_err = "";
function input_data($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

session_start();

if (isset($_SESSION['username'])) {
  header('location: ../../index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['signin'])) {
    if (empty(trim($_POST['username']))) {
      $username_err = "Enter your Username.";
    } else {
      $username = input_data($_POST['username']);
    }
    if (!empty(trim($_POST['password']))) {
      $password = input_data($_POST['password']);
    } else {
      $password_err = "Enter Your Password.";
    }
    if (empty($username_err) && empty($password_err)) {
      $sql = "SELECT * FROM user WHERE username = '$username'";
      $result = mysqli_query($conn, $sql);
      $numrows = mysqli_num_rows($result);
      if ($numrows == 1) {
        if ($row = mysqli_fetch_assoc($result)) {
          if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header('location: ../../index.php');
          } else {
            $password_err = "Invalid password.";
          }
        }
      }else{
        $error = "Invalid Username or Password.";
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
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <span class="error"><?php echo $error; ?></span>
              <form class="pt-3" action="login.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="username" value="<?php echo $username; ?>"" placeholder=" Username">
                  <span class="error"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                  <span class="error"><?php echo $password_err; ?></span>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="signin" value="SIGN IN">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
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