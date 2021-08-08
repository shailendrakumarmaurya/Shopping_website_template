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
    <section>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $sql = "SELECT * FROM banners ORDER BY banner_id ASC";
                $result = mysqli_query($conn, $sql);
                $i = 0;
                foreach ($result as $values) {
                    $active = '';
                    if ($i == 0) {
                        $active = 'active';
                    }
                ?>
                    <div class="carousel-item <?php echo $active; ?>">
                        <img class="d-block w-100" style="height:700px;" src="<?php echo $values['banner_image']; ?>" alt="First slide">
                    </div>
                <?php $i++;
                } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section class="background" id="home">
        <div class="ovelay"></div>
        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="col-md-10 col-lg-6" style="color: #fff;">
                    <h1 class="pb-3 display-1 module">Photographer</h1>
                    <h3 class="mbr-section-subtitle mbr-semibold align-center mbr-light mbr-fonts-style display-5">ABOUT ME</h3>
                    <p class="mbr-text pb-3 mbr-fonts-style module">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu dui non diam eleifend egestas id a
                        ligula. Proin interdum vehicula neque sit amet scelerisque. Nulla imperdiet mollis libero, in
                        efficitur ligula.</p>
                </div>
            </div>
        </div>
        <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                    <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
                </g>
            </g>
        </svg>
    </section>
    <section class="features1" id="blog">
        <div class="container">
            <h1 class="text-center module" style="margin-bottom:40px;">Blog</h1>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3 module">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                    </div>
                    <div class="card-box ">
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions
                        </h4>
                        <p class="align-center card-box-fonts-style display-7 module">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper elementum felis in
                            bibendum. Proin vitae turpis ipsum.</p>
                        <h5 class="link align-center py-3 mbr-fonts-style display-7 module"><a href="#" class="text-black">
                                READ MORE</a></h5>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3 module">
                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions
                        </h4>
                        <p class="align-center card-box-fonts-style display-7 module">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper elementum felis in
                            bibendum. Proin vitae turpis ipsum.</p>
                        <h5 class="link align-center py-3 mbr-fonts-style display-7 module"><a href="#" class="text-black">
                                READ MORE</a></h5>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3 module">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions
                        </h4>
                        <p class="align-center card-box-fonts-style display-7 module">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ullamcorper elementum felis in
                            bibendum. Proin vitae turpis ipsum.</p>
                        <h5 class="link align-center py-3 mbr-fonts-style display-7 module"><a href="#" class="text-black">
                                READ MORE</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="header3 cid-rygY1mTaK1" id="Story">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 mf-0 image-align">
                    <div class="mbr-figure module">
                        <img src="image/02.jpg" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 py-5 m-auto">
                    <div class="media-content">
                        <h1 class="module">My Story</h1>
                        <h3 class="module">Creative Photography</h3>
                        <div class="module">
                            <p class="text-black ">Lorem ipsum
                                dolor sit amet, consectetur adipiscing elit. Nulla eget lectus eu ex ornare porta euismod a
                                libero. Phasellus vehicula placerat enim at egestas. Aliquam suscipit felis in massa
                                hendrerit tristique. In augue diam, pellentesque nec pulvinar in, sagittis ac nulla. Sed eu
                                lectus vitae justo vehicula viverra. Aenean vel urna vitae massa consequat blandit. Quisque
                                sodales sapien vitae malesuada ultricies. Curabitur pretium ipsum non nunc facilisis semper.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php

    include 'footer.php';

    ?>