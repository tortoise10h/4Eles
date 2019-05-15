<?php require APPROOT . '/views/inc/admin-header.php'; ?>
            <!-- MAIN CONTENT-->
            <?php if($_SESSION['user_role'] == 9) : ?>    
            <div class="main-content" style="overflow-X:scroll">
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div class="my-2">
                            <select class="p-2 rounded " id="orderSort" style="border:none">
                                <option value="none">None</option>
                                <option value="dateOldToNew">From Old date to New date</option>
                                <option value="dateNewToOld">From New date to Old date</option>
                                <option value="priceLowToHigh">Price, Low to High</option>
                                <option value="priceHighToLow">Price, High to Low</option>
                                
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 my-2">
                                <div id="quickSearchChoices">
                                    <select style="font-size:14px;border:none;padding:10px 0" id="orderQuickSearchChoices" class="shadow-sm rounded"> 
                                        <option value="1">Search ID</option>
                                        <option value="4">Search status</option>
                                        <option value="6">Search email</option>
                                    </select>
                                    <input style="padding:6px 2px;max-width:150px" type="text" name="order-quick-search" id="orderQuickSearch" class="shadow-sm rounded" placeholder="Type here to search">
                                </div>
                            </div>
                            <div class="col-sm-4 my-2">
                                <div>
                                    <input style="font-size:12px;padding:9px 3px;max-width:100px" type="number" name="order-from-price-box" id="orderFromPriceBox" class="rounded shadow-sm" placeholder="From price"> <span class="mx-2">~</span>
                                    <input style="font-size:12px;padding:9px 3px;max-width:100px" type="number" name="order-to-price-box" id="orderToPriceBox" class="rounded shadow-sm" placeholder="To price">
                                </div>
                            </div>
                            <div class="col-sm-4 my-2">
                                <div>
                                    <input type="date" name="from-date" id="fromDate" style="font-size:12px;padding:9px 0px" class="rounded shadow-sm">
                                    <span class="mx-2">~</span>
                                    <input type="date" name="to-date" id="toDate" style="font-size:12px;padding:9px 0px" class="rounded shadow-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-20">
                                    
                                    <div class="table-responsive table--no-card m-b-30">
                                            <table class="table table-borderless table-striped table-earning" style="font-size:13px">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size:14px;max-width:30px"></th>
                                                        <th style="font-size:14px">ORDER ID</th>
                                                        <th style="font-size:14px;max-width:50px">PRICE</th>
                                                        <th style="font-size:14px">DATE</th>
                                                        <th style="font-size:14px">STATUS</th>
                                                        <th style="font-size:14px">OPERATION</th>
                                                        <th style="font-size:14px">CUSTOMER</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center" id="orderTableBody">
                                                    <!-- ORDER TABLE SHOW HERE -->
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

        <!-- ORDER INFO DIALOG -->
        <div class="modal fade" id="orderInfo" tabindex="-1" role="dialog" aria-labelledby="orderInfoTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderInfoTitle">ORDER INFORMATION<span></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <table class="table p-3">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th> 
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billDetailTableBody">
                                        <!-- body of bill detail table -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total: </th> 
                                            <th>$<span id="billDetailTotalPrice"></span></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-3" style="line-height:1.5">
                                <h4>Customer Information</h4>
                                <hr>
                                <p><strong>Customer name: </strong> <span id="customerName"></span></p><br>
                                <p><strong>Email: </strong> <span id="customerEmail"></span></p><br>
                                <p><strong>Address: </strong><span id="customerAddress"></span></p><br>
                                <p><strong>Phone number: </strong><span id="customerPhone"></span></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- END ORDER INFO DIALOG -->

    </div>
    <?php elseif($_SESSION['user_role'] == 99): ?>
        <script type="text/javascript">window.location.href = URLROOT + '/admins/users'</script>
    <?php else : ?>
        <script type="text/javascript">window.location.href = URLROOT + '/pages/index'</script>
    <?php endif; ?>

<?php require APPROOT . '/views/inc/admin-footer.php'; ?>