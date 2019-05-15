<?php
    //handle product description
    $descriptions = explode('%',$data['product']->description);
?>

<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="<?php echo URLROOT; ?>/pages/index">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black" id="productNamePath"><?php echo $data['product']->name; ?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7" id="productDetailImage">
                    <!--FOR IMAGE INFORMATION-->
                    <div class="product-gallery">
                        <div class="product-thumb">
                            <div>
                            <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink; ?>/<?php echo $data['product']->id; ?>_1.jpg" class="demo cursor" onclick="currentSlide(1)">
                            <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink; ?>/<?php echo $data['product']->id; ?>_2.jpg" class="demo cursor" onclick="currentSlide(2)">
                            <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink; ?>/<?php echo $data['product']->id; ?>_3.jpg" class="demo cursor" onclick="currentSlide(3)">
                            <?php if($data['categoryID'] != 'shi') : ?>
                                <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink; ?>/<?php echo $data['product']->id; ?>_4.jpg" class="demo cursor" onclick="currentSlide(4)">
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="product-image">
                            <div class="my-slides" style="display-block">
                                <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink;
                                ?>/<?php echo $data['product']->id; ?>_1.jpg">
                            </div>
                            <div class="my-slides" style="display-block">
                                <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink;
                                ?>/<?php echo $data['product']->id; ?>_2.jpg">
                            </div>
                            <div class="my-slides" style="display-block">
                                <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink;
                                ?>/<?php echo $data['product']->id; ?>_3.jpg">
                            </div>
                            <div class="my-slides" style="display-block">
                                <img src="<?php echo URLROOT; ?><?php echo $data['product']->imgLink;
                                ?>/<?php echo $data['product']->id; ?>_4.jpg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" id="productBasicInfo">
                    <div class="product-info"> 
                        <div class="product-title"> 
                            <h3><?php echo $data['product']->name; ?></h3>
                        </div>  
                        <hr> 
                        <div class="product-preview">
                            <!-- <small style="font-size:16px" class="text-primary"><span style="color:#8c92a0">Product id: </span><?php echo $data['product']->id; ?></small> -->
                            <ul> 
                                <?php for($i = 0; $i < count($descriptions) - 1; $i++): ?>
                                    <li><?php echo $descriptions[$i]; ?></li>
                                <?php endfor; ?>
                            </ul>
                        </div> 
                        <hr> 
                        <div class="product-price"> 
                            <p class="text-primary" style="font-size:30px"> $ <?php echo $data['product']->price; ?></p>
                        </div>  
                        <div class="mb-5">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                        </div>
                                        <input id="cartProductQuantity" type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <p><button id="addCartBtn" data="<?php echo $data['product']->id ?>" class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        var slideIndex = 1;
        showSlides(1);

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("my-slides");
            if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
            slides[slideIndex-1].style.display = "block";
        }
    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>