$(document).ready(function(){
    //CHECK LINK AND AUTOMATIC LOAD PRODUCT EVERY FIRST COME TO PAGE OR PAGE RELOAD BASE ON URL
    if(window.location.href.split('/')[4] == 'shops') //if this is shops page then
    {
        console.log("Shops");
        let params = checkCategoryUrl();
        console.log(params);

        if(params[2] != ''){
            console.log(params[0] + "---" + params[1] + "---" + params[2]);
            loadSearchProducts(params[0],params[1],params[2]);
        }else{
            loadProducts(params[0],params[1]);
        }



        //CLICK TO CATEGORY ON LEFT-SIDE AND LOAD PRODUCT BY CATEGORY
        $(document).on('click','.category-link',function(){
            let subLink = $(this).attr('data');
            window.history.pushState('','',subLink);    //change url but not refresh page
            let params = checkCategoryUrl();
            loadProducts(params[0],params[1]);
        });

        //FOR LOAD PRODUCT BY CATEGORY
        function loadProducts(categoryID = '', page = 1){
            let categoryKey;
            //if nothing in categoryID that's mean that is index page and we load all products; for first come to page
            if(categoryID == ''){
                categoryKey = 'all';
            }else{
                categoryKey = categoryID;
            }
            $.ajax({
                url: 'http://localhost:8080/web2/shops/showProducts/' + categoryKey + '/' + page,
                type: 'POST',
                cache: false,
                // data: {page:page}, 
                success:function(data){
                    let result = $.parseJSON(data);
                    //get products and pagination to show
                    let productsShow = createProductShow(result.products);
                    let paginationShow = createPaginationShow(result.totalPages,result.pageActive,result.categoryID);
                    $('#productShow').html(productsShow);
                    $('#paginationShow').html(paginationShow);
                }
            });
        }

        //AJAX FOR PAGINATION BUTTON
        $(document).on('click','.pagination-btn', function(){
            let paginationBtnLink = $(this).attr('data');
            window.history.pushState('','',paginationBtnLink);
            let params = checkCategoryUrl();
            console.log(params);
            loadProducts(params[0],params[1]);
            window.scroll({
                top: 250, 
                left: 0, 
                behavior: 'smooth'
            });
        });

        //FOR SEARCH BY PRICE
        $('#searchByPrice').on('click', function(){
            let urlParams = checkCategoryUrl();
            let fromPrice = $('#fromPrice').val() ? $('#fromPrice').val() : "@none@";
            let toPrice = $('#toPrice').val() ? $('#toPrice').val() : "@none@";
            let priceString = fromPrice + "--" + toPrice;
            console.log(priceString);
            let subLink = "http://localhost:8080/web2/shops/loadSearchProducts/category=" + urlParams[0] + "/page=" + urlParams[1] + "/price=" + priceString;
            window.history.pushState('','',subLink);
            // urlParams = checkCategoryUrl();
            // loadSearchProducts(urlParams[0],1,urlParams[2]);
            // console.log("result of shop search in js: " + $('#shopSearch').val());


        });

        //AJAX FOR TYPE TO SEARCH
        $('#shopSearch').on('keyup',function(){
            let urlParams = checkCategoryUrl();
            let categoryID = urlParams[0];
            let page = urlParams[1];
            let searchValue = $('#shopSearch').val();
            // let subLink = "http://localhost:8080/web2/shops/loadSearchProducts/category=" + categoryID + "/page=" + page + "/search=" + searchValue;
            let subLink = "http://localhost:8080/web2/shops/loadSearchProducts/category=" + categoryID + "/page=" + page + "/search=" + searchValue;
            window.history.pushState('','',subLink);
            urlParams = checkCategoryUrl();
            loadSearchProducts(urlParams[0],1,urlParams[2]);
            console.log("result of shop search in js: " + $('#shopSearch').val());
        });


        //AJAX FOR PAGINATION SEARCH BUTTON
        $(document).on('click','.pagination-search-btn', function(){
            let paginationBtnLink = $(this).attr('data');
            console.log("pagination search button: " + paginationBtnLink);
            window.history.pushState('','',paginationBtnLink);
            let params = checkCategoryUrl();
            loadSearchProducts(params[0],params[1],params[2]);
            window.scroll({
                top: 250, 
                left: 0, 
                behavior: 'smooth'
            });
        });

        //LOAD SEARCH PRODUCT
        function loadSearchProducts(categoryID = '', page = 1, searchVal = ''){
            let categoryKey;
            let searchValue;
            
            //replace %20 because when send to php it isn't recognize 
            searchVal = searchVal.replace(/%20/g,'--');
            console.log('searchVal in loadSearchProduct' + searchVal);

            //if nothing in categoryID that's mean that is index page and we load all products; for first come to page
            if(categoryID == ''){
                categoryKey = 'all';
            }else{
                categoryKey = categoryID;
            }

            if(searchVal == ''){
                searchValue = 'search-all';
            }else{
                searchValue = searchVal;
            }
            console.log("searchValue after parse" + searchValue);
            $.ajax({
                url: 'http://localhost:8080/web2/shops/showSearchProducts/' + categoryKey + '/' + page + '/' + searchValue,
                type: 'POST',
                cache: false,
                // data: {page:page}, 
                success:function(data){
                    // console.log(data);

                    let result = $.parseJSON(data);
                    let productsShow = createProductShow(result.products);
                    let paginationShow = createPaginationSearchShow(result.totalPages,result.pageActive,result.categoryID,searchValue);
                    $('#productShow').html(productsShow);
                    $('#paginationShow').html(paginationShow);
                    console.log('Total Page in Shop seach: ' + result.totalPages);
                }
            });
        }

        

        function createProductShow(products){
            let text = '';
            $.each(products,function(tag,product){
                text += '<div class="img-card col-sm-6 col-lg-4 mb-4" data-aos="fade-up">' +
                            '<div class="block-4 text-center border">' +
                            '<figure class="block-4-image">' + 
                                '<a href="http://localhost:8080/web2/shops/productDetail/' + product.categoryID + '/' + product.id +'"><img src="http://localhost:8080/web2' + product.imgLink + '/' + product.id + '_1.jpg"' + 'class="img-fluid"></a>' +
                            '</figure>' +
                            '<div class="img-card-name block-4-text p-4">' +
                                '<h3><a href="http://localhost:8080/web2/shops/productDetail/' + product.categoryID + '/' + product.id +'">'+ product.name + '</a></h3>' +
                            '</div>'+
                            '<div class="img-card-price block-4-text p-4">' +
                                '<p class="text-primary font-weight-bold">$'+ product.price +'</p>' +
                            '</div>' +
                            '</div>' +
                        '</div>';    
            });
            return text;
        }
        function createPaginationShow(totalPages,pageActive,categoryID){
            let active = parseInt(pageActive);
            let text = '<ul><li><button data="http://localhost:8080/web2/shops/index/category=' + categoryID + "/page=" + (active - 1) + '" class="pagination-btn" id="' + (active - 1) + '">&lt;</button></li>';  //button pre
        
            for(let i = 1; i <= totalPages; i++){
                if(pageActive == i){
                    text += '<li><button data="http://localhost:8080/web2/shops/index/category=' + categoryID + '/page=' + i + '" class="pagination-btn pagination-active" id="'+ i +'">'+ i + '</button></li>';
                }else{
                    text += '<li><button data="http://localhost:8080/web2/shops/index/category=' + categoryID + '/page=' + i + '" class="pagination-btn" id="'+ i +'">'+ i + '</button></li>';
                }
            }
            text += '<li><button data="http://localhost:8080/web2/shops/index/category=' + categoryID + "/page=" + (active + 1) + '" class="pagination-btn" id="' + (active + 1) + '">&gt;</button></li></ul>'; //button next
            return text;
        }

        function createPaginationSearchShow(totalPages,pageActive,categoryID,searchVal){
            let active = parseInt(pageActive);
            let text = '<ul><li><button data="http://localhost:8080/web2/shops/loadSearchProducts/category=' + categoryID + "/page=" + (active - 1) + "/search=" + searchVal + '" class="pagination-search-btn" id="' + (active - 1) + '">&lt;</button></li>';  //button pre
        
            for(let i = 1; i <= totalPages; i++){
                if(pageActive == i){
                    text += '<li><button data="http://localhost:8080/web2/shops/loadSearchProducts/category=' + categoryID + "/page=" + i + "/search=" + searchVal + '" class="pagination-search-btn pagination-active" id="'+ i +'">'+ i + '</button></li>';
                }else{
                    text += '<li><button data="http://localhost:8080/web2/shops/loadSearchProducts/category=' + categoryID + "/page=" + i + "/search=" + searchVal + '" class="pagination-search-btn" id="'+ i +'">'+ i + '</button></li>';
                }
            }
            text += '<li><button data="http://localhost:8080/web2/shops/loadSearchProductss/category=' + categoryID + "/page=" + (active + 1) + "/search=" + searchVal + '" class="pagination-search-btn" id="' + (active + 1) + '">&gt;</button></li></ul>'; //button next
            return text;
        }
    }

    
    
});


