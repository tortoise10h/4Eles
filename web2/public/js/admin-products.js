
$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'admins' && currentLink.split('/')[5] == 'products'){
        //FOR ADMIN PRODUCTS PAGE
        console.log("admin product page ");

        loadProductsTable();
        editProductCheck();
        addProductCheck();
        editProductSelectBoxChange();
        addProductSelectBoxChange();
        sortProductTable();

        function editProductCheck(){
            $('#editSubmit').on('click',function(e){
                if(confirm("Are you sure that you want to edit this product?")){
                    e.preventDefault();

                let productID = $('#productID').val();
                let productName = $('#productName').val();
                let productCategory = $('#productCategoryHidden').val();
                let productPrice = $('#productPrice').val();
                let productTotal = $('#productTotal').val();
                let productColor = $('#productColor').val();
                let productDescription = $('#productDescription').val();   

                productDescription = productDescription.split(' ').join('@@');
                productName = productName.split(' ').join('@@');          


                let is_empty = true;
                let is_focus = true;
                let is_all_field_ok = true;

                //check product name
                is_empty = isFieldEmpty(productName,'#productName',
                '#productNameErr','Please enter product name',is_focus);
                if(is_empty == false){
                    
                }else{
                    is_focus = false;
                    is_all_field_ok = false;
                }

                //check product price
                is_empty = isFieldEmpty(productPrice,'#productPrice',
                '#productPriceErr','Please enter product price',is_focus);
                if(is_empty == false){
                    
                }else{
                    is_focus = false;
                    is_all_field_ok = false;
                }

                if(is_all_field_ok == false){
                    e.preventDefault();
                }

                //check product color
                is_empty = isFieldEmpty(productPrice,'#productColor',
                '#productColorErr','Please enter product color',is_focus);
                if(is_empty == false){
                    
                }else{
                    is_focus = false;
                    is_all_field_ok = false;
                }

                //check product total
                is_empty = isFieldEmpty(productTotal,'#productTotal',
                '#productTotalErr','Please enter product total',is_focus);
                if(is_empty == false){
                    
                }else{
                    is_focus = false;
                    is_all_field_ok = false;
                }

                //check product description
                is_empty = isFieldEmpty(productPrice,'#productDescription',
                '#productDescriptionErr','Please enter product description',is_focus);
                if(is_empty == false){
                    
                }else{
                    is_focus = false;
                    is_all_field_ok = false;
                }

                //check file submit
                if($('#productFile').val() == ""){
                    saveProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription);
                    loadProductsTable();
                }else{
                    var formData = new FormData();
                    formData.append('file', $('#productFile')[0].files[0]);

                    $.ajax({
                        url : URLROOT + '/admins/checkProductFile',
                        type : 'POST',
                        data : formData,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        success : function(data) {
                            console.log(data);
                            if(data == 1){
                                $('#productFileErr').html('');
                                saveEditImage(productID,productCategory);
                                saveProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription);
                            }else{
                                $('#productFileErr').html('Your file IS NOT VALID');
                            }
                        }
                    });

                }
                }
            })
        }


        function addProductCheck(){
            $('#addSubmit').on('click',function(e){
                e.preventDefault();

                let productTailID = $('#newProductID').val();
                let productID = $('#newProductPreID').val() + $('#newProductID').val();
                let productName = $('#newProductName').val();
                let productCategory = $('#newProductCategoryHidden').val();
                let productPrice = $('#newProductPrice').val();
                let productTotal = $('#newProductTotal').val();
                let productColor = $('#newProductColor').val();
                let productDescription = $('#newProductDescription').val();   

                productDescription = productDescription.split(' ').join('@@'); 
                productName = productName.split(' ').join('@@');          

                let is_empty = true;
                let is_focus = true;
                let is_all_field_ok = true;

                //check productID
                is_empty = isFieldEmpty(productTailID,'#newProductID',
                '#newProductIDErr','Please enter product id',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }
                //check product name
                is_empty = isFieldEmpty(productName,'#newProductName',
                '#newProductNameErr','Please enter product name',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }
                //check product price
                is_empty = isFieldEmpty(productPrice,'#newProductPrice',
                '#newProductPriceErr','Please enter product price',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }
                //check product total
                is_empty = isFieldEmpty(productTotal,'#newProductTotal',
                '#newProductTotalErr','Please enter product total',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }
                //check product color
                is_empty = isFieldEmpty(productColor,'#newProductColor',
                '#newProductColorErr','Please enter product color',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }

                
                //check product description
                is_empty = isFieldEmpty(productDescription,'#newProductDescription',
                '#newProductDescriptionErr','Please enter product description',is_focus);
                if(is_empty == true){
                    is_focus = false;
                    is_all_field_ok = false;
                }


                //is productID exist
                if(is_all_field_ok){
                    $.ajax({
                        url : URLROOT + '/admins/isProductIDExist/' + productID,
                        type : 'POST',
                        success : function(data) {
                            if(data == 1){                            
                                $('#newProductIDErr').html('This product ID is already exist');
                                $('#newProductID').focus();
                            }else{
                                $('#newProductID').html('');
                                saveNewProduct(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription);
                            }
                        }
                    });
                }

                //check file submit
                
                
            })
        }

        function saveNewProduct(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription){
            if($('#newProductFile').val() == ""){
                 saveDefaultImageForNewProduct(productID,productCategory);
                 saveNewProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription);
                 loadProductsTable();

            }else{
                var formData = new FormData();
                formData.append('file', $('#newProductFile')[0].files[0]);

                $.ajax({
                    url : URLROOT + '/admins/checkProductFile',
                    type : 'POST',
                    data : formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success : function(data) {
                        console.log(data);
                        if(data == 1){
                            $('#newProductFileErr').html('');
                            saveNewProductImage(productID,productCategory);
                            saveNewProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription);
                        }else{
                            $('#newProductFileErr').html('Your file IS NOT VALID');
                        }
                    }
                });
            }
        }

        function saveEditImage(productID,productCategory){
            var fileData = new FormData();
            fileData.append('file', $('#productFile')[0].files[0]);
            fileData.append('productID',productID);
            fileData.append('productCategory',productCategory);

            $.ajax({
                url : URLROOT + '/admins/saveEditImage',
                type : 'POST',
                data : fileData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(data) {
                    console.log(data);
                    if(data == 1){
                        
                    }else{
                        $('#productFileErr').html('Something went wrong');
                    }
                }
            });
        }


        function saveProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription){
            $.ajax({
                url : URLROOT + '/admins/editProductWithoutImage/' + productID + '/' + productName + '/' + productCategory + '/' + productPrice + '/' + productTotal + '/' + productColor + '/' + productDescription ,
                type : 'POST',
                cache: false,
                success : function(data) {
                    console.log(data);

                    if(data == 1){
                        loadProductsTable();
                        $('#editForm').modal('toggle');
                    }else{
                        $('#productFileErr').html('Something went wrong');
                    }
                }
            });
        }

        //set hidden input value when category was changed
        function editProductSelectBoxChange(){
            $('#productCategory').on('change',function(){
                var e = document.getElementById("productCategory");
                var category = e.options[e.selectedIndex].value;
                
                $('#productCategoryHidden').val(category);
            });
        }

        function saveDefaultImageForNewProduct(productID,productCategory){
            $.ajax({
                url : URLROOT + '/admins/saveDefaultImageForNewProduct/' + productID + '/' + productCategory,
                type : 'POST',
                cache: false,
                success : function(data) {
                    if(data == 1){
                    }else{
                        console.log(data);
                    }
                }
            });
        }

        function saveNewProductInfo(productID,productName,productCategory,productPrice,productTotal,productColor,productDescription){
            $.ajax({
                url : URLROOT + '/admins/addNewProductInfo/' + productID + '/' + productName + '/' + productCategory + '/' + productPrice + '/' + productTotal + '/' + productColor + '/' + productDescription ,
                type : 'POST',
                cache: false,
                success : function(data) {

                    if(data == 1){
                        loadProductsTable();
                        $('#addForm').modal('toggle');
                    }else{
                        $('#newProductFileErr').html('Something went wrong');
                    }
                }
            });
        }

        function saveNewProductImage(productID,productCategory){
            var fileData = new FormData();
            fileData.append('file', $('#newProductFile')[0].files[0]);
            fileData.append('newProductID',productID);
            fileData.append('newProductCategory',productCategory);

            $.ajax({
                url : URLROOT + '/admins/saveImageForNewProduct',
                type : 'POST',
                data : fileData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(data) {
                    console.log(data);
                    if(data == 1){
                        
                    }else{
                        $('#newProductFileErr').html('Something went wrong');
                    }
                }
            });
        }

        function sortProductTable(){
            $('#sortChoicesBox').on('change',function(){
                var e = document.getElementById("sortChoicesBox");
                var sortValue = e.options[e.selectedIndex].value;
                loadProductsTable(sortValue);
                console.log(sortValue);
            });
        }


        function isFieldEmpty(fieldCheck,fieldID,messageBoxID,message,is_focus){ 
            if(fieldCheck == ''){
                $(messageBoxID).html(message);
                $(fieldID).addClass('alert alert-danger');
                if(is_focus == true){
                    $(fieldID).focus();
                }
                return true;
            }else{
                $(messageBoxID).html('');
                $(fieldID).removeClass('alert alert-danger');
                return false; 
            }
        }
        
        function alertMessage(fieldID,messageBoxID,message,classesName,is_alert,is_focus){
            if(is_alert == true){
                $(messageBoxID).html(message);
                $(fieldID).addClass(classesName);
                if(is_focus == true){
                    $(fieldID).focus();
                }
            }else{
                $(messageBoxID).html('');
                $(fieldID).removeClass(classesName);
            }
        }


    }
});

