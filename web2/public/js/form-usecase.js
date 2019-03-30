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
        let is_ok = true;

        //GET SEX
        for(let i = 0; i < sexes.length; i++){
            if(sexes[i].checked){
                sex = sexes[i].value;
            }
        }

        //CHECK EMPTY FIELD
        is_ok = checkEmptyField(firstName,'#register-first-name-group','#register-first-name-err','Please enter your first name');
        is_ok = checkEmptyField(lastName,'#register-last-name-group','#register-last-name-err','Please enter your last name');
        is_ok = checkEmptyField(email,'#register-email-group','#register-email-err','Please enter email');
        is_ok = checkEmptyField(phone,'#register-phone-group','#register-phone-err','Please enter your phone number');
        is_ok = checkEmptyField(password,'#register-password-group','#register-password-err','Please enter password');
        is_ok = checkEmptyField(confirmPass,'#register-confirmPass-group','#register-confirmPass-err','Please enter confirm password');

        if(is_ok == true){
            //validate first name
            if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(firstName) == false){
                alertMessage("#register-first-name-group","#register-first-name-err","Your first name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-first-name-group","#register-first-name-err","",false);
            }

            //validate last name
            if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test(lastName) == false){
                alertMessage("#register-last-name-group","#register-last-name-err","Your last name is NOT VALID, we don't allow special characters and digit","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-last-name-group","#register-last-name-err","",false);
            }

            //validate email
            if(/^[a-z][a-z0-9_\.]{5,32}@\D{2,}(\.\D{2,4}){1,2}$/.test(email) == false){
                alertMessage("#register-email-group","#register-email-err","Your email is NOT VALID","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-email-group","#register-email-err","",false);
            }

            //validate password
            if(password.length < 6){
                alertMessage("#register-password-group","#register-password-err","Your password have to has at least 6 characters","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-password-group","#register-password-err","",false);
            }

            //validate confirm password
            if(confirmPass != password){
                alertMessage("#register-confirmPass-group","#register-confirmPass-err","Your confirm password does not match your password","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-confirmPass-group","#register-confirmPass-err","",false);
            }

            //validate phone if it is not empty
            if(/^0[1-9]\d{8}$/.test(phone) == false){
                alertMessage("#register-phone-group","#register-phone-err","Your phone number is NOT VALID","alert alert-danger",true);
                is_ok = false;
            }else{
                alertMessage("#register-phone-group","#register-phone-err","",false);
            }
        }

        if(is_ok == true){
            let formData = "firstname=" + firstName + "&lastname=" + lastName + "&email=" + email + "&password=" + password + "&sex=" + sex + "&phone=" + phone + "&address=" + address;
            $.ajax({
                url: 'http://localhost:8080/web2/users/register',
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
        let is_ok = true;


        //VALIDATE EMPTY FIELD
        is_ok = checkEmptyField(email,'#login-email-group','#login-email-err','Please enter email');
        is_ok = checkEmptyField(password,'#login-password-group','#login-password-err','Please enter password');

        if(is_ok == true){
            let formData = "email=" + email + "&password=" + password;
            $.ajax({
                url: 'http://localhost:8080/web2/users/login',
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


function checkEmptyField(fieldCheck,formGroupID,messageBoxID,message){ 
    if(fieldCheck == ''){
        $(messageBoxID).html(message);
        $(formGroupID + ' input').addClass('alert alert-danger');
        return false;
    }else{
        $(messageBoxID).html('');
        $(formGroupID + ' input').removeClass('alert alert-danger');
        return true; 
    }
}

function alertMessage(formGroupID,messageBoxID,message,classesName,is_alert){
    if(is_alert == true){
        $(messageBoxID).html(message);
        $(formGroupID + ' input').addClass(classesName);
    }else{
        $(messageBoxID).html('');
        $(formGroupID + ' input').removeClass(classesName);
    }
}