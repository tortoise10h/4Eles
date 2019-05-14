$(document).ready(function(){
    //CHECK LINK AND AUTOMATIC LOAD PRODUCT EVERY FIRST COME TO PAGE OR PAGE RELOAD BASE ON URL
    if(window.location.href.split('/')[4] == 'shops') //if this is shops page then
    {
        console.log("Shops");
        let params = checkCategoryUrl();
        console.log(params);

        if(params[2] != '' || params[3] != '' || params[4] != ''){
            loadSearchProducts(params[0],params[1],params[2],params[3],params[4],params[5]);
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
                url: URLROOT + '/shops/showProducts/' + categoryKey + '/' + page,
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
            let subLink = URLROOT + "/shops/loadSearchProducts/category=" + urlParams[0] + "/page=" + urlParams[1] + "/price=" + priceString + "/color=" + urlParams[3] + "/search=" + urlParams[4] + "/sort=" + urlParams[5];
            window.history.pushState('','',subLink);
            urlParams = checkCategoryUrl();
            loadSearchProducts(urlParams[0],1,urlParams[2],urlParams[3],urlParams[4],urlParams[5]);
            // console.log("result of shop search in js: " + $('#shopSearch').val());
            

        });


        //COLOR SELECT BOX
        $('#colorSelectBox').on('change',function(){
            let urlParams = checkCategoryUrl();
            let colorValue = $('#colorSelectBox').val();
            $('#colorSelectBox').css({border:'2px solid ' + colorValue});
            let subLink = URLROOT + "/shops/loadSearchProducts/category=" + urlParams[0] + "/page=" + urlParams[1] + "/price=" + urlParams[2] + "/color=" + colorValue + "/search=" + urlParams[4] + "/sort=" + urlParams[5];
            window.history.pushState('','',subLink);
            urlParams = checkCategoryUrl();
            console.log(urlParams);
            loadSearchProducts(urlParams[0],1,urlParams[2],urlParams[3],urlParams[4],urlParams[5]);
        });


        //AJAX FOR TYPE TO SEARCH
        $('#shopSearch').on('keyup',function(){
            let urlParams = checkCategoryUrl();
            let categoryID = urlParams[0];
            let page = urlParams[1];
            let searchValue = $('#shopSearch').val();
            // let subLink = "http://localhost:8080/web2/shops/loadSearchProducts/category=" + categoryID + "/page=" + page + "/search=" + searchValue;
            let subLink = URLROOT + "/shops/loadSearchProducts/category=" + urlParams[0] + "/page=" + urlParams[1] + "/price=" + urlParams[2] + "/color=" + urlParams[3] + "/search=" + searchValue + "/sort=" + urlParams[5];
            window.history.pushState('','',subLink);
            urlParams = checkCategoryUrl();
            loadSearchProducts(urlParams[0],1,urlParams[2],urlParams[3],urlParams[4],urlParams[5]);
            // loadSearchProducts(urlParams[0],1,urlParams[2]);
            // console.log("result of shop search in js: " + $('#shopSearch').val());
        });


        //AJAX FOR PAGINATION SEARCH BUTTON
        $(document).on('click','.pagination-search-btn', function(){
            let paginationBtnLink = $(this).attr('data');
            console.log("pagination search button: " + paginationBtnLink);
            window.history.pushState('','',paginationBtnLink);
            let params = checkCategoryUrl();
            loadSearchProducts(params[0],params[1],params[2],params[3],params[4],params[5]);
            window.scroll({
                top: 250, 
                left: 0, 
                behavior: 'smooth'
            });
        });

        //REFERENCE SELECT BOX
        $('#referenceBox').on('change',function(){
            let urlParams = checkCategoryUrl();
            // alert('Refe check');
            let refeValue = $('#referenceBox').val();
            let subLink = URLROOT + "/shops/loadSearchProducts/category=" + urlParams[0] + "/page=" + urlParams[1] + "/price=" + urlParams[2] + "/color=" + urlParams[3] + "/search=" + urlParams[4] + "/sort=" + refeValue;
            window.history.pushState('','',subLink);
            urlParams = checkCategoryUrl();
            // console.log("refe in refe event catch: " + urlParams[5]);
            console.log(urlParams);
            loadSearchProducts(urlParams[0],1,urlParams[2],urlParams[3],urlParams[4],urlParams[5]);
        });

        //LOAD SEARCH PRODUCT
        function loadSearchProducts(categoryID = '', page = 1, price='', color='', searchVal = '',sort=''){
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
            console.log(categoryKey + " " + page + " " + price + " " + color + " " + searchVal + " " + sort);
            $.ajax({
                url: URLROOT + '/shops/showSearchProducts/' + categoryKey + '/' + page + '/' + searchValue + '/' + price + '/' + color + '/' + sort,
                type: 'POST', 
                cache: false,
                // data: {page:page}, 
                success:function(data){
                    // console.log(data);

                    let result = $.parseJSON(data);
                    let productsShow = createProductShow(result.products);
                    let paginationShow = createPaginationSearchShow(result.totalPages,result.pageActive,result.categoryID,searchValue,price,color,sort);
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
                                '<a href="' + URLROOT + '/shops/productDetail/' + product.categoryID + '/' + product.id +'"><img src="' + URLROOT + product.imgLink + '/' + product.id + '_1.jpg"' + 'class="img-fluid"></a>' +
                            '</figure>' +
                            '<div class="img-card-name block-4-text p-4">' +
                                '<h3><a href="' + URLROOT + '/shops/productDetail/' + product.categoryID + '/' + product.id +'" style="word-wrap: break-word;max-width:200px">'+ product.name + '</a></h3>' +
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

            let nextPageNumber;
            let prePageNumber;

            if(active == totalPages){
                nextPageNumber = 1;
            }else{
                nextPageNumber = active + 1;
            }

            if(active == 1  ){
                prePageNumber = totalPages;
            }else{
                prePageNumber = active - 1;
            }

            let text = '<ul><li><button data="' + URLROOT + '/shops/index/category=' + categoryID + "/page=" + prePageNumber + '" class="pagination-btn" id="' + prePageNumber + '">&lt;</button></li>';  //button pre
        
            for(let i = 1; i <= totalPages; i++){
                if(pageActive == i){
                    text += '<li><button data="' + URLROOT + '/shops/index/category=' + categoryID + '/page=' + i + '" class="pagination-btn pagination-active" id="'+ i +'">'+ i + '</button></li>';
                }else{
                    text += '<li><button data="' + URLROOT + '/shops/index/category=' + categoryID + '/page=' + i + '" class="pagination-btn" id="'+ i +'">'+ i + '</button></li>';
                }
            }
            text += '<li><button data="' + URLROOT + '/shops/index/category=' + categoryID + "/page=" + nextPageNumber + '" class="pagination-btn" id="' + nextPageNumber + '">&gt;</button></li></ul>'; //button next
            return text;
        }

        function createPaginationSearchShow(totalPages,pageActive,categoryID,searchVal,price,color,sort){
            let active = parseInt(pageActive);
            let nextPageNumber;
            let prePageNumber;

            if(active == totalPages){
                nextPageNumber = 1;
            }else{
                nextPageNumber = active + 1;
            }

            if(active == 1){
                prePageNumber = totalPages;
            }else{
                prePageNumber = active - 1;
            }

            let text = '<ul><li><button data="' + URLROOT + '/shops/loadSearchProducts/category=' + categoryID + "/page=" + prePageNumber + "/price=" + price + "/color=" + color + "/search=" + searchVal + "/sort=" + sort + '" class="pagination-search-btn" id="' + prePageNumber + '">&lt;</button></li>';  //button pre
        
            for(let i = 1; i <= totalPages; i++){
                if(pageActive == i){
                    text += '<li><button data="' + URLROOT + '/shops/loadSearchProducts/category=' + categoryID + "/page=" + i + "/price=" + price + "/color=" + color + "/search=" + searchVal + "/sort=" + sort + '" class="pagination-search-btn pagination-search-active" id="'+ i +'">'+ i + '</button></li>';
                }else{
                    text += '<li><button data="' + URLROOT +'/shops/loadSearchProducts/category=' + categoryID + "/page=" + i + "/price=" + price + "/color=" + color + "/search=" + searchVal + "/sort=" + sort + '" class="pagination-search-btn" id="'+ i +'">'+ i + '</button></li>';
                }
            }
            text += '<li><button data="' + URLROOT + '/shops/loadSearchProductss/category=' + categoryID + "/page=" + nextPageNumber + "/price=" + price + "/color=" + color + "/search=" + searchVal + "/sort=" + sort + '" class="pagination-search-btn" id="' + nextPageNumber + '">&gt;</button></li></ul>'; //button next
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
    let sort;

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
        if(arrayLink[i].indexOf("sort=") > -1){
            sort = arrayLink[i].split('=')[1];
        }
    }
    //0
    if(categoryID === undefined){
        //that mean there is no category is selected => set categoryID to default 
        result.push('');
    }else{
        result.push(categoryID);
    }
    //1
    if(page === undefined){
        //that mean there is no page is selected => set page to default 
        result.push(1);
    }else{
        result.push(page);
    }
    //2
    if(price === undefined){
        result.push('@none@--@none@');
    }else{
        result.push(price);
    }
    //3
    if(color === undefined){
        result.push('none');
    }else{
        result.push(color);
    }
    //4
    if(searchValue === undefined){
        result.push('');
    }else{
        result.push(searchValue);
    }
    //5
    if(sort === undefined){
        result.push('none');
    }else{
        result.push(sort);
    }

    return result;  //result[0] => categoryID , result[1] => page
                    //result[2] => price , result[3] => color
                    //result[4] => searchValue , result[5] => sort
}