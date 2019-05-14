$(document).ready(function(){
    loadCartQuantity();
    let addCartBtn = $('#addCartBtn');
    
    addCartBtn.on('click',function(){
        let productID = $(this).attr('data');
        let quantity = $('#cartProductQuantity').val();
        //CHECK USER LOGIN
        $.ajax({
            url: URLROOT + '/users/isLogin',
            type: 'POST',
            cache:false,
            success:function(data){
               data = $.parseJSON(data);
               if(data.status == 'true'){
                   let userID = data.userID;
                   alert('Add product to cart success');
                   addToCart(productID,quantity,userID);
               }else if(data.status == 'false'){
                   alert('You have to login first');
               }
            }
        });
    });
    function addToCart(productID,quantity,userID){
        $.ajax({
            url: URLROOT + '/shops/addToCart/' + productID + '/' + quantity + '/' + userID,
            type: 'POST',
            cache:false,
            success:function(data){
                data = $.parseJSON(data);
                console.log(data);
                loadCartQuantity();
            }
        });
    }

    function loadCartQuantity(){
        //Get current login user
        $.ajax({
            url: URLROOT + '/users/isLogin',
            type: 'POST',
            cache:false,
            success:function(data){
               data = $.parseJSON(data);
               let userID = data.userID;
               getCartQuantity(userID);
            }
        });
    }
    function getCartQuantity(userID){
        $.ajax({
            url: URLROOT + '/carts/getCartQuantity/' + userID,
            type: 'POST',
            cache: false,
            success: function(data){
                $('#cartQuantity').html(data);
            }
        });
    }
});
