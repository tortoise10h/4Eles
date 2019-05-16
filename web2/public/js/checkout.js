$(document).ready(function(){
    let currentLink = window.location.href;

    /***FOR CHECKOUT INDEX PAGE***/
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'index'){
        $('#moveToPayment').on('click',function(e){
            e.preventDefault();
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let address = $('#address').val();
            let phone = $('#phone').val();

            let is_empty = true;
            let is_focus = true;
            let is_all_field_ok = true;


            //check first name
            is_empty = isFieldEmpty(firstName,'#firstName',
            '#first-name-alert','Please enter your first name',is_focus);
            if(is_empty == false){
                //validate first name
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(firstName) == false){
                    alertMessage("#firstName","#first-name-alert","Your first name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                    is_focus = false;
                    is_all_field_ok = false;
                }else{
                    alertMessage("#firstName","#first-name-alert","",false,is_focus);
                }
            }else{
                is_focus = false;
                is_all_field_ok = false;
            }
            

            //check last name
            is_empty = isFieldEmpty(lastName,'#lastName',
            '#last-name-alert','Please enter your last name',is_focus);
            if(is_empty == false){
                //validate last name
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(lastName) == false){
                    alertMessage("#lastName","#last-name-alert","Your last name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                    is_focus = false;
                    is_all_field_ok = false;
                }else{
                    alertMessage("#lastName","#last-name-alert","",false,is_focus);
                }
            }else{
                is_focus = false;
                is_all_field_ok = false;
            }


            //check address
            is_empty = isFieldEmpty(address,'#address',
            '#address-alert','Please enter your address to us know where to ship',is_focus);
            if(is_empty == false){
            }else{
                is_focus = false;
                is_all_field_ok = false;
            }

            //check phone number
            is_empty = isFieldEmpty(phone,'#phone',
            '#phone-alert','Please enter your phone number',is_focus);
            if(is_empty == false){
                //validate last name
                if(/^0[1-9]\d{8}$/.test(phone) == false){
                    alertMessage("#phone","#phone-alert","Your phone number is NOT VALID","alert alert-danger",true,is_focus);
                    is_focus = false;
                    is_all_field_ok = false;
                }else{
                    alertMessage("#register-phone-group","#register-phone-err","",false,is_focus);
                }
            }else{
                is_focus = false;
                is_all_field_ok = false;
            }

            if(is_all_field_ok == true){
                let url = URLROOT + "/checkouts/payment/" + firstName + "/" + lastName + "/" + address + "/" + phone;
                window.location.href = url;
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


    /***FOR CHECKOUT PAYMENT PAGE***/
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'payment'){
        let userID = $('#userID').val();

        $("input[name$='payment']").click(function(){
            var demovalue = $(this).val(); 
            $("div.myDiv").hide();
            $("#payment_"+demovalue).show();
        });
        
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        
        //FOR THREE BUTTON PAYMENT SUBMIT
        $('#CODOrder').on('click',function(e){
            e.preventDefault();
            if(confirm("Do you want to pay this bill?")){
                saveBill(userID);
                let url = URLROOT + "/checkouts/thankyou/Ship COD";
                window.location.href = url;
            } 
        });

        $('#BankOrder').on('click',function(e){
            e.preventDefault();
            if(confirm("Do you want to pay this bill?")){
                saveBill(userID);
                let url = URLROOT + "/checkouts/thankyou/Bank Tranfers";
                window.location.href = url;
            }
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
                if(confirm("Do you want to pay this bill?")){
                    saveBill(userID);
                    let url = URLROOT + "/checkouts/thankyou/Credit Card";
                    window.location.href = url;
                }
            }
            
            form.addClass('was-validated');
        });

        function saveBill(userID){
            let billID = createBillID();
            $.ajax({
                url: URLROOT + "/checkouts/saveBill/" + userID + "/" + billID,
                type: 'POST',
                cache:false,
                success:function(data){
                    console.log(data);
                }
            });
        }

        function createBillID(){
            let d = new Date();
            
            let day = d.getDate().toString();
            let month = (d.getMonth() + 1).toString();
            let year = d.getFullYear().toString();
            let hours = (d.getHours()).toString();
            let minutes = d.getMinutes().toString();
            let seconds = d.getSeconds().toString();

            if(month.length < 2){
                month = "0" + month;
            }
            if(day.length < 2){
                day = "0" + day;
            }
            if(hours.length < 2){
                hours = "0" + hours;
            }
            if(minutes.length < 2){
                minutes = "0" + minutes;
            }
            if(seconds.length < 2){
                seconds = "0" + seconds;
            }

            let result = day + month + year + hours + minutes + seconds;

            return result;

        }
    }


    /***FOR CHECKOUT THANKYOU PAGE***/
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'thankyou'){
        
    }
});
