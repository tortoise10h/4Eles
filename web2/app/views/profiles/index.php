
<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="bg-light py-3">

        <div class="site-section">
        <div class="container">
            <div class="row mb-5">
            <div class="col-md-9 order-2">

                <div class="row mb-5">
                
            <!--MY PROFILE-->
            <div class="container" id="user_profile" >    
                <div class="panel-body">
                <form method="POST" action="<?php echo URLROOT ?>/profiles/updateUserInfo">
                            <div id="div_username" class="form-group required">
                                <div class="controls col-md-8 ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="username_txt" class="control-label requiredField">First name<span class="asteriskField">*</span> </label>
                                            <input class="input-md  textinput textInput form-control" id="firstname_txt" maxlength="30" name="first_name" placeholder="Your first name" style="margin-bottom: 10px" type="text" value="<?php echo $data['currentUser']['firstname'] ?>">  
                                            <div id="firstname-alertt" style="color:red"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="username_txt" class="control-label requiredField">Last name<span class="asteriskField">*</span> </label>
                                            <input class="input-md  textinput textInput form-control" id="lastname_txt" maxlength="30" name="last_name" placeholder="Your last name" style="margin-bottom: 10px" type="text" value="<?php echo $data['currentUser']['lastname'] ?>">  
                                            <div id="lastname-alert" style="color:red"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div id="div_email" class="form-group required">
                                <label for="email_txt" class="control-label col-md-4  requiredField"> E-mail<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md emailinput form-control" id="email_txt" name="user_email" placeholder="Your current email address" style="margin-bottom: 10px" type="email" value="<?php echo $data['currentUser']['email']; ?>" readonly>
                                </div>     
                            </div>
                            <div id="div_phonenum" class="form-group required">
                                <label for="phonenum_txt" class="control-label col-md-4  requiredField"> Phone number<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md emailinput form-control" id="phonenum_txt" name="user_phonenum" placeholder="Your current phone number" style="margin-bottom: 10px" type="text" value="<?php echo $data['currentUser']['phone']; ?>">
                                    <div id="phonenum-alert" style="color:red"></div>
                                </div>     
                            </div>
                            <div id="div_gender" class="form-group required">
                                <label for="gender"  class="control-label col-md-4  requiredField"> Gender<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 "  style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input type="radio" name="gender" id="user_gender_1" value="M"  style="margin: 10px" <?php if($data['currentUser']['sex'] == 1) : ?><?php echo "checked"; ?><?php endif; ?>>Male</label>
                                    <label class="radio-inline"> <input type="radio" name="gender" id="user_gender_2" value="F"  style="margin: 10px" <?php if($data['currentUser']['sex'] == 0) : ?><?php echo "checked"; ?><?php endif; ?>>Female </label>
                                </div>
                            </div>
                            <div id="div_birthday" class="form-group required">
                                <label for="" class="control-label col-md-4  requiredField"> Your Birthday (mm/dd/yyyy) </label>
                                <div class="controls col-md-8 ">
                                    <input style="margin-bottom: 10px" type="date" class="form-control" id="birthday_txt" name="birthday" value="<?php echo $data['currentUser']['birthday']; ?>">
                                    <div id="birthday-alert" style="color:red"></div>
                                </div> 
                            </div>
                            <div id="div_address" class="form-group required">
                                <label for="adress_txt" class="control-label col-md-4  requiredField"> Your Address<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md textinput textInput form-control" id="address_txt" name="address" placeholder="Your current address" style="margin-bottom: 10px" type="text" value="<?php echo $data['currentUser']['address']; ?>">
                                </div> 
                            </div>
                            
                            <div class="form-group"> 
                                <div class="aab controls col-md-4 "></div>
                                <div class="controls col-md-8 ">
                                    <input type="submit" name="Update_profile" value="Update" class="btn btn-primary btn btn-info" id="submit_profile" >
                                </div>
                            </div> 
     
                    </form>
                </div>
            </div>

            <div class="container" id="user_account" style="display:none">    
                <div id="account-result-alert"></div>
                <div class="panel-body">
                    <form method="post" action="<?php echo URLROOT; ?>/profiles/updateUserPassword">
                        
                            <div id="div_curr_passwrord" class="form-group required">
                                <label for="curr_password_txt" class="control-label col-md-4  requiredField">Current Password<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md  textinput textInput form-control" id="curr_password_txt" maxlength="30" name="curr_password" placeholder="Enter your current password" style="margin-bottom: 10px" type="password" />
                                    <div id="curr-password-alert" style="color:red"></div>
                                </div>
                            </div>
                            
                            <div id="div_new_passwrord" class="form-group required">
                                <label for="new_password_txt" class="control-label col-md-4  requiredField">New Password<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md  textinput textInput form-control" id="new_password_txt" maxlength="30" name="new_password" placeholder="Enter your new password" style="margin-bottom: 10px" type="password" />
                                    <div id="new-password-alert" style="color:red"></div>
                                </div>
                            </div>
                            <div id="div_repasswrord" class="form-group required">
                                <label for="repassword_txt" class="control-label col-md-4  requiredField">Re-enter New Password<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <input class="input-md  textinput textInput form-control" id="repassword_txt" maxlength="30" name="repassword" placeholder="Enter again your new password" style="margin-bottom: 10px" type="password" />
                                    <div id="repassword-alert" style="color:red"></div>
                                </div>
                            </div>
                            <div class="form-group"> 
                                <div class="aab controls col-md-4 "></div>
                                <div class="controls col-md-8 ">
                                    <input type="submit" name="Update_account" value="Update" class="btn btn-primary btn btn-info" id="submit_password" />
                                </div>
                            </div> 
                                
                    </form>
                </div>
            </div>
            <div class="container" id="user_order" style="display:none">    
                <div class="panel-body">
                <div class="container">          
                    <?php foreach($data['bills'] as $bill) : ?>
                        <div class="py-3 px-1 mb-5 shadow-sm" style="background:#fff;border-radius:5px">
                            <h3>Bill ID: <span style="font-weight:10" class="text-primary"><?php echo $bill['billID']; ?></span></h3>
                            <table class="table p-3">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th> 
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($bill['billDetails'] as $billDetail) : ?>
                                    <tr>
                                        <td><?php echo $billDetail['productName']; ?></td>
                                        <td><?php echo $billDetail['quantity']; ?></td>
                                        <td><?php echo $billDetail['totalPrice']; ?></td>
                                    </tr>
                                <?php endforeach; ?>     
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Purchase Date: <span id="pur_date" style="font-weight:10"><?php echo $bill['purchaseDate']; ?></span></th>
                                    <th>Status: <span id="status" style="font-weight:10"><?php echo $bill['processStatus']; ?></span></th> 
                                    <th>Total: <span id="totalPrice" style="font-weight:10">$<?php echo $bill['totalPrice']; ?></span></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
            <div class="container" id="user_wishlist" style="display:none">    
                <!-- LIKED PRODUCTS HERE -->
                thả tim
            </div>
            <div class="container" id="customer_service" style="display:none">    
                <div class="panel-body">    
                    <form method="post" action="">
                            <div id="div_help" class="form-group required">
                                <label for="help_txt" class="control-label col-md-4  requiredField">Tell us what's wrong<span class="asteriskField">*</span> </label>
                                <div class="controls col-md-8 ">
                                    <textarea rows="10" cols="20" class="input-md  textinput textInput form-control" id="help_txt" name="help_txt" placeholder="Enter your question" style="margin-bottom: 10px"></textarea>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <div class="aab controls col-md-4 "></div>
                                <div class="controls col-md-8 ">
                                    <input type="submit" name="submit_ques" value="Submit" class="btn btn-primary btn btn-info" id="submit_ques" />
                                </div>
                            </div>                                
                    </form>
                </div>
            </div>
            
                </div>
                
            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">MY PROFILE</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><a href="#user_profile" class="d-flex active" id="profile"><span>My Profile</span></a></li>
                        <li class="mb-1"><a href="#user_account" class="d-flex" id="account"><span>Change password</span></a></li>
                        <li class="mb-1"><a href="#user_order" class="d-flex" id="order"><span>My Orders</span></a></li>
                    </ul>
                </div>
            </div>
            </div> 
        </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>