$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'carts'){
        console.log('That\'s it');
        loadCartProductTable();
    }
});

function loadCartProductTable(){
    //CHECK USER LOGIN
    $.ajax({
        url: 'http://localhost:8080/web2/users/isLogin',
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
        url: 'http://localhost:8080/web2/carts/getUserCartProduct/' + userID,
        type: 'POST',
        cache:false,
        success:function(data){
           let products = $.parseJSON(data);
           if(products == false){
                console.log('False');
                $('#cartProductTable').html('<div class="rounded-0 p-5 alert alert-warning" style="border-left:5px solid orange">Your cart is empty now </div>');
            }else{
                $('#cartProductTable').html(createCartProductTable(products));
                $('#cartTotal').html(createCartTotal(products));
            }
        }
    });
}

function createCartProductTable(products){
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
        let total = 
        text += '<tr>'+
                    '<td class="product-thumbnail">' +
                        '<img src="http://localhost:8080/web2' + product.imgLink + '/' + product.id + '_1.jpg"' + ' alt="Image" class="img-fluid">' +
                    '</td>' +
                    '<td class="product-name">' +
                        '<h2 class="h5 text-black">' + product.name + '</h2>' +
                    '</td>' +
                    '<td>$ ' + product.price + '</td>' +
                    '<td>' +
                        '<div class="input-group mb-3" style="max-width: 120px;">' +
                        '<div class="input-group-prepend">' +
                            '<button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>' +
                        '</div>' +
                        '<input type="text" class="form-control text-center" value="' + product.quantity + '" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">' +
                        '<div class="input-group-append">' +
                            '<button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>'+
                        '</div>' + 
                        '</div>' +
                    '</td>' +
                    '<td>$ ' + (parseInt(product.quantity) * parseInt(product.price)) + '</td>' +
                    '<td><a href="#" class="btn btn-primary btn-sm">X</a></td>' +
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