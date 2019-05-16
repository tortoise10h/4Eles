$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'carts'){
        loadCartProductTable();

        //CATCH PLUS AND SUB BUTTON
        $(document).on('click','.cart-btn-plus',function(){
            // alert("Helu");
            let productID = $(this).attr("data");
            let userID = $("#userID-hidden").val();
            changeCartProductQuantity(productID,userID,"add");
            loadCartProductTable();
        });
        $(document).on('click','.cart-btn-sub',function(){
            // alert("Helu");
            let productID = $(this).attr("data");
            let userID = $("#userID-hidden").val();
            let quantityBoxID = "quantity-box-" + productID;
            let quantityBoxValue = $("#" + quantityBoxID).attr("value");
            
            if(parseInt(quantityBoxValue) == 1){
                alert("Yout can't reduce your quantity lower than 1");
            }else{
                changeCartProductQuantity(productID,userID,"sub");
                loadCartProductTable();
            }
        });

        //REMOVE CART PRODUCT
        $(document).on('click','.cart-del-btn',function(e){
            e.preventDefault();
            productID = $(this).attr("data");
            userID = $("#userID-hidden").val();
            if(confirm("Are you sure that you want to delete this product out of your shopping cart?")){
                
                removeCartProduct(productID,userID);
            }
        });


        //CHECK PROCEED TO CHECK OUT BUTTON
        $("#proceedToCheckout").on('click',function(e){
            let userID = $("#userID-hidden").val();
            $.ajax({
                url: URLROOT + '/carts/checkUserCartEmpty/' + userID,
                type: 'POST',
                cache:false,
                success:function(data){
                    if(data == 0){
                        $('#cart-alert').addClass('alert alert-danger p-3');
                        $('#cart-alert').html("Can't check out when your cart is empty");
                        window.scroll({
                            top: 50, 
                            left: 0, 
                            behavior: 'smooth'
                        });
                    }else{
                        window.location.href = URLROOT + '/checkouts/index';
                    }
                }
            });
        })

        function loadCartProductTable(){
            //CHECK USER LOGIN
            $.ajax({
                url: URLROOT + '/users/isLogin',
                type: 'POST',
                cache:false,
                success:function(data){
                   data = $.parseJSON(data);
                   if(data.status == 'true'){
                       //if login
                       getUserCartProduct(data.userID);
                   }else if(data.status == 'false'){
                       //if user doesn't login -> through notification
                       $('#cartProductTable').html('<div class="rounded-0 p-5 alert alert-danger" style="border-left:5px solid red">You have to login to see your cart</div>')
                   }
                }
            });
        }
        
        function getUserCartProduct(userID){
            $.ajax({
                url: URLROOT + '/carts/getUserCartProduct/' + userID,
                type: 'POST',
                cache:false,
                success:function(data){
                   let products = $.parseJSON(data);
                   if(products == false){
                        console.log('False');
                        $('#cartProductTable').html('<div class="rounded-0 p-5 alert alert-warning" style="border-left:5px solid orange">Your cart is empty now </div>');
                        $('#cartTotal').html('');
                    }else{
                        $('#cartProductTable').html(createCartProductTable(products,userID));
                        $('#cartTotal').html(createCartTotal(products));
                    }
                }
            });
        }
        
        function createCartProductTable(products,userID){
            let text = '<table class="table table-bordered">' +
                            '<thead>' +
                                '<tr>' +
                                    '<th class="product-thumbnail">Image</th>' +
                                    '<th class="product-name">Product</th>' +
                                    '<th class="product-price">Price</th>' +
                                    '<th class="product-quantity">Quantity</th>' +
                                    '<th class="product-total">Total</th>' +
                                    '<th class="product-remove">Remove</th>' +
                                '</tr>' +
                            '</thead>'+
                            '<tbody>';
            $.each(products,function(tag,product){
                // let total = 
                text += '<tr>'+
                            '<td class="product-thumbnail">' +
                                '<img src="' + URLROOT + product.imgLink + '/' + product.id + '_1.jpg"' + ' alt="Image" class="img-fluid">' +
                            '</td>' +
                            '<td class="product-name" style="max-width:235px">' +
                                '<h2 class="h5 text-black">' + product.name + '</h2>' +
                            '</td>' +
                            '<td>$ ' + product.price + '</td>' +
                            '<td>' +
                                '<div class="input-group mb-3" style="max-width: 120px;">' +
                                '<div class="input-group-prepend">' +
                                    '<button data="' + product.id + '" class="btn btn-outline-primary js-btn-minus cart-btn-sub" type="button">&minus;</button>' +
                                '</div>' +
                                '<input id="quantity-box-' + product.id + '" type="text" class="form-control text-center" value="' + product.quantity + '" aria-label="Example text with button addon" aria-describedby="button-addon1">' +
                                '<input id="userID-hidden" type="hidden" value="' + userID + '">' +
                                '<div class="input-group-append">' +
                                    '<button data="' + product.id + '" class="btn btn-outline-primary js-btn-plus cart-btn-plus" type="button">&plus;</button>'+
                                '</div>' + 
                                '</div>' +
                            '</td>' +
                            '<td>$ ' + (parseInt(product.quantity) * parseInt(product.price)) + '</td>' +
                            '<td><button data="' + product.id + '" class="btn btn-primary btn-sm cart-del-btn">X</button></td>' +
                        '</tr>';
            });
            text += '</tbody></table>';
            return text;
        }
        
        function createCartTotal(products){
            let text = '';
            let totalPrice = 0;
            $.each(products,function(tag,product){
                totalPrice += (parseInt(product.quantity) * parseInt(product.price));
            });
            text += '<div class="col-md-6">' +
                        '<span class="text-black">Total</span>' +
                    '</div>' +
                    '<div class="col-md-6 text-right">' +
                        '<strong class="text-black">$ ' + totalPrice + '</strong>' +
                    '</div>';
            return text;
        }
        
        function changeCartProductQuantity(productID,userID,operation){
            $.ajax({
                url: URLROOT + '/carts/changeProductQuantity/' + productID + "/" + userID + "/" + operation,
                type: 'POST',
                cache:false,
                success:function(data){
                    console.log(data);
                    console.log("ChangeCartProductQuantity function success");
                }
            });
        }
        
        
        function removeCartProduct(productID,userID){
                        
            $.ajax({
                url: URLROOT + '/carts/removeCartProduct/' + productID + "/" + userID,
                type: 'POST',
                cache:false,
                success:function(data){
                    loadCartProductTable();
                }
            });
        }


    }

    
});

