$(document).ready(function(){
    let urlArr = splitUrl();
    if(urlArr[0] == 'searches'){
       loadProducts(urlArr[1],urlArr[2]);
       console.log("before event listener: " + urlArr);
        $("#searchInput").on('keyup keypress',function(e){
            let keyCode = e.keyCode || e.which;
            if(keyCode == 13){
                e.preventDefault();
                let inputValue = $("#searchInput").val().toLowerCase();
                console.log(inputValue);
                inputValue = inputValue.replace("\'",'');
                console.log(inputValue);
                let subLink = URLROOT + '/searches/index?search=' + inputValue + "&page=" + urlArr[2];
                //use window.history.pushState to change url
                window.history.pushState('','',subLink);    //change url but not refresh page

                let currentUrl = splitUrl();
                console.log(currentUrl);
                loadProducts(currentUrl[1],currentUrl[2]);
            }
        })



        function loadProducts(searchValue = '', page = 1){
            searchValue = searchValue.replace("%27",'"');
            $.ajax({
                url: URLROOT + '/searches/getSearchProducts?search=' + searchValue + "&page=" + page,
                type: 'POST',
                cache: false,
                // data: {page:page}, 
                success:function(data){
                    
                    let result = $.parseJSON(data);
                    //get products and pagination to show
                    if(result.totalPages == 0){
                        $('#searchAlert').html('<div class="rounded-0 p-5 alert alert-warning" style="border-left:5px solid orange">Nothing match your search </div>');
                        $('#searchProductShow').html('');
                        $('#searchPaginationShow').html('');
                    }else{
                        let productsShow = createProductShow(result.products);
                        let paginationShow = createPaginationShow(result.totalPages,result.pageActive,searchValue);
                        $('#searchProductShow').html(productsShow);
                        $('#searchPaginationShow').html(paginationShow);
                        $('#searchAlert').html('');
                    }
                }
            });
        }
        
        function encode_utf8(s) {
            return unescape(encodeURIComponent(s));
          }
          
        function decode_utf8(s) {
            return decodeURIComponent(escape(s));
        }



        function createProductShow(products){
            let text = '';
            $.each(products,function(tag,product){
                text += '<div class="img-card col-sm-6 col-lg-4 mb-4" data-aos="fade-up">' +
                            '<div class="block-4 text-center border">' +
                            '<figure class="block-4-image">' + 
                                '<a href="' + URLROOT + '/shops/productDetail/' + product.id.substr(0,3) + '/' + product.id +'"><img src="' + URLROOT + product.imgLink + '/' + product.id + '_1.jpg"' + 'class="img-fluid"></a>' +
                            '</figure>' +
                            '<div class="img-card-name block-4-text p-4">' +
                                '<h3><a href="' + URLROOT + '/shops/productDetail/' + product.id.substr(0,3) + '/' + product.id +'">'+ product.name + '</a></h3>' +
                            '</div>'+
                            '<div class="img-card-price block-4-text p-4">' +
                                '<p class="text-primary font-weight-bold">$'+ product.price +'</p>' +
                            '</div>' +
                            '</div>' +
                        '</div>';    
            });
            return text;
        }
        function createPaginationShow(totalPages,pageActive,searchValue){
            let active = parseInt(pageActive);
            let text = '<ul><li><button data="' + URLROOT + '/searches/getSearchProducts?search=' + searchValue + '&page=' + (active - 1) + '" class="pagination-btn" id="' + (active - 1) + '">&lt;</button></li>';  //button pre
        
            for(let i = 1; i <= totalPages; i++){
                if(pageActive == i){
                    text += '<li><button data="' + URLROOT + '/searches/getSearchProducts?search=' + searchValue + '&page=' + i + '" class="pagination-btn pagination-active" id="'+ i +'">'+ i + '</button></li>';
                }else{
                    text += '<li><button data="' + URLROOT + '/searches/getSearchProducts?search=' + searchValue + '&page=' + i + '" class="pagination-btn" id="'+ i +'">'+ i + '</button></li>';
                }
            }
            text += '<li><button data="' + URLROOT + '/searches/getSearchProducts?search=' + searchValue + '&page=' + (active + 1) + '" class="pagination-btn" id="' + (active + 1) + '">&gt;</button></li></ul>'; //button next
            return text;
        }

        //AJAX FOR PAGINATION BUTTON
        $(document).on('click','.pagination-btn', function(){
            let paginationBtnLink = $(this).attr('data');
            window.history.pushState('','',paginationBtnLink);
            let params = splitUrl();
            console.log(params);
            loadProducts(params[1],params[2]);
            window.scroll({
                top: 250, 
                left: 0, 
                behavior: 'smooth'
            });
        });
    }

    
});

function splitUrl(){
    let result = [];

    let currentUrl = window.location.href;
    currentUrl = currentUrl.split("/"); //split link http://localhost:8080/web2/searches/index?search=
    result.push(currentUrl[4]); //"searches" parameter at position 4 

    if(currentUrl[4] == 'searches'){
        let lastParam =  currentUrl[currentUrl.length - 1]; //include method and search params in searches controller
        let searchParam = lastParam.split("?")[1]; //after ? sign is search param
         //check if have page param
        if(searchParam.indexOf("&") > -1){
            searchParam = searchParam.split("&");
            result.push(searchParam[0].split("=")[1]);  //for search value
            result.push(searchParam[1].split("=")[1]);  //for page
        }else{
            searchParam = searchParam.split("="); //search = value of search
            result.push(searchParam[1]);    //for search value
            result.push(1);                 //for page
        }   
    
    }

    return result;
}
