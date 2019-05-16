<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row m-5">
        <div class="col-md-3 mb-5 order-1 mb-md-0">
            <div class="border p-4 rounded mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block text-center">Move To Shop Categories</h3>
                <ul class="list-unstyled mb-0">
		<li class="mb-1"><a class="category-btn d-flex category-link" id="fig" href="<?php echo URLROOT; ?>/web2/shops/index/category=fig" ><span><i class="fas fa-paw"></i>  Figure</span> <span class="ml-auto">(<?php echo $data['figCount']; ?>)</span></a></li>
                <li class="mb-1"><a class="category-btn d-flex category-link" id="plu" href="<?php echo URLROOT; ?>/shops/index/category=plu" ><span><i class="fas fa-cat"></i> Plush</span> <span class="ml-auto">(<?php echo $data['pluCount']; ?>)</span></a></li>
		<li class="mb-1"><a class="category-btn d-flex category-link" id="hat" href="<?php echo URLROOT; ?>/shops/index/category=hat" ><span><i class="fas fa-hat-wizard"></i> Hat</span> <span class="ml-auto">(<?php echo $data['hatCount']; ?>)</span></a></li>
		<li class="mb-1"><a class="category-btn d-flex category-link" id="shi" href="<?php echo URLROOT; ?>/shops/index/category=shi" ><span><i class="fas fa-tshirt"></i> Shirt</span> <span class="ml-auto">(<?php echo $data['shiCount']; ?>)</span></a></li>
                </ul>
            </div>
        </div>
        <div id="searchProductZone" class="col-md-9 order-2 mb-5 mb-md-0">
            <div id="searchAlert"></div>
            <div class="row mb-5" id="searchProductShow">
                <!-- AJAX SHOW PRODUCTS HERE -->
            </div>
            <div class="row aos-init aos-animate" data-aos="fade-up">
                <div class="col-md-12 text-center">
                    <div class="site-block-27" id="searchPaginationShow">
                    <!-- AJAX SHOW PAGINATION HERE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
