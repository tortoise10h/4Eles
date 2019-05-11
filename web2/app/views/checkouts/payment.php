<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="bg-light py-3">

        <div class="site-section">
        <div class="container">
            <input type="hidden" id="userID" value="<?php echo $data['currentUser']['id'] ?>">
            <div class="row mb-5">

            <div class="col-md-12 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                <h3 class="mb-3 h4 d-block text-center">CHOOSE YOUR PAYMENT METHOD</h3>
                <ul class="list-unstyled mb-0 h5">
                    <li class="mb-1"><input type="radio" name="payment" value="cash" checked> Cash On Delivery ( COD )</li>
                    <div class="myDiv" id="payment_cash" style="">    
                        <div class="border p-4 rounded mb-6">
                            <div class="m-2"><i>You will pay for the package at the time of delivery.</i></div>
                            <a href="<?php echo URLROOT ?>/checkouts/thankyou" class="btn btn-primary ml-2" style="background:#17a2b8" id="CODOrder">Place Order</a>
                        </div>
                    </div>
                    <li class="mb-1"><input type="radio" name="payment" value="bank" > Bank Transfers</li>
                    <div class="myDiv" id="payment_bank" style="display:none">    
                        <div class="border p-4 rounded mb-4">
                            <form>
                                <div class="cc-selector h3">
                                    <input id="agribank" type="radio" name="bank" value="agribank" />
                                    <label class="drinkcard-cc agribank" for="agribank"></label>
                                    <input id="acb" type="radio" name="bank" value="acb" />
                                    <label class="drinkcard-cc acb" for="acb"></label>
                                    <input id="techcombank" type="radio" name="bank" value="techcombank" />
                                    <label class="drinkcard-cc techcombank" for="techcombank"></label>
                                    <input id="vietinbank" type="radio" name="bank" value="vietinbank" />
                                    <label class="drinkcard-cc vietinbank" for="vietinbank"></label>
                                    <input id="oceanbank" type="radio" name="bank" value="oceanbank" />
                                    <label class="drinkcard-cc oceanbank" for="oceanbank"></label>
                                    <a href="<?php echo URLROOT ?>/checkouts/thankyou" class="btn btn-primary ml-2" style="background:#17a2b8" id="BankOrder">Place Order</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <li class="mb-1"><input type="radio" name="payment" value="card" > Credit Cards</li>
                    <div class="myDiv" id="payment_card" style="display:none">    
                        <div class="border p-4 rounded mb-6">
                            <div class="container-fluid py-3">
                                <div class="row">
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8 mx-auto">
                                        <div id="pay-invoice" class="card">
                                            <div class="card-body">
                                                <form action="/echo" method="post" novalidate="novalidate" class="needs-validation">
                                                    <div class="form-group text-center">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><h1><i class="fab fa-cc-visa"></i></h1></li>
                                                            <li class="list-inline-item"><h1><i class="fab fa-cc-mastercard"></i></h1></li>
                                                            <li class="list-inline-item"><h1><i class="fab fa-cc-paypal"></i></h1></li>
                                                        </ul>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="cc-name" class="control-label mb-1">Name on card</label>
                                                        <input id="cc-name" name="cc-name" type="text" class="form-control cc-name" required autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                        <span class="invalid-feedback">Enter the name as shown on credit card</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cc-number" class="control-label mb-1">Card number</label>
                                                        <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified" required="" pattern="[0-9]{16}">
                                                        <span class="invalid-feedback">Enter a valid 16 digit card number</span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                                                <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" required placeholder="MM / YY" autocomplete="cc-exp">
                                                                <span class="invalid-feedback">Enter the expiration date</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="x_card_code" class="control-label mb-1">Security code</label>
                                                            <div class="input-group">
                                                                <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" required autocomplete="off">
                                                                <span class="invalid-feedback order-last">Enter the 3-digit code on back</span>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                    <span class="fa fa-question-circle fa-lg" data-toggle="popover" data-container="body" data-html="true" data-title="Security Code" 
                                                                    data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div></div>"
                                                                    data-trigger="hover"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="chiller_cb">
                                                        <input id="myCheckbox" type="checkbox" checked>
                                                        <label for="myCheckbox">Save my option</label>
                                                        <span></span>
                                                    </div>
                                                    <div style="margin-top:20px">
                                                        <button id="payment-button" class="btn btn-lg btn-info btn-block">
                                                            <span id="payment-button-amount">Place Order</span>
                                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
                </div>
            </div>
            </div>        
        </div>
        </div>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>