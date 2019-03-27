$(document).ready(function(){
    load_all_product();

    //
    $(document).on('click','.category-link',function(){
        let subLink = $(this).attr('data');
        let categoryKey = subLink.replace('/','');
        window.history.pushState('','',subLink);
        let currentLink = location.href;
        let array = currentLink.split('/');
        console.log(currentLink);
        console.log(array);
        console.log(array.length);
        console.log(array[array.length-1]);
        // loadProductByCategory(1,categoryKey);
    });

    //FOR LOAD PRODUCT BY CATEGORY
    function loadProductByCategory(page,categoryKey){
        $.ajax({
            url: 'http://localhost:8080/web2/shops/showProducts/' + categoryKey,
            type: 'POST',
            cache: false,
            data: {page:page}, 
            success:function(data){
                let result = $.parseJSON(data);
                //get products and pagination to show
                let productsShow = createProductShow(result.products);
                let paginationShow = createPaginationShow(result.totalPages,result.pageActive);
                $('#productShow').html(productsShow);
                $('#paginationShow').html(paginationShow);
                document.cookie = 'pageActive=' + result.pageActive;
                document.cookie = 'totalPages=' + result.totalPages;
            }
        });
    }

    //FOR LOAD ALL PRODUCT
    function load_all_product(page = 1){
        $.ajax({
            url: 'http://localhost:8080/web2/shops/showProducts',
            type: 'POST',
            cache: false,
            data: {page:page},
            success:function(data){
                let result = $.parseJSON(data);
                //get products and pagination to show
                let productsShow = createProductShow(result.products);
                let paginationShow = createPaginationShow(result.totalPages,result.pageActive);
                $('#productShow').html(productsShow);
                $('#paginationShow').html(paginationShow);
                document.cookie = 'pageActive=' + result.pageActive;
                document.cookie = 'totalPages=' + result.totalPages;
            }
        });
    }

    //AJAX FOR PAGINATION BUTTON
    $(document).on('click','.pagination-link-btn', function(){
        let page = $(this).attr("id");
        
        load_all_product(page);
        window.scroll({
            top: 250, 
            left: 0, 
            behavior: 'smooth'
        });
    });
    $(document).on('click','#lt',function(){
        let cookie = document.cookie;
        cookie = cookie.split(';');

        let pageActiveCookie = cookie[1].split('=');
        let pageActive = parseInt(pageActiveCookie[1]);

        let page = pageActive - 1;
        if(page < 1){
            page = 1;
        }

        load_product(page);
        window.scroll({
            top: 250, 
            left: 0, 
            behavior: 'smooth'
        });
    });
    $(document).on('click','#gt',function(){
        let cookie = document.cookie;
        cookie = cookie.split(';');

        let pageActiveCookie = cookie[1].split('=');
        let pageActive = parseInt(pageActiveCookie[1]);

        let totalPagesCookie = cookie[0].split('=');
        let totalPages = totalPagesCookie[1];

        page = pageActive + 1;
        if(page > totalPages){
            page = totalPages;
        }
        console.log('Total pages: ' + totalPages + ' page active: ' + pageActive + ' page: ' + page);

        load_product(page);
        window.scroll({
            top: 250, 
            left: 0, 
            behavior: 'smooth'
        });

        //
    });
    
});
function createProductShow(products){
    let text = '';
    $.each(products,function(tag,product){
        text += '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">' +
                    '<div class="block-4 text-center border">' +
                    '<figure class="block-4-image">' + 
                        '<a href="#"><img src="' + product.imgLink + '/' + product.id + '_1.jpg"' + 'class="img-fluid"></a>' +
                    '</figure>' +
                    '<div class="block-4-text p-4">' +
                        '<h3><a href="#">'+ product.name + '</a></h3>' +
                        '<p class="text-primary font-weight-bold">'+ product.price +'</p>' +
                    '</div>'+
                    '</div>' +
                '</div>';    
    });
    return text;
}
function createPaginationShow(totalPages,pageActive){
    let text = '<ul><li><span style="cursor:pointer;" class="pagination-link-btn" id="lt">&lt;</span></li>';

    for(let i = 1; i <= totalPages; i++){
        if(pageActive == i){
        text += '<li><span class="pagination-btn pagination-link-btn pagination-active" id="'+ i +'">'+ i + '</span></li>';
        }else{
        text += '<li><span class="pagination-btn pagination-link-btn" id="'+ i +'">'+ i + '</span></li>';
        }
    }
    text += '<li><span style="cursor:pointer;" class="pagination-link-btn" id="gt">&gt;</span></li></ul>';
    return text;
}