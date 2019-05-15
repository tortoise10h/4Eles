$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'admins' && currentLink.split('/')[5] == 'users'){
    	loadUsersTable();
        userQuickSearch();
        createNewAccount();
    	console.log('This is users page');
    }
 });

function loadUsersTable(sort='none'){
    $.ajax({
        url: URLROOT + '/admins/getUsers/' + sort,
        type: 'POST', 
        cache: false,
        success:function(data){
        	console.log(data);
            let result = $.parseJSON(data);
            let usersShow = createUserTableBody(result.users);
            $('#userTableBody').html(usersShow);
            // quickSearchOnProductTable();
            // searchFromPriceOnProductTable();
            // searchToPriceOnProductTable();
        }
    });
} 

function createUserTableBody(users){
    let text = '';
    $.each(users,function(tag,user){
    	let sex;
    	if(user.sex == 1){
    		sex = "Male";
    	}else{
    		sex = "Female";
    	}

        text += '<tr>' +
                '<td style="max-width:50px">' + user.id + '</td>' +
                '<td>' + user.firstname + " " + user.lastname + '</td>' + 
                '<td>' + user.email + '</td>' +
                '<td>' + user.phone + '</td>' +
                '<td>' + sex + '</td>'+
                '<td>' + user.status + '</td>'+
                '<td>'+
                '<button data="' + user.id + '" data-toggle="modal" data-target="#userAction" onclick="showUserAction(this)"><i class="fas fa-exclamation"></i></button>' +
                '</td>'+
                '</tr>';
    });
    return text;
}

function showUserAction(button){
	let userID = $(button).attr('data');
    $.ajax({
        url: URLROOT + '/admins/getUserInfo/' + userID,
        type: 'POST',
        cache: false,
        success:function(data){
        	let result = $.parseJSON(data);
        	roleArr = [1,9,99];
        	let roleOptions = '<select onchange="userRoleOptionAction(this)" id="' + result.id + '" class="form-control"> ';
        	for(let i = 0; i < roleArr.length; i++){
        		if(roleArr[i] == result.roleID){
        			roleOptions += '<option selected value="' + roleArr[i] + '">' + parseRoleIDToName(roleArr[i]) + "</option>";
        		}else{
        			roleOptions += '<option value="' + roleArr[i] + '">' + parseRoleIDToName(roleArr[i]) + "</option>";
        		}
        	}
                roleOptions += '</select>';

        	let buttonReset = '<button onclick="resetPassword(this)" data="' + result.id + '" class="rounded p-1 btn btn-success"><i class="fas fa-sync-alt"></i> Reset password</button>';	
                let buttonBlock;
                if(result.status == 1){
                    buttonBlock = '<button onclick="blockUser(this)" data="' + result.id + '" class="rounded p-1 btn btn-danger"><i class="fas fa-sync-alt"></i> Block User</button>';    
                }else{
                    buttonBlock = '<button onclick="unblockUser(this)" data="' + result.id + '" class="rounded p-1 btn btn-success"><i class="fas fa-sync-alt"></i> Unblock User</button>';                        
                } 

        	$('#userResetPassBtn').html(buttonReset);
        	$('#userRoleOption').html(roleOptions);
                $('#userBlock').html(buttonBlock);
        }
    });
}

function resetPassword(button){
    alert($(button).attr('data'));
}

function userRoleOptionAction(select){
    let roleID = select.options[select.selectedIndex].value;
    let userID = $(select).attr('id');

    if(confirm('Are you sure that you want to change role of this user?')){
        $.ajax({
            url: URLROOT + '/admins/changeUserRole/' + userID + '/' + roleID,
            type: 'POST',
            cache: false,
            success:function(data){
                 if(data == 3){
                    alert('You can\'t change current admin to another role');
                 }else if(data == 1){
                    console.log('success');
                    loadUsersTable();
                    $('#userAction').modal('toggle');
                 }else if(data == 0){
                    console.log(data);
                 }
            }
        });
    }
}

function resetPassword(button){
    let userID = $(button).attr('data');
    if(confirm('Are you sure that you want to reset password of this user?')){
        $.ajax({
            url: URLROOT + '/admins/resetPassword/' + userID,
            type: 'POST',
            cache: false,
            success:function(data){
                 if(data == 3){
                    alert('You can\'t change password of current user');
                 }else if(data == 1){
                    console.log('success');
                    loadUsersTable();
                    $('#userAction').modal('toggle');
                 }else if(data == 0){
                    console.log(data);
                 }
            }
        });
    }   
}

