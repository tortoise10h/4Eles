$(document).ready(function(){
    let registerSubmit = $('#registerSubmit');
    let loginSubmit = $('#loginSubmit');

    //CATCH REGISTER FORM SUBMIT EVENT
    registerSubmit.click(function(e){
        e.preventDefault();
        let firstName = $('#register-form input[name="first-name"]').val();
        let lastName = $('#register-form input[name="last-name"]').val();
        let email = $('#register-form input[name="email"]').val();
        let password = $('#register-form input[name="password"]').val();
        let confirmPass = $('#register-form input[name="confirm-password"]').val();
        let phone = $('#register-form input[name="phone"]').val();
        let sexes = $('#register-sex-group input[name="sex"]');
        let address = $('#register-address-group input[name="address"]').val();
        let sex;
        let is_all_field_ok = true;   
        let is_empty = true;
        let is_focus = true;

        //GET SEX
        for(let i = 0; i < sexes.length; i++){
            if(sexes[i].checked){
                sex = sexes[i].value;
            }
        }

        //CHECK EMPTY FIELD
        is_empty = isFieldEmpty(firstName,'#register-first-name-group',
        '#register-first-name-err','Please enter your first name',is_focus);
        if(is_empty == false){
            //validate first name
            if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(firstName) == false){
                alertMessage("#register-first-name-group","#register-first-name-err","Your first name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-first-name-group","#register-first-name-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }

        
        is_empty = true;
        is_empty = isFieldEmpty(lastName,'#register-last-name-group','#register-last-name-err','Please enter your last name',is_focus);
        if(is_empty == false){
            //validate last name
            if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(lastName) == false){
                alertMessage("#register-last-name-group","#register-last-name-err","Your last name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-last-name-group","#register-last-name-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }


        is_empty = isFieldEmpty(email,'#register-email-group','#register-email-err','Please enter email',is_focus);
        if(is_empty == false){
            //validate email
            if(/^[a-z][a-z0-9_\.]{5,32}@\D{2,}(\.\D{2,4}){1,2}$/.test(email) == false){
                alertMessage("#register-email-group","#register-email-err","Your email is NOT VALID","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-email-group","#register-email-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }


        is_empty = isFieldEmpty(phone,'#register-phone-group','#register-phone-err','Please enter your phone number',is_focus);
        if(is_empty == false){
            //validate phone if it is not empty
            if(/^0[1-9]\d{8}$/.test(phone) == false){
                alertMessage("#register-phone-group","#register-phone-err","Your phone number is NOT VALID","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-phone-group","#register-phone-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }

        is_empty = isFieldEmpty(password,'#register-password-group','#register-password-err','Please enter password',is_focus);
        if(is_empty == false){
            //validate password
            if(password.length < 6){
                alertMessage("#register-password-group","#register-password-err","Your password have to has at least 6 characters","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-password-group","#register-password-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }


        is_empty = isFieldEmpty(confirmPass,'#register-confirmPass-group','#register-confirmPass-err','Please enter confirm password',is_focus);
        if(is_empty == false){
            //validate confirm password
            if(confirmPass != password){
                alertMessage("#register-confirmPass-group","#register-confirmPass-err","Your confirm password does not match your password","alert alert-danger",true,is_focus);
                is_all_field_ok = false;
                is_focus = false;
            }else{
                alertMessage("#register-confirmPass-group","#register-confirmPass-err","",false);
            }
        }else{
            is_all_field_ok = false;
            is_focus = false;
        }

        if(is_all_field_ok == true){
            let formData = "firstname=" + firstName + "&lastname=" + lastName + "&email=" + email + "&password=" + password + "&sex=" + sex + "&phone=" + phone + "&address=" + address;
            $.ajax({
                url: URLROOT + '/users/register',
                type: 'POST',
                cache:false,
                data: formData,
                success:function(data){
                    // console.log(data);
                    let message = $.parseJSON(data);
                    if(message.status == 'success'){
                        $('#register-general-alert').html(message.alert);
                        $('#register-form input[name="first-name"]').val('');
                        $('#register-form input[name="last-name"]').val('');
                        $('#register-form input[name="email"]').val('');
                        $('#register-form input[name="address"]').val('');
                        $('#register-form input[name="phone"]').val('');
                        $('#register-form input[name="password"]').val('');
                        $('#register-form input[name="confirm-password"]').val('');
                         
                    }else if(message.status == 'error'){
                        $('#register-general-alert').html(message.alert);
                    }
                }
            });
        }
    });

    //CATCH 'have an account? login'
    $('#loginChange').click(function(){
       $(function(){
            $('#registerForm').modal('hide');
            $('#loginForm').modal('show');
       });
    });

    //CATCH 'no account? register'
    $('#registerChange').click(function(){
        $(function(){
            $('#loginForm').modal('toggle');
             $('#registerForm').modal('toggle');
        });
     });


    //  //CATCH LOGIN SUBMIT EVENT
     loginSubmit.click(function(e){
        e.preventDefault();
        let email = $('#login-form input[name="email"]').val();
        let password = $('#login-form input[name="password"]').val();
        let is_all_field_ok = true;
        let is_empty = true;

        //VALIDATE EMPTY FIELD
        is_empty = isFieldEmpty(email,'#login-email-group','#login-email-err','Please enter email');
        if(is_empty == true){
            is_all_field_ok = false;
        }

        is_empty = isFieldEmpty(password,'#login-password-group','#login-password-err','Please enter password');
        if(is_empty == true){
            is_all_field_ok = false;
        }

        if(is_all_field_ok == true){
            let formData = "email=" + email + "&password=" + password;
            $.ajax({
                url: URLROOT + '/users/login',
                type: 'POST',
                cache:false,
                data: formData,
                success:function(data){
                    // console.log(data);

                    let message = $.parseJSON(data);
                    if(message.status == 'success'){
                        $('#login-general-alert').html(message.alert);
                        $('#login-form input[name="email"]').val('');
                        $('#login-form input[name="password"]').val('');
                        $(function () {
                            $('#loginForm').modal('toggle');
                         });
                         setTimeout(function(){ document.location.reload(); },500)
                         
                    }else if(message.status == 'error'){
                        $('#login-general-alert').html(message.alert);
                    }

                    // $('#login-general-alert').html(data);

                }
            });
        }
    });
});


function isFieldEmpty(fieldCheck,formGroupID,messageBoxID,message,is_focus){ 
    if(fieldCheck == ''){
        $(messageBoxID).html(message);
        $(formGroupID + ' input').addClass('alert alert-danger');
        if(is_focus == true){
            $(formGroupID + ' input').focus();
        }
        return true;
    }else{
        $(messageBoxID).html('');
        $(formGroupID + ' input').removeClass('alert alert-danger');
        return false; 
    }
}

function alertMessage(formGroupID,messageBoxID,message,classesName,is_alert,is_focus){
    if(is_alert == true){
        $(messageBoxID).html(message);
        $(formGroupID + ' input').addClass(classesName);
        if(is_focus == true){
            $(formGroupID + ' input').focus();
        }
    }else{
        $(messageBoxID).html('');
        $(formGroupID + ' input').removeClass(classesName);
    }
}