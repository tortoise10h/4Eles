$(document).ready(function(){
    //CHECK LINK AND AUTOMATIC LOAD PRODUCT EVERY FIRST COME TO PAGE OR PAGE RELOAD BASE ON URL
    let params = checkCategoryUrl();
    loadProducts(params[0],params[1]);

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
    
    
});
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

function checkCategoryUrl(){
    let currentLink = window.location.href;
    let arrayLink = currentLink.split('/');     //divide url by / into each element
    let result = [];
    //loop arrayLink to find categoryID and page
    let page;
    let categoryID;
    for(let i = 0; i < arrayLink.length; i++){
        if(arrayLink[i].indexOf("category=") > -1){
            categoryID = arrayLink[i].split('=')[1];
        }
        if(arrayLink[i].indexOf("page=") > -1){
            page = arrayLink[i].split('=')[1];
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
        result.push('');
    }else{
        result.push(page);
    }
    return result;  //result[0] => categoryID , result[1] => page
}