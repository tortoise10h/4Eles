
$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'admins' && currentLink.split('/')[5] == 'orders'){
    	loadOrdersTable();
    	console.log("admin order page ");
    }
});

function loadOrdersTable(sort='none'){
	    $.ajax({
	        url: URLROOT + '/admins/getOrders/' + sort,
	        type: 'POST', 
	        cache: false,
	        success:function(data){
	            console.log(data);

	            let result = $.parseJSON(data);
	            let ordersShow = createOrderTableBody(result.orders);
	            $('#orderTableBody').html(ordersShow);
	            // quickSearchOnProductTable();
	            // searchFromPriceOnProductTable();
	            // searchToPriceOnProductTable();
	        }
	    });
	} 

	function createOrderTableBody(orders){
	    let text = '';
	    $.each(orders,function(tag,order){
	    	//handle operation select box
	    	let selectOperation = '<select class=" rounded ">';
	    	for(let i = 1; i <= 4; i++){
	    		if(order.processStatus == i){
	    			selectOperation += '<option value="' + i + '" selected>' + parseProcessStatusToString(i) + "</option>";
	    		}else{
	    			selectOperation += '<option value="' + i + '">' + parseProcessStatusToString(i) + "</option>";
	    		}
	    	}
	    	selectOperation += '</select>';
	                          
	        text += '<tr>' +
	        		'<td style="max-width:30px">'+
	        		'<button data="' + order.id + '" data-toggle="modal" data-target="#orderInfo" onclick="showOrderInfo(this)"><i class="fas fa-info-circle" style="font-size:18px"></i></button>' +
	        		'</td>'+
	                '<td>' + order.id + '</td>' +
	                '<td style="max-width:50px">$' + order.totalPrice + '</td>' + 
	                '<td>' + order.date + '</td>' +
	                '<td>' + parseProcessStatusToString(order.processStatus) + '</td>' +
	                '<td>' + selectOperation + '</td>'+
	                '<td>' + order.userEmail + '</td>'+
	                '</tr>';
	    });
	    return text;
	}

	function showOrderInfo(button){
		let orderID = $(button).attr('data');
	    $.ajax({
	        url: URLROOT + '/admins/getOrderInfo/' + orderID,
	        type: 'POST',
	        cache: false,
	        success:function(data){
	        	let result = $.parseJSON(data);
	            let tableBody = '';
	            let totalPrice = 0;
	            for(let i = 0; i < result.billDetails.length; i++){
	            	tableBody += '<tr>' +
	            				  '<td>' + result.billDetails[i].productName +'</td>' +
	                              '<td>' + result.billDetails[i].quantity + '</td>' +
	                              '<td>$' + result.billDetails[i].totalPrice + '</td>'+
	                              '</tr>';
	                totalPrice += parseInt(result.billDetails[i].totalPrice);
	            }

	            $('#billDetailTableBody').html(tableBody);
	            $('#billDetailTotalPrice').html(totalPrice);

	            $('#customerName').html(result.userInfo.firstname + " " + result.userInfo.lastname);
	            $('#customerEmail').html(result.userInfo.email);
	            $('#customerAddress').html(result.userInfo.address);
	            $('#customerPhone').html(result.userInfo.phone);
	        }
	    });
	}

	function parseProcessStatusToString(processStatus){
		if(processStatus == 1){
			return "Processing";
		}else if(processStatus == 2){
			return "Delivering";
		}else if(processStatus == 3){
			return "Success";
		}else if(processStatus == 4){
			return "Cancel";
		}
	}