function quickSearchOnProductTable(){
    let rows = document.getElementById('productTableBody').getElementsByTagName('tr');

    $('#quickSearchBox').on('keyup',function(){
        let columnSearch = document.getElementById('quickSearchChoicesBox').value;
        let searchValue = $('#quickSearchBox').val().toLowerCase();
        for(let i = 0; i < rows.length; i++){
            let columnValue = rows[i].getElementsByTagName('td')[columnSearch].innerText.toLowerCase();
            if(columnValue.indexOf(searchValue) > -1){
                rows[i].style.display = "";
            }else{
                rows[i].style.display = "none";
            }
        }       
    });
}

function searchFromPriceOnProductTable(){
    let rows = document.getElementById('productTableBody').getElementsByTagName('tr');

    $('#fromPriceBox').on('keyup',function(){
        let columnSearch = document.getElementById('quickSearchChoicesBox').value;
        let fromPriceValue = 0;
        if($('#fromPriceBox').val() == ""){
            fromPriceValue = 0;
        }else{
            fromPriceValue = parseInt($('#fromPriceBox').val());
        }
        for(let i = 0; i < rows.length; i++){
            let columnValue = rows[i].getElementsByTagName('td')[3].innerText;
            columnValue = columnValue.replace('$','');
            columnValue = parseInt(columnValue);
            if(columnValue >= fromPriceValue){
                rows[i].style.display = "";
            }else{
              rows[i].style.display = "none";
            }
        }       
    });   
}
function searchToPriceOnProductTable(){
    let rows = document.getElementById('productTableBody').getElementsByTagName('tr');

    $('#toPriceBox').on('keyup',function(){
        let columnSearch = document.getElementById('quickSearchChoicesBox').value;
        let fromPriceValue = 0;
        if($('#fromPriceBox').val() == ""){
            fromPriceValue = 0;
        }else{
            fromPriceValue = parseInt($('#fromPriceBox').val());
        }

        let toPriceValue = $('#toPriceBox').val();
        for(let i = 0; i < rows.length; i++){
            let columnValue = rows[i].getElementsByTagName('td')[3].innerText;
            columnValue = columnValue.replace('$','');
            columnValue = parseInt(columnValue);
            
            if(toPriceValue == ""){
                if(columnValue >= fromPriceValue){
                    rows[i].style.display = "";
                }else{
                    rows[i].style.display = "none";
                }
            }else{
                toPriceValue = parseInt(toPriceValue);
                if(columnValue >= fromPriceValue && columnValue <= toPriceValue){
                    rows[i].style.display = "";
                }else{
                    rows[i].style.display = "none";
                }
            }
        }       
    });   
}

