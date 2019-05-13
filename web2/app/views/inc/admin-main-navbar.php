<div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="<?php echo URLROOT; ?>/images/admin-icon/4elesadminicon.png" alt="Admin Mini Icon" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="admin_products.html">
                                <i class="fab fa-product-hunt"></i>Products</a>
                        </li>
                        <li>
                            <a href="admin_users.html">
                                <i class="fas fa-user"></i>Users</a>
                        </li>
                        <li>
                            <a href="admin_orders.html">
                                <i class="fab fa-elementor"></i>Orders</a>
                        </li>
                        <li>
                            <a href="admin_statistic.html">
                                <i class="fas fa-chart-line"></i>Statistic</a>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT; ?>/pages/index">
                            <i class="fas fa-sign-out-alt"></i>Go To Shopping Page</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php require APPROOT . '/views/inc/admin-desktop-navbar.php'; ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap" style="float:right;">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?php echo URLROOT; ?>/images/admin-icon/4elesadminminilogo.png" alt="Admin Mini Icon" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['user_name']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?php echo URLROOT; ?>/images/admin-icon/4elesadminminilogo.png" alt="Admin Mini Icon" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['user_name']; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['user_email']; ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="<?php echo URLROOT; ?>/users/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->
