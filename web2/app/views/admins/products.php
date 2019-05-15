<?php require APPROOT . '/views/inc/admin-header.php'; ?>
            <!-- MAIN CONTENT-->
        <?php if($_SESSION['user_role'] == 9) : ?>    
            <div class="main-content" style="overflow-X:scroll">
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-20">
                                    <div class="row">
                                        <div class="table-data__tool-right col-md-2">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small my-1" id="addItemButton" data-toggle="modal" data-target="#addForm" onclick="addButtonClick()">
                                                <i class="zmdi zmdi-plus"></i>add item</button>
                                        </div>
                                        <div class="col-md-4  mt-2 ml-2">
                                            <div id="quickSearchChoices">
                                                <select style="font-size:14px;border:none;padding:10px 0" id="quickSearchChoicesBox" class="shadow-sm rounded"> 
                                                    <option value="0">Search ID</option>
                                                    <option value="1">Search name</option>
                                                    <option value="4">Search status</option>
                                                </select>
                                                <input style="padding:6px 2px" type="text" name="quick-search-box" id="quickSearchBox" class="shadow-sm rounded" placeholder="Type here to search">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2 ml-2">
                                            <div>
                                                <input style="font-size:12px;padding:9px 0;max-width:100px" type="number" name="from-price-box" id="fromPriceBox" class="rounded shadow-sm" placeholder="From price"> <small>_</small>
                                                <input style="font-size:12px;padding:9px 0;max-width:100px" type="number" name="to-price-box" id="toPriceBox" class="rounded shadow-sm" placeholder="To price">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 ml-2">
                                            <select style="font-size:14px;border:none;padding:10px 0" id="sortChoicesBox" class="shadow-sm rounded"> 
                                                    <option value="none">None</option>
                                                    <option value="nameAtoZ">Name, A to Z</option>
                                                    <option value="nameZtoA">Name, Z to A</option>
                                                    <option value="priceLowToHigh">Price, Low to High</option>
                                                    <option value="priceHighToLow">Price, High to Low</option>
                                            </select>
                                    </div>   
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning" style="font-size:13px">
                                        <thead>
                                            <tr>
                                                <th style="font-size:14px"></th>
                                                <th style="font-size:14px">ID</th>
                                                <th style="font-size:14px">NAME</th>
                                                <th style="font-size:14px">TOTAL</th>
                                                <th style="font-size:14px;max-width:50px">PRICE</th>
                                                <th style="font-size:14px">STATUS</th>
                                                <th style="font-size:14px">OPERATION</th>
                                            </tr>
                                        </thead>
                                        <tbody CLASS="text-center" id="productTableBody">
                                            <!-- TABLE OF PRODUCT SHOW HERE -->
                                            
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
        <!-- EDIT PRODUCT FORM -->
        <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="editFormTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFormTitle">Edit Product Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="login-form">
                            <div id="login-general-alert" class="text-left"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="float-left" for="product-id">ID *</label>
                                        <input type="text" name="product-id" id="productID" class="form-control" readonly>
                                        <div class="text-left text-danger" id="productIDErr"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="float-left" for="product-name">Name *</label>
                                        <input type="text" id="productName" name="product-name" class="form-control">
                                        <div class="text-left text-danger" id="productNameErr"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="float-left" for="product-name">Category *</label>
                                        <input type="hidden" id="productCategoryHidden" value="">
                                        <select class="form-control" name="product-category" id="productCategory">
                                            
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="float-left" for="product-price">Price *</label>
                                        <input type="number" name="product-price" id="productPrice" class="form-control">
                                        <div class="text-left text-danger" id="productPriceErr"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="float-left" for="product-total">Total *</label>
                                        <input type="number" id="productTotal" name="product-total" class="form-control">
                                        <div class="text-left text-danger" id="productTotalErr"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="float-left" for="product-color">Color *</label>
                                        <input type="text" id="productColor" name="product-color" class="form-control">
                                        <div class="text-left text-danger" id="productColorErr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="product-description">Description *<small>(each line of product description end with -- symbol)</small></label>
                                <textarea id="productDescription" name="product-description" cols="30" rows="5" class="form-control"></textarea>
                                <div class="text-left text-danger" id="productDescriptionErr"></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control bg-white" id="productFile" type="file" name="file">
                                <div class="text-left text-danger" id="productFileErr"></div>
                            </div>
                            <input type="submit" id="editSubmit" class="btn btn-primary"  name="edit-product" value="Edit Product">
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- END EDIT PRODUCT FORM -->


        <!--ADD PRODUCT FORM -->
        <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="addFormTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFormTitle">Add Product Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="addProductForm">
                            <div id="addProductAlert" class="text-left"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <label class="float-left col-md-12">ID *</label>
                                            <div class="col-sm-5" style="margin:0">
                                                <input type="text" name="new-product-pre-id" id="newProductPreID" class="form-control" value="fig" readonly>
                                            </div>
                                            <div class="col-sm-7" style="margin:0">
                                                <input type="number" name="new-product-id" id="newProductID" class="form-control px-3">
                                                <div class="text-left text-danger" id="newProductIDErr"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="float-left" for="new-product-name">Name *</label>
                                        <input type="text" id="newProductName" name="new-product-name" class="form-control">
                                        <div class="text-left text-danger" id="newProductNameErr"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="float-left" for="new-product-category">Category *</label>
                                        <input type="hidden" id="newProductCategoryHidden" value="fig">
                                        <select class="form-control" name="new-product-category" id="newProductCategory">
                                            
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="float-left" for="new-product-price">Price *</label>
                                        <input type="number" name="new-product-price" id="newProductPrice" class="form-control">
                                        <div class="text-left text-danger" id="newProductPriceErr"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="float-left" for="new-product-total">Total *</label>
                                        <input type="number" id="newProductTotal" name="new-product-total" class="form-control">
                                        <div class="text-left text-danger" id="newProductTotalErr"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="float-left" for="new-product-color">Color *</label>
                                        <input type="text" id="newProductColor" name="new-product-color" class="form-control">
                                        <div class="text-left text-danger" id="newProductColorErr"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="float-left" for="new-product-description">Description *<small>(each line of product description end with -- symbol)</small></label>
                                <textarea id="newProductDescription" name="new-product-description" cols="30" rows="5" class="form-control"></textarea>
                                <div class="text-left text-danger" id="newProductDescriptionErr"></div>
                            </div>
                            <div class="form-group">
                                <input class="form-control bg-white" id="newProductFile" type="file" name="new-product-file">
                                <div class="text-left text-danger" id="newProductFileErr"></div>
                            </div>
                            <input type="submit" id="addSubmit" class="btn btn-primary"  name="new-product" value="Add New Product">
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- END ADD PRODUCT FORM -->
    </div>
    <?php elseif($_SESSION['user_role'] == 99): ?>
        <script type="text/javascript">window.location.href = URLROOT + '/admins/users'</script>
    <?php else : ?>
        <script type="text/javascript">window.location.href = URLROOT + '/pages/index'</script>
    <?php endif; ?>
<?php require APPROOT . '/views/inc/admin-footer.php'; ?>