function loadProductsTable(sort='none'){
    $.ajax({
        url: URLROOT + '/admins/getProducts/' + sort,
        type: 'POST', 
        cache: false,
        success:function(data){
            // console.log(data);

            let result = $.parseJSON(data);
            let productsShow = createProductTableBody(result.products);
            $('#productTableBody').html(productsShow);
            quickSearchOnProductTable();
            searchFromPriceOnProductTable();
            searchToPriceOnProductTable();

        }
    });
} 

function createProductTableBody(products){
    let text = '';
    $.each(products,function(tag,product){
        //handle category name
        let categoryName = '';
        if(product.categoryID == 'fig'){
            categoryName = 'Figure';
        }else if(product.categoryID == 'shi'){
            categoryName = 'Shirt';
        }else if(product.categoryID == 'plu'){
            categoryName = 'Plush';
        }else{
            categoryName = 'Hat';
        }

        //handle product status
        let productStatus = '';
        if(product.status == 1){
            productStatus = 'Available';
        }else{
            productStatus = 'Stop Selling';
        }


        text += '<tr>' +
                '<th><img src="' + URLROOT + product.imgLink + '/' + product.id + "_1.jpg" + '"></th>' +
                '<td>' + product.id + '</td>' +
                '<td style="text-align:left;word-wrap: break-word;max-width:350px">' + product.name + '</td>' + 
                '<td>' + product.total + '</td>' +
                '<td style="max-width:50px">$' + product.price + '</td>' +
                '<td style="max-width:100px">' + productStatus + '</td>' +
                '<td><button class="mr-2 admin-btn-edit" onclick="editButtonClick(this)" data="' + product.id + '">' +
                '<i class="fas fa-edit" data-toggle="modal" data-target="#editForm"></i></button>';

        if(product.status == 1){
            text += '<button class="mr-2 admin-btn-delete" onclick="deleteButtonClick(this)" data="' + product.id + '"><i class="fas fa-ban"></i></button>';
        }else{
            text += '<button class="mr-2 admin-btn-delete" onclick="reDeleteButtonClick(this)" data="' + product.id + '"><i class="fas fa-retweet"></i></button>';
        }
        text += '</td>' +
                '</tr>';
    });
    return text;
}


