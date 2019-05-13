
<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form id="searchForm" action="<?php echo URLROOT; ?>/searches/index" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input id="searchInput" type="text" name="search" class="global-search form-control border-0" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="<?php echo URLROOT ?>" class="js-logo-clone">4Eles</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <?php if(isset($_SESSION['user_id'])) : ?>
                    <?php if($_SESSION['user_role'] > 1) : ?>
                      <li id="userRole"><a href="<?php echo URLROOT?>/admins/products"><i class="fas fa-user-shield"></i> Admin Page</a></li>
                    <?php endif; ?>
                    <li id="user-info"><a href="<?php echo URLROOT?>/profiles/index"><span class="icon icon-person"></span> Hello <?php echo $_SESSION['user_name']; ?></a></li>
                    <li><a href="<?php echo URLROOT; ?>/users/logout">Log out</a></li>
                  <?php else: ?>
                    <li class="user-form"><button id="loginBtn" type="button" class="btn-link" data-toggle="modal" data-target="#loginForm">
                    Login
                    </button></li>
                    <li class="user-form"><button type="button" class="btn-link" data-toggle="modal" data-target="#registerForm">
                    Register
                    </button></li>
                  <?php endif; ?>
                  <li>
                    <a href="<?php echo URLROOT; ?>/carts/index" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span id="cartQuantity" class="count">0</span>
                    </a>
                  </li> 
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>

                <!-- Login form -->
                <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="loginFormTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="loginFormTitle">Login Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="" id="login-form">
                        <div id="login-general-alert" class="text-left"></div>
                        <div id="login-email-group" class="form-group">
                          <label class="float-left" for="email">Email</label>
                          <input type="text" name="email" class="form-control">
                          <div class="text-left text-danger" id="login-email-err"></div>
                        </div>
                        <div id="login-password-group" class="form-group">
                          <label class="float-left" for="password">Password</label>
                          <input type="password" name="password" class="form-control">
                          <div class="text-left text-danger" id="login-password-err"></div>
                        </div>
                        <input id="registerChange" type="button" class="btn-link" value="No account? Register">
                        <input type="submit" id="loginSubmit" class="btn btn-primary"  name="login-submit" value="Login">
                      </form>
                    </div>
                    <div class="modal-footer">
                     
                    </div>
                  </div>
                </div>
              </div>

              <!-- Register form -->
              <div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="registerFormTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="registerFormTitle">Register Form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="" id="register-form">
                        <div id="register-general-alert" class="text-left"></div>
                        <div class="row">
                          <div class="col-md-6">
                            <div id="register-first-name-group" class="form-group">
                              <label class="float-left" for="first-name">First Name *</label>
                              <input type="text" name="first-name" class="form-control">
                              <div class="text-left text-danger" id="register-first-name-err"></div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div id="register-last-name-group" class="form-group">
                              <label class="float-left" for="last-name">Last Name *</label>
                              <input type="text" name="last-name" class="form-control">
                              <div class="text-left text-danger" id="register-last-name-err"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div id="register-email-group" class="form-group">
                              <label class="float-left" for="email">Email *</label>
                              <input type="text" name="email" class="form-control">
                              <div class="text-left text-danger" id="register-email-err"></div>
                            </div>  
                          </div>
                          <div class="col-md-6">
                            <div id="register-phone-group" class="form-group">
                              <label class="float-left" for="phone">Phone Number *</label>
                              <input type="text" name="phone" class="form-control">
                              <div class="text-left text-danger" id="register-phone-err"></div>
                            </div>
                          </div>
                        </div>
                        <div id="register-address-group" class="form-group">
                          <label class="float-left" for="address">Address</label>
                          <input type="text" name="address" class="form-control">
                          <div class="text-left text-danger" id="register-address-err"></div>
                        </div>
                        <div id="register-password-group" class="form-group">
                          <label class="float-left" for="password">Password *</label>
                          <input type="password" name="password" class="form-control">
                          <div class="text-left text-danger" id="register-password-err"></div>
                        </div>
                        <div id="register-confirmPass-group" class="form-group">
                          <label class="float-left" for="confirm-password">Confirm Password *</label>
                          <input type="password" name="confirm-password" class="form-control">
                          <div class="text-left text-danger" id="register-confirmPass-err"></div>
                        </div>
                        <div id="register-sex-group" class="mb-1 d-flex">
                          <div class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" name="sex" value="male" checked="checked"></span> <span class="d-inline-block text-black">Male</span>  
                          </div>
                          <div class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" name="sex" value="female"></span> <span class="d-inline-block text-black">Female</span>  
                          </div>
                        </div>
                        <input id="loginChange" type="button" class="btn-link" value="Have an account? Login">
                        <input id="registerSubmit" class="btn btn-primary" type="submit" name="register-submit" value="Register">
                      </form>
                    </div>
                    <div class="modal-footer">
                      
                    </div>
                  </div>
                </div>
              </div>

              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li>
              <a href="<?php echo URLROOT ?>/pages/home">Home</a>
            </li>
            <li>
              <a href="<?php echo URLROOT ?>/pages/about">About</a>
            </li>
            <li><a href="<?php echo URLROOT; ?>/shops/index">Shop</a></li>
            <li><a href="<?php echo URLROOT ?>/pages/contact">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>
    
    