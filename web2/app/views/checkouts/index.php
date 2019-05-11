<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="site-wrap">

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
              
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="firstname_txt" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="firstName" name="firstname_txt" value="<?php echo $data['currentUser']['firstname']; ?>">
                  <div id="first-name-alert" style="color:red"></div>
                </div>
                <div class="col-md-6">
                  <label for="lastname_txt" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="lastName" name="lastname_txt" value="<?php echo $data['currentUser']['lastname']; ?>">
                  <div id="last-name-alert" style="color:red"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="email_txt" class="text-black">Email</label>
                  <input type="text" class="form-control" id="email" name="email_txt" readonly value="<?php echo $data['currentUser']['email']; ?>">
                  <div id="email-alert" style="color:red"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="address_txt" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="address" name="address_txt" placeholder="Address" value="<?php echo $data['currentUser']['address']; ?>">
                  <div id="address-alert" style="color:red"></div>
                </div>
              </div>

              <div class="form-group mb-5">
                <label for="phone_txt" class="text-black">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone_txt" placeholder="Phone Number" value="<?php echo $data['currentUser']['phone']; ?>">
                <div id="phone-alert" style="color:red"></div>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php foreach($data['currentUserCartProducts'] as $product) : ?>
                        <tr>
                          <td><?php echo $product['name']; ?> <strong class="mx-2">x</strong> <?php echo $product['quantity']; ?></td>
                          <td>$<?php echo (((int)$product['quantity']) * ((int)$product['price'])); ?></td>
                        </tr>   
                      <?php endforeach; ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>
                          <?php $totalPrice = 0; ?>
                          <?php foreach($data['currentUserCartProducts'] as $product) : ?>
                            <?php $totalPrice += (((int)$product['quantity']) * ((int)$product['price'])); ?>
                          <?php endforeach; ?>
                          <?php echo $totalPrice; ?>
                        </strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="form-group">
                    <a class="btn btn-primary btn-lg py-3 btn-block" href="<?php echo URLROOT; ?>/checkouts/payment" id="moveToPayment">Move to payment</a>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>