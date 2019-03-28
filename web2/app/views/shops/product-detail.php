<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black" id="productNamePath"></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7" id="productDetailImage">
                    <!--FOR IMAGE INFORMATION-->
                    <div class="product-gallery">
                        <div class="product-thumbnail">
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
                        <?php echo $data['product']->name; ?>
                    </div>  
                    <hr> 
                    <div class="product-preview">' 
                    </div> 
                    <hr> 
                    <div class="product-price">' 
                    </div>  
                        <form> 
                            <div class="quantity-selection"> 
                                Quantity: <input type="number" name="quantity" min="1" max="99" value="1">
                            </div>
                            <div class="buy-now-and-cart"> 
                                <div class="buy-now-button"> 
                                </div> 
                                <div class="add-to-cart"> 
                                </div> 
                            </div>
                        </form> 
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
        //alert(slideIndex);
        //alert(slides[0]);
        if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
        //alert(slides[slideIndex-1]);
        slides[slideIndex-1].style.display = "block";
        }
    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>