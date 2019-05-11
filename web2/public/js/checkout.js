$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'index'){
        $('#moveToPayment').on('click',function(e){
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let address = $('#address').val();
            let phone = $('#phone').val();

            let is_empty = true;
            let is_focus = true;


            //check first name
            is_empty = isFieldEmpty(firstName,'#firstName',
            '#first-name-alert','Please enter your first name',is_focus);
            if(is_empty == false){
                //validate first name
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(firstName) == false){
                    alertMessage("#firstName","#first-name-alert","Your first name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                    is_focus = false;
                    e.preventDefault();
                }else{
                    alertMessage("#firstName","#first-name-alert","",false,is_focus);
                }
            }else{
                is_focus = false;
                e.preventDefault();
            }
            

            //check last name
            is_empty = isFieldEmpty(lastName,'#lastName',
            '#last-name-alert','Please enter your last name',is_focus);
            if(is_empty == false){
                //validate last name
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(lastName) == false){
                    alertMessage("#lastName","#last-name-alert","Your last name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                    is_focus = false;
                    e.preventDefault();
                }else{
                    alertMessage("#lastName","#last-name-alert","",false,is_focus);
                }
            }else{
                is_focus = false;
                e.preventDefault();
            }


            //check address
            is_empty = isFieldEmpty(address,'#address',
            '#address-alert','Please enter your address to us know where to ship',is_focus);
            if(is_empty == false){
            }else{
                is_focus = false;
                e.preventDefault();
            }

            //check phone number
            is_empty = isFieldEmpty(phone,'#phone',
            '#phone-alert','Please enter your phone number',is_focus);
            if(is_empty == false){
                //validate last name
                if(/^0[1-9]\d{8}$/.test(phone) == false){
                    alertMessage("#phone","#phone-alert","Your phone number is NOT VALID","alert alert-danger",true,is_focus);
                    is_focus = false;
                    e.preventDefault();
                }else{
                    alertMessage("#register-phone-group","#register-phone-err","",false,is_focus);
                }
            }else{
                is_focus = false;
                e.preventDefault();
            }

        });

        
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
    if(currentLink.split('/')[4] == 'checkouts'){
        $("input[name$='payment']").click(function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#payment_"+demovalue).show();
        });
        
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        
        $('#CODOrder').on('click',function(){
            setCookie('payment','COD');
        });

        $('#BankOrder').on('click',function(){
            setCookie('payment','Bank Tranfers');
        });
    
        $("#payment-button").click(function(e) {
    
            // Fetch form to apply Bootstrap validation
            var form = $(this).parents('form');
            
            if (form[0].checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
            }
            else {
                e.preventDefault();
                e.stopPropagation();
                setCookie('payment','Credit Card');
                window.location.href = URLROOT + "/checkouts/thankyou";
            }
            
            form.addClass('was-validated');
        });
    }
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'thankyou'){
        let payment = getCookie('payment');
        $('#paymentDisplay').html('You chose ' + payment + ' for payment');
        eraseCookie('payment');
    }
});