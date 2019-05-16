<?php require APPROOT . '/views/inc/admin-header.php'; ?>
            <!-- MAIN CONTENT-->
            <?php if($_SESSION['user_role'] == 99) : ?>
            <div class="main-content" style="overflow-X:scroll">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-3 my-2">
                                <button data-toggle="modal" data-target="#accountDialog" id="addAccount" class="btn btn-primary">Add new account</button>
                            </div>
                            <div class="col-sm-5 my-2">
                                <div id="quickSearchChoices">
                                    <select style="font-size:14px;border:none;padding:10px 0" id="userQuickSearchChoices" class="shadow-sm rounded"> 
                                        <option value="0">Search ID</option>
                                        <option value="1">Search full name</option>
                                        <option value="2">Search email</option>
                                        <option value="3">Search phone</option>
                                        <option value="4">Search sex</option>
                                        <option value="5">Search status</option>
                                    </select>
                                    <input style="padding:6px 2px;max-width:150px" type="text" name="user-quick-search" id="userQuickSearch" class="shadow-sm rounded" placeholder="Type here to search">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-20">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning" style="font-size:13px">
                                        <thead>
                                            <tr>
                                                <th style="font-size:14px;max-width:50px">ID</th>
                                                <th style="font-size:14px">FULLNAME</th>
                                                <th style="font-size:14px">EMAIL</th>
                                                <th style="font-size:14px">PHONE</th>
                                                <th style="font-size:14px">SEX</th>
                                                <th style="font-size:14px;max-width:20px">STATUS</th>
                                                <th style="font-size:14px">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody CLASS="text-center" id="userTableBody">
                                            <!-- USER TABLE SHOW HERE -->
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

        <!-- USER ACTION DIALOG -->

        <div class="modal fade" id="userAction" tabindex="-1" role="dialog" aria-labelledby="userActionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userActionTitle">User Action Box<span></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label><strong>Reset Password</strong></label>
                                <div id="userResetPassBtn">
                                    
                                </div>    
                            </div>
                            <div class="col-md-4">
                                <label><strong>Role</strong></label>
                                <div id="userRoleOption">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label><strong>Block User</strong></label>
                                <div id="userBlock">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- END USER ACTIONDIALOG -->


        <!-- CREATE USER DIALOG -->
        <div class="modal fade" id="accountDialog" tabindex="-1" role="dialog" aria-labelledby="accountDialogTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountDialogTitle">Create new account<span></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><strong>User email</strong></label>
                            <input type="text" name="email" id="newAccountEmail" class="form-control">
                            <div id="newAccountEmailAlert" style="color:red"></div>
                        </div>
                        <div class="form-group">
                            <label><strong>User role</strong></label>
                            <select id="newAccountRole" class="form-control">
                                <option value="1">User</option>
                                <option value="9">Manager</option>
                                <option value="99">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="addNewAccountBtn" class="btn btn-primary">Create new account</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- END CREATE USER DIALOG -->

    </div>
    <?php elseif($_SESSION['user_role'] == 9): ?>
        <script type="text/javascript">window.location.href = URLROOT + '/admins/products'</script>
    <?php else : ?>
        <script type="text/javascript">window.location.href = URLROOT + '/pages/index'</script>
    <?php endif; ?>
<?php require APPROOT . '/views/inc/admin-footer.php'; ?>
