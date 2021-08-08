<?php

include 'header.php';

session_start();
if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
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
                            <li><a href="login.php"><i class="fa fa-user-circle" aria-hidden="true"> Login</i></a></li>
                            <li><a href="register.php"><i class="fa fa-user-circle" aria-hidden="true"> Register</i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
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
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions</h4>
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
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions</h4>
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
                        <h4 class="card-title align-center py-3 mbr-bold card-box-mbr-fonts-style display-5 module">Photo Sessions</h4>
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
    <section class="images-priview" id="photos">
        <div class="container">
            <div class="row">
                <h2 class="module align-center text-uppercase wt-100">photos Preview</h2>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery00.jpg" /></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery01.jpg" /></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery02.jpg" /></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery03.jpg" /></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery06.jpg" /></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 pt-25 float-left module">
                <div class="preview-img">
                    <a href="#"><img src="image/gallery07.jpg" /></a>
                </div>
            </div>

        </div>
    </section>
    <section class="productblock" id="product">
        <div class="container">
            <h1 class="text-center module" style="margin-bottom:40px;">Product</h1>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="innerblock">
                        <div class="userimg module"><a href="#"><img src="https://asia.canon/media/image/2020/07/08/87bff0f3ca594b3bbcc58ff6e4466ec1_R6_FrontSlantLeft_RF24-105mmF4-7.1ISSTM.png" /></a></div>
                        <div class="product-info text-center module">
                            <h3>product1</h3>
                            <p>Lorem ipsumdolor sit amet, consectetur adipiscing elit. Nulla eget lectus eu Lorem ipsumdolor sit amet, consectetur adipiscing elit. ex ornare porta euismod alibero.Lorem ipsumdolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#">like</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="innerblock">
                        <div class="innerblock">
                            <div class="userimg module"><a href="#"><img src="https://shop.usa.canon.com/wcsstore/CanonB2BStoreFrontAssetStore/images/eos-r6-2_l.png" /></a></div>
                            <div class="product-info text-center module">
                                <h3>product2</h3>
                                <p>Lorem ipsumdolor sit amet, consectetur adipiscing elit. Nulla eget lectus eu ex ornare porta euismod alibero.</p>
                                <a href="#">like</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="innerblock">
                        <div class="innerblock">
                            <div class="userimg module"><a href="#"><img src="https://i1.adis.ws/i/canon/eos-r6-24-105-front-on-gallery-pdp_ef934a7cb993443f8b823cc67db34012?$1by1-2xcolumn-prod$" /></a></div>
                            <div class="product-info text-center module">
                                <h3>product3</h3>
                                <p>Lorem ipsumdolor sit amet, consectetur adipiscing elit. Nulla eget lectus eu ex ornare porta euismod alibero.</p>
                                <a href="#">like</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="innerblock">
                        <div class="innerblock">
                            <div class="userimg module"><a href="#"><img src="https://pro.sony/s3/2019/08/28112651/PXW-FX9_Netflix_TMVHero.png" /></a></div>
                            <div class="product-info text-center module">
                                <h3>product4</h3>
                                <p>Lorem ipsumdolor sit amet, Lorem ipsumdolor sit amet, consectetur adipiscing elit. consectetur adipiscing elit. Nulla Lorem ipsumdolor sit amet, consectetur adipiscing elit. eget lectus eu ex ornare porta euismod alibero.</p>
                                <a href="#">like</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="product.html" class="more_products">view all</a>
        </div>
    </section>

    <?php

    include 'footer.php';

    ?>