function checkCategoryUrl(){
    let currentLink = window.location.href;
    let arrayLink = currentLink.split('/');     //divide url by / into each element
    let result = [];

    //loop arrayLink to find categoryID and page
    let page;
    let categoryID;
    let searchValue;
    let price;
    let color;

    for(let i = 0; i < arrayLink.length; i++){
        if(arrayLink[i].indexOf("category=") > -1){
            categoryID = arrayLink[i].split('=')[1];
        }
        if(arrayLink[i].indexOf("page=") > -1){
            page = arrayLink[i].split('=')[1];
        }
        if(arrayLink[i].indexOf("search=") > -1){
            searchValue = arrayLink[i].split('=')[1];
        }
        if(arrayLink[i].indexOf("price=") > -1){
            price = arrayLink[i].split('=')[1];
        }
        if(arrayLink[i].indexOf("color=") > -1){
            color = arrayLink[i].split('=')[1];
        }
    }

    if(categoryID === undefined){
        //that mean there is no category is selected => set categoryID to default 
        result.push('');
    }else{
        result.push(categoryID);
    }

    if(page === undefined){
        //that mean there is no page is selected => set page to default 
        result.push(1);
    }else{
        result.push(page);
    }

    if(searchValue === undefined){
        //that mean there is no page is selected => set search to ''
        result.push('');
    }else{
        result.push(searchValue);
    }

    if(price === undefined){
        result.push('');
    }else{
        result.push(price);
    }

    if(color === undefined){
        result.push('');
    }else{
        result.push(color);
    }

    return result;  //result[0] => categoryID , result[1] => page
                    //result[2] => searchValue , result[3] => price
                    //result[4] => color
}