<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="<?php echo URLROOT; ?>/admins/products">
                    <img src="<?php echo URLROOT; ?>/images/admin-icon/4elesadminicon.png" alt="4Eles Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <?php if($_SESSION['user_role'] == 9) : ?>
                            <li>
                                <a href="<?php echo URLROOT; ?>/admins/products">
                                    <i class="fab fa-product-hunt"></i>Products</a>
                            </li>
                        <?php endif; ?>
                        <?php if($_SESSION['user_role'] == 99) : ?>
                            <li>
                                <a href="<?php echo URLROOT; ?>/admins/users">
                                    <i class="fas fa-user"></i>Users</a>
                            </li>
                        <?php endif; ?>
                        <?php if($_SESSION['user_role'] == 9) : ?>
                            <li>
                                <a href="<?php echo URLROOT; ?>/admins/orders">
                                    <i class="fab fa-elementor"></i>Orders</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo URLROOT; ?>/pages/index">
                            <i class="fas fa-sign-out-alt"></i>Go To Shopping Page</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>