function deleteButtonClick(button){
    if(confirm("Are you sure that you want to delete this product?")){
        let productID = $(button).attr('data');
        $.ajax({
            url: URLROOT + '/admins/deleteProduct/' + productID,
            type: 'POST',
            cache: false,
            success:function(data){
                console.log(data);
                if(data == 1){
                    loadProductsTable();
                }else{
                    console.log(data);
                }
            }
        });
    }
}


function reDeleteButtonClick(button){
    if(confirm("Sell this product again?")){
        let productID = $(button).attr('data');
        $.ajax({
            url: URLROOT + '/admins/reDeleteProduct/' + productID,
            type: 'POST',
            cache: false,
            success:function(data){
                console.log(data);
                if(data == 1){
                    loadProductsTable();
                }else{
                    console.log(data);
                }
            }
        });
    }
}

function editButtonClick(button){
    let productID = $(button).attr('data');
    $.ajax({
        url: URLROOT + '/admins/getProductByID/' + productID,
        type: 'POST',
        cache: false,
        success:function(data){
            let result = $.parseJSON(data);
            $('#productID').val(result.id);
            $('#productName').val(result.name);
            $('#productPrice').val(result.price);
            $('#productTotal').val(result.total);
            $('#productColor').val(result.color);
            let description = result.description;
            description = description.replace(/%/g,'--');
            $('#productDescription').val(description);
            $('#productCategoryHidden').val(result.categoryID);
            $('#productFile').val('');
            $('#productFileErr').val('');

            //create select box
            let text = "";
            for(let i = 0; i < result.categoryList.length; i++){
                if(result.categoryID == result.categoryList[i].id){
                    text += '<option selected value="' + result.categoryList[i].id + '">' + result.categoryList[i].name + '</option>';
                }else{
                    text += '<option value="' + result.categoryList[i].id + '">' + result.categoryList[i].name + '</option>';
                }
            }

            $('#productCategory').html(text);
            
        }
    });
}
function addButtonClick(){
    $('#newProductID').val('');
    $('#newProductName').val('');
    $('#newProductTotal').val('');
    $('#newProductPrice').val('');
    $('#newProductColor').val('');
    $('#newProductDescription').val('');
    $('#newProductFile').val('');
    $('#newProductFileErr').val('');

    $.ajax({
        url: URLROOT + '/admins/getCategoryList',
        type: 'POST',
        cache: false,
        success:function(data){
            let result = $.parseJSON(data);
            //create select box
            let text = "";
            for(let i = 0; i < result.length; i++){
                text += '<option value="' + result[i].id + '">' + result[i].name + '</option>';
            }

            $('#newProductCategory').html(text);
            
        }
    });
}
function addProductSelectBoxChange(){
    $('#newProductCategory').on('change',function(){
        var e = document.getElementById("newProductCategory");
        var category = e.options[e.selectedIndex].value;
        
        $('#newProductCategoryHidden').val(category);
        $('#newProductPreID').val(category);
    });
}