$(document).ready(function(){
    let registerSubmit = $('#registerSubmit');
    let loginSubmit = $('#loginSubmit');

    //CATCH REGISTER FORM SUBMIT EVENT
    registerSubmit.click(function(e){
        e.preventDefault();
        let name = $('#register-form input[name="name"]').val();
        let email = $('#register-form input[name="email"]').val();
        let password = $('#register-form input[name="password"]').val();
        let confirmPass = $('#register-form input[name="confirm-password"]').val();
        let is_ok = true;
        // console.log(name);

        //validate name
        if(name == ''){
            $('#register-name-err').html('Please enter name');
            $('#register-name-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            $('#register-name-err').html('');
            $('#register-name-group input').removeClass('alert alert-danger');   
        }

        //validate email
        if(email == ''){
            $('#register-email-err').html('Please enter email');
            $('#register-email-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            $('#register-email-err').html('');
            $('#register-email-group input').removeClass('alert alert-danger');   
        }

        //validate password
        if(password == ''){
            $('#register-password-err').html('Please enter password');
            $('#register-password-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            $('#register-password-err').html('');
            $('#register-password-group input').removeClass('alert alert-danger');   
        }

        //validate confirm password
        if(confirmPass == ''){
            $('#register-confirmPass-err').html('Please enter confirm password');
            $('#register-confirmPass-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            if(confirmPass != password){
                $('#register-confirmPass-err').html('Password and confirm password are not match');
                $('#register-confirmPass-group input').addClass('alert alert-danger');
                is_ok = false;
            }else{
                $('#register-confirmPass-err').html('');
                $('#register-confirmPass-group input').removeClass('alert alert-danger')
            }
        }

        if(is_ok == true){
            let formData = "name=" + name + "&email=" + email + "&password=" + password;
            $.ajax({
                url: 'http://localhost:8080/web2/users/register',
                type: 'POST',
                cache:false,
                data: formData,
                success:function(data){
                    let message = $.parseJSON(data);
                    if(message.status == 'success'){
                        $('#register-general-alert').html(message.alert);
                        $('#register-form input[name="name"]').val('');
                        $('#register-form input[name="email"]').val('');
                        $('#register-form input[name="password"]').val('');
                        $('#register-form input[name="confirm-password"]').val('');
                        // $(function () {
                        //     $('#registerForm').modal('toggle');
                        //  });
                         
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
            $('#registerForm').modal('toggle');
            $('#loginForm').modal('toggle');
       });
    });

    //CATCH 'no account? register'
    $('#registerChange').click(function(){
        $(function(){
             $('#registerForm').modal('toggle');
             $('#loginForm').modal('toggle');
        });
     });


    //  //CATCH LOGIN SUBMIT EVENT
     loginSubmit.click(function(e){
        e.preventDefault();
        let email = $('#login-form input[name="email"]').val();
        let password = $('#login-form input[name="password"]').val();
        let is_ok = true;


        //validate email
        if(email == ''){
            $('#login-email-err').html('Please enter email');
            $('#login-email-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            $('#login-email-err').html('');
            $('#login-email-group input').removeClass('alert alert-danger');   
        }

        //validate password
        if(password == ''){
            $('#login-password-err').html('Please enter password');
            $('#login-password-group input').addClass('alert alert-danger');
            is_ok = false;
        }else{
            $('#login-password-err').html('');
            $('#login-password-group input').removeClass('alert alert-danger');   
        }

        if(is_ok == true){
            let formData = "email=" + email + "&password=" + password;
            $.ajax({
                url: 'http://localhost:8080/web2/users/login',
                type: 'POST',
                cache:false,
                data: formData,
                success:function(data){
                    console.log(data);
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



// function registerAlert(alertId,formGroupId,element,classesName,message){
//     $(alertId).html(message);
//     $(formGroupId + ' ' + element).addClass(classesName);
// }