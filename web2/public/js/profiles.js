$(document).ready(function(){
    if(window.location.href.split('/')[4] == 'profiles'){
        console.log('This is profile page');

        //to change menu in profile page
        $("#profile").click(function(){
            $(".mb-1 a").removeClass('active');
            $("#user_profile").show();
            $(this).addClass('active');   
            $("#user_account").hide();
            $("#user_order").hide();
            $("#user_wishlist").hide();
            $("#customer_service").hide();
        });
        $("#account").click(function(){
            $(".mb-1 a").removeClass('active');
            $(this).addClass('active');
            $("#user_profile").hide();
            $("#user_account").show();
            $("#user_order").hide();
            $("#user_wishlist").hide();
            $("#customer_service").hide();
        });
        $("#order").click(function(){
            $(".mb-1 a").removeClass('active');
            $(this).addClass('active');
            $("#user_profile").hide();
            $("#user_account").hide();
            $("#user_order").show();
            $("#user_wishlist").hide();
            $("#customer_service").hide();
        });
        $("#wishlist").click(function(){
            $(".mb-1 a").removeClass('active');
            $(this).addClass('active');
            $("#user_profile").hide();
            $("#user_account").hide();
            $("#user_order").hide();
            $("#user_wishlist").show();
            $("#customer_service").hide();
        });
        $("#help").click(function(){
            $(".mb-1 a").removeClass('active');
            $(this).addClass('active');
            $("#user_profile").hide();
            $("#user_account").hide();
            $("#user_order").hide();
            $("#user_wishlist").hide();
            $("#customer_service").show();
        });


        /***CHECK USER INFORMATION INPUT***/
        $("#submit_profile").on('click', function(e){
            let is_ok = true;
            //validate first name
            if($('#firstname_txt').val() == ""){
                profileAlertMessage('#firstname_txt',"#firstname-alertt","Your first name must be filled",is_ok);
                is_ok = false;
                e.preventDefault();
            }else{
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test($('#firstname_txt').val()) == false){
                    profileAlertMessage('#firstname_txt',"#firstname-alertt","We don't allow special characters in first name field",is_ok);
                    is_ok = false;
                    e.preventDefault();
                }else{
                    $('#firstname_txt').removeClass("alert alert-danger");
                    $('#firstname-alertt').html("");
                }
            }


            //validate last name
            if($('#lastname_txt').val() == ""){
                profileAlertMessage('#lastname_txt',"#lastname-alert","Your last name must be filled",is_ok);
                is_ok = false;
                e.preventDefault();
            }else{
                if(/^[^\d\[\]`!@#$%^&*()_+\\{}|;':\",./<>?]*$/.test($('#lastname_txt').val()) == false){
                    profileAlertMessage('#lastname_txt',"#lastname-alert","We don't allow special characters in last name field",is_ok);
                    is_ok = false;
                    e.preventDefault();
                }else{
                    $('#lastname_txt').removeClass("alert alert-danger");
                    $('#lastname-alert').html("");
                }
            }

            //validate phone number
            if($('#phonenum_txt').val() == ""){
                profileAlertMessage('#phonenum_txt',"#phonenum-alert","Your phone number must be filled",is_ok);
                is_ok = false;
                e.preventDefault();
            }else{
                if(/^0[1-9]\d{8}$/.test($('#phonenum_txt').val()) == false){
                    profileAlertMessage('#phonenum_txt',"#phonenum-alert","Phone number is NOT VALID",is_ok);
                    is_ok = false;
                    e.preventDefault();
                }else{
                    $('#phonenum_txt').removeClass("alert alert-danger");
                    $('#phonenum-alert').html("");
                }
            
            } 

            //validate birthday
            if($('#birthday_txt').val() != ""){
                //get current date to compare with user date input
                let d = new Date();
                let userDateInput = $('#birthday_txt').val().split('-');
                if((d.getFullYear() - parseInt(userDateInput[0])) < 5){
                    profileAlertMessage('#birthday_txt',"#birthday-alert","Our website is NOT for people under 5 years old",is_ok);
                    is_ok = false;
                }
            }else{
                $('#birthday_txt').removeClass("alert alert-danger");
                $('#birthday-alert').html("");
            }

            if(is_ok == false){
                e.preventDefault();
            }
            
        });


        /***CHECK USER PASSWORD CHANGE***/
        $('#submit_password').on('click',function(e){
            e.preventDefault();
            checkUserPassword();
        });

        
        function checkUserPassword(){
            if($('#curr_password_txt').val() == ""){
                profileAlertMessage('#curr_password_txt','#curr-password-alert',"Please enter your old password",true);
            }else{
                $('#curr_password_txt').removeClass("alert alert-danger");
                $('#curr-password-alert').html("");
                let formData = "currentPassword=" + $('#curr_password_txt').val();
                $.ajax({
                    url: URLROOT + '/profiles/checkUserPasswordInput',
                    type: 'POST',
                    cache: false,
                    data: formData,
                    success:function(data){
                        let is_ok = true;
                        //check current password
                        if(data == 1){
                            $('#curr_password_txt').removeClass("alert alert-danger");
                            $('#curr-password-alert').html("");
                        }else{
                            profileAlertMessage('#curr_password_txt','#curr-password-alert',"Sorry, You entered wrong password",is_ok);
                            is_ok = false;
                        }

                        //check new password
                        if($('#new_password_txt').val().length < 6){
                            profileAlertMessage('#new_password_txt','#new-password-alert',"Your new password must be had at least 6 characters",is_ok);
                            is_ok = false;
                        }else{
                            $('#new_password_txt').removeClass("alert alert-danger");
                            $('#new-password-alert').html("");
                        }


                        //check confirm password
                        if($('#repassword_txt').val() != $('#new_password_txt').val()){
                            profileAlertMessage('#repassword_txt','#repassword-alert',"Your confirm password have to match your new password",is_ok);
                            is_ok = false;
                        }else{
                            $('#repassword_txt').removeClass("alert alert-danger");
                            $('#repassword-alert').html("");
                        }

                        //change user password
                        if(is_ok == true){
                            let newPassword = $('#new_password_txt').val();
                            let formData = "newpassword=" + newPassword;
                            $.ajax({
                                url: URLROOT + '/profiles/updateUserPassword',
                                type: 'POST',
                                cache: false,
                                data: formData,
                                success:function(data){
                                    if(data == 1){
                                        $('#curr_password_txt').val('');
                                        $('#new_password_txt').val('');
                                        $('#repassword_txt').val('');
                                        $('#account-result-alert').html('<p class="alert alert-success">Your password was changed</p>');
                                    }else{
                                        $('#account-result-alert').html('<p class="alert alert-danger">Something went wrong, please try again</p>');
                                    }
                                }
                            });
                        }
                    }
                });
            }
        }
    }
});

function profileAlertMessage(textFieldID,messageFieldID,message,is_ok){
    $(textFieldID).addClass("alert alert-danger");
    if(is_ok == true){
        $(textFieldID).focus();
    }
    $(messageFieldID).html(message);
}