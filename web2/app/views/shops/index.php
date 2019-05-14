<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo URLROOT; ?>/pages/index">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                    
                  </div>
                  <div class="btn-group">
                    <select name="reference-box" id="referenceBox" style="border-radius:3px;padding:6px 8px">
                      <option value="none">Reference</option>
                      <option value="nameAtoZ">Name, A to Z</option>
                      <option value="nameZtoA">Name, Z to A</option>
                      <option value="priceLowToHigh">Price, Low to High</option>
                      <option value="priceHighToLow">Price, High to Low</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-5" id="productShow">
            <!-- AJAX SHOW PRODUCTS HERE -->
            </div>
            <div class="row aos-init aos-animate" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27" id="paginationShow">
                  <!-- AJAX SHOW PAGINATION HERE -->
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
              <ul class="list-unstyled mb-0">
                <li class="mb-1"><button class="category-btn d-flex category-link" id="fig" data="<?php echo URLROOT; ?>/shops/index/category=fig"><span><i class="fas fa-paw"></i>  Figure</span> <span class="ml-auto">(<?php echo $data['figCount']; ?>)</span></button></li>
                <li class="mb-1"><button class="category-btn d-flex category-link" id="plu" data="<?php echo URLROOT; ?>/shops/index/category=plu"><span><i class="fas fa-cat"></i> Plush</span> <span class="ml-auto">(<?php echo $data['pluCount']; ?>)</span></button></li>
                <li class="mb-1"><button class="category-btn d-flex category-link" id="hat" data="<?php echo URLROOT; ?>/shops/index/category=hat"><span><i class="fas fa-hat-wizard"></i> Hat</span> <span class="ml-auto">(<?php echo $data['hatCount']; ?>)</span></button></li>
                <li class="mb-1"><button class="category-btn d-flex category-link" id="shi" data="<?php echo URLROOT; ?>/shops/index/category=shi"><span><i class="fas fa-tshirt"></i> Shirt</span> <span class="ml-auto">(<?php echo $data['shiCount']; ?>)</span></button></li>
              </ul>
            </div>

            <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <!-- <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" /> -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="number" name="from-price" placeholder="From Price" id="fromPrice" class="form-control mb-2" style="min-width:50px">  
                    </div>
                  
                    <div class="col-md-12">
                      <input type="number" name="to-price" placeholder="To Price" id="toPrice" class="form-control" style="min-width:50px">
                    </div>
                  </div>
                </div> 

                <button id="searchByPrice" class="btn btn-primary" style="width:100%">Search</button>
              </div>
              
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Name</h3>
                <div class="form-group">
                  <form action="">
                    <input id="shopSearch" type="text" name="search-in-shop" placeholder="Type to search" class="form-control">
                  </form>
                </div>
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter By Color</h3>
                <select class="select-box" id="colorSelectBox" style="width:100%">
                  <option value="none">Choose color</option>
                  <option value="red">Red</option>
                  <option value="blue">Blue</option>
                  <option value="green">Green</option>
                  <option value="yellow">Yellow</option>
                  <option value="pink">Pink</option>
                  <option value="orange">Orange</option>
                  <option value="white">White</option>
                  <option value="brown">Brown</option>
                  <option value="grey">Grey</option>
                  <option value="black">Black</option>
                  <option value="purple">Purple</option>
                </select>               
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>Categories</h2>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="<?php echo URLROOT;?>/shops/index/category=fig">
                      <figure class="image">
                        <img src="<?php echo URLROOT;?>/images/banner/figure-banner.jpg" alt="" class="category-banner-img img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Figures</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                    <a class="block-2-item" href="<?php echo URLROOT;?>/shops/index/category=plu">
                      <figure class="image">
                        <img src="<?php echo URLROOT;?>/images/banner/plush-banner.jpg" alt="" class="category-banner-img img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Plushes</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="<?php echo URLROOT;?>/shops/index/category=hat">
                      <figure class="image">
                        <img src="<?php echo URLROOT;?>/images/banner/hat-banner.jpg" alt="" class="category-banner-img img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Hats</h3>
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                    <a class="block-2-item" href="<?php echo URLROOT;?>/shops/index/category=shi">
                      <figure class="image">
                        <img src="<?php echo URLROOT;?>/images/banner/shirt-banner.jpg" alt="" class="category-banner-img img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Collections</span>
                        <h3>Shirts</h3>
                      </div>
                    </a>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>