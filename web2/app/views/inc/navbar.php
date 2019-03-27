<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Search">
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
                    <li id="user-info"><a href="#"><span class="icon icon-person"></span></a></li>
                    <li><a href="<?php echo URLROOT; ?>/users/logout">Log out</a></li>
                  <?php else: ?>
                    <li class="user-form"><button id="loginBtn" type="button" class="btn-link" data-toggle="modal" data-target="#loginForm">
                    Login
                    </button></li>
                    <li class="user-form"><button type="button" class="btn-link" data-toggle="modal" data-target="#registerForm">
                    Register
                    </button></li>
                  <?php endif; ?>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a href="<?php echo URLROOT; ?>/carts/index" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">2</span>
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
                        <div id="register-name-group" class="form-group">
                          <label class="float-left" for="name">Name</label>
                          <input type="text" name="name" class="form-control">
                          <div class="text-left text-danger" id="register-name-err"></div>
                        </div>
                        <div id="register-email-group" class="form-group">
                          <label class="float-left" for="email">Email</label>
                          <input type="text" name="email" class="form-control">
                          <div class="text-left text-danger" id="register-email-err"></div>
                        </div>
                        <div id="register-password-group" class="form-group">
                          <label class="float-left" for="password">Password</label>
                          <input type="password" name="password" class="form-control">
                          <div class="text-left text-danger" id="register-password-err"></div>
                        </div>
                        <div id="register-confirmPass-group" class="form-group">
                          <label class="float-left" for="confirm-password">Confirm Password</label>
                          <input type="password" name="confirm-password" class="form-control">
                          <div class="text-left text-danger" id="register-confirmPass-err"></div>
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
            <li class="has-children">
              <a href="<?php echo URLROOT ?>/pages/home">Home</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
                <li class="has-children">
                  <a href="#">Sub Menu</a>
                  <ul class="dropdown">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="has-children">
              <a href="<?php echo URLROOT ?>/pages/about">About</a>
              <ul class="dropdown">
                <li><a href="#">Menu One</a></li>
                <li><a href="#">Menu Two</a></li>
                <li><a href="#">Menu Three</a></li>
              </ul>
            </li>
            <li><a href="<?php echo URLROOT; ?>/shops/index">Shop</a></li>
            <li><a href="#">Catalogue</a></li>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="<?php echo URLROOT ?>/pages/contact">Contact</a></li>
          </ul>
        </div>
      </nav>
    </header>
    
    