function blockUser(button){
    let userID = $(button).attr('data');
    if(confirm('Are you sure that you want to block this user?')){
        $.ajax({
            url: URLROOT + '/admins/blockUser/' + userID,
            type: 'POST',
            cache: false,
            success:function(data){
                 if(data == 3){
                    alert('You can\'t block this current user');
                 }else if(data == 1){
                    console.log('success');
                    loadUsersTable();
                    $('#userAction').modal('toggle');
                 }else if(data == 0){
                    console.log(data);
                 }
            }
        });
    }   
}

function unblockUser(button){
    let userID = $(button).attr('data');
    if(confirm('Are you sure that you want to unblock this user?')){
        $.ajax({
            url: URLROOT + '/admins/unblockUser/' + userID,
            type: 'POST',
            cache: false,
            success:function(data){
                console.log(data);
                 if(data == 3){
                    alert('You can\'t block this current user');
                 }else if(data == 1){
                    console.log('success');
                    loadUsersTable();
                    $('#userAction').modal('toggle');
                 }else if(data == 0){
                    console.log(data);
                 }
            }
        });
    }   
}


function userQuickSearch(){
    let rows = document.getElementById('userTableBody').getElementsByTagName('tr');

    $('#userQuickSearch').on('keyup',function(){
        let columnSearch = document.getElementById('userQuickSearchChoices').value;
        let searchValue = $('#userQuickSearch').val().toLowerCase();
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


function createNewAccount(){
    $('#addNewAccountBtn').on('click',function(e){
        if(confirm("Are you sure that you want to create new account?")){
            let email = $('#newAccountEmail').val();
            console.log(email);
            let roleSelect = document.getElementById('newAccountRole');
            let role = roleSelect.options[roleSelect.selectedIndex].value;
            
            let is_empty = true;
            let is_focus = true;

            is_empty = isFieldEmpty(email,'#newAccountEmail','#newAccountEmailAlert','Please enter email',is_focus);
            if(is_empty == false){
                //validate email
                if(/^[a-z][a-z0-9_\.]{5,32}@\D{2,}(\.\D{2,4}){1,2}$/.test(email) == false){
                    $('#newAccountEmail').addClass("alert alert-danger");
                    $('#newAccountEmailAlert').html("Email is NOT VALID");
                    $('#newAccountEmail').focus();
                    is_all_field_ok = false;
                    is_focus = false;
                }else{
                    $('#newAccountEmail').removeClass("alert alert-danger");
                    $('#newAccountEmailAlert').html("");

                    $.ajax({
                        url: URLROOT + '/admins/checkEmail/' + email,
                        type: 'POST',
                        cache: false,
                        success:function(data){
                            if(data == 1){
                                $('#newAccountEmail').removeClass("alert alert-danger");
                                $('#newAccountEmailAlert').html("");
                                $.ajax({
                                    url: URLROOT + '/admins/createNewAccount/' + email + '/' + role,
                                    type: 'POST',
                                    cache: false,     
                                    success:function(data){
                                        if(data == 1){
                                            loadUsersTable();
                                            $('#accountDialog').modal('toggle');
                                        }else{
                                            console.log(data);
                                        }
                                    }
                                });                           
                            }else{
                                $('#newAccountEmail').addClass("alert alert-danger");
                                $('#newAccountEmailAlert').html("Email is duplicated");
                            }   
                        }
                    });
                }
            }else{
                is_all_field_ok = false;
                is_focus = false;
            }
        }
    });
}

function parseRoleIDToName(roleID){
	if(roleID == 1){
		return "User";
	}else if(roleID == 9){
		return "Manager";
	}else if(roleID == 99){
		return "Admin";
	}
}


function isFieldEmpty(fieldCheck,formGroupID,messageBoxID,message,is_focus){ 
    if(fieldCheck == ''){
        $(messageBoxID).html(message);
        $(formGroupID).addClass('alert alert-danger');
        if(is_focus == true){
            $(formGroupID).focus();
        }
        return true;
    }else{
        $(messageBoxID).html('');
        $(formGroupID + ' input').removeClass('alert alert-danger');
        return false; 
    }
}