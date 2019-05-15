
$(document).ready(function(){
    let currentLink = window.location.href;
    if(currentLink.split('/')[4] == 'admins' && currentLink.split('/')[5] == 'orders'){
        loadOrdersTable();
        orderQuickSearch();
        searchFromPriceOnOrderTable();
        searchToPriceOnOrderTable();
        sortFromDate();
        sortToDate();
        orderSort();
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
        let selectOperation = '<select onchange="orderStatusChange(this)" id="' + order.id + '" class="rounded ">';
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

function orderStatusChange(select){
    let processStatus = select.options[select.selectedIndex].value;
    let orderID = $(select).attr('id');
    if(confirm('Are you sure that you want to change status of this bill?')){
        changeProcessStatusOfOrder(processStatus,orderID);
    }
}

function changeProcessStatusOfOrder(processStatus,orderID){
    if(processStatus == 2 || processStatus == 3){
        $.ajax({
           url: URLROOT + '/admins/checkBillQuantity/' + orderID,
            type: 'POST',
            cache: false,
            success:function(data){
                console.log(data);
                let result = $.parseJSON(data);
                if(result.status == 'true'){
                    $.ajax({
                        url: URLROOT + '/admins/changeProcessStatusOfOrder/' + processStatus + '/' + orderID,
                        type: 'POST',
                        cache: false,
                        success:function(data){
                            if(data == 1){
                                 loadOrdersTable();
                            }else{
                                    console.log(data);
                            }
                        }
                    });
                }else if(result.status == 'false'){
                    let text = "Product quantity is not enough, list of products: \n";
                    for(let i = 0; i < result.textResult.length; i++){
                        text += " - " + result.textResult[i]['productID'] + " : " + result.textResult[i]['productName'] + "\n";
                    }
                    alert(text);
                    loadOrdersTable();
                }
            } 
        });
    }else{
        $.ajax({
            url: URLROOT + '/admins/changeProcessStatusOfOrder/' + processStatus + '/' + orderID,
            type: 'POST',
            cache: false,
            success:function(data){
                if(data == 1){
                     loadOrdersTable();
                }else{
                        console.log(data);
                }
            }
        });
    }
}


function orderQuickSearch(){
    let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');

    $('#orderQuickSearch').on('keyup',function(){
        let columnSearch = document.getElementById('orderQuickSearchChoices').value;
        let searchValue = $('#orderQuickSearch').val().toLowerCase();
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

function searchFromPriceOnOrderTable(){
    let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');

    $('#orderFromPriceBox').on('keyup',function(){
        let columnSearch = document.getElementById('orderQuickSearchChoices').value;
        let fromPriceValue = 0;
        if($('#orderFromPriceBox').val() == ""){
            fromPriceValue = 0;
        }else{
            fromPriceValue = parseInt($('#orderFromPriceBox').val());
        }
        for(let i = 0; i < rows.length; i++){
            let columnValue = rows[i].getElementsByTagName('td')[2].innerText;
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
function searchToPriceOnOrderTable(){
    let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');

    $('#orderToPriceBox').on('keyup',function(){
        let columnSearch = document.getElementById('orderQuickSearchChoices').value;
        let fromPriceValue = 0;
        if($('#orderFromPriceBox').val() == ""){
            fromPriceValue = 0;
        }else{
            fromPriceValue = parseInt($('#orderFromPriceBox').val());
        }

        let toPriceValue = $('#orderToPriceBox').val();
        for(let i = 0; i < rows.length; i++){
            let columnValue = rows[i].getElementsByTagName('td')[2].innerText;
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

function sortFromDate(){
    $('#fromDate').on('change',function(e){
        let fromDateValueText = $('#fromDate').val();
        let fromDate;
        if(fromDateValueText == ""){
            fromDate = new Date(1970,1,1);
        }else{
            let fromDateArr = fromDateValueText.split('-');
            fromDate = new Date(fromDateArr[0],fromDateArr[1],fromDateArr[2]);    
        }

        let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');
        
        for(let i = 0; i < rows.length; i++){
            let fromDateTableText = rows[i].getElementsByTagName('td')[3].innerText;
            let fromDateTableArr = fromDateTableText.split(' ')[0].split('-');
            let tableFromDate = new Date(fromDateTableArr[0],fromDateTableArr[1],fromDateTableArr[2]);

            if(dates.compare(tableFromDate,fromDate) == 1 || dates.compare(tableFromDate,fromDate) == 0){
                rows[i].style.display = "";
            }else{
                rows[i].style.display = "none";
            }
        }
    });
}

function sortToDate(){
    $('#toDate').on('change',function(e){
        let fromDateValueText = $('#fromDate').val();
        let toDateValueText = $('#toDate').val();
        
        let fromDate;
        if(fromDateValueText == ""){
            fromDate = new Date(1970,1,1);
        }else{
            let fromDateArr = fromDateValueText.split('-');
            fromDate = new Date(fromDateArr[0],fromDateArr[1],fromDateArr[2]);    
        }

        let toDate;
        if(toDateValueText == ""){
            
        }else{
            let toDateArr = toDateValueText.split('-');
            toDate = new Date(toDateArr[0],toDateArr[1],toDateArr[2]);    
        }

        let rows = document.getElementById('orderTableBody').getElementsByTagName('tr');
        
        for(let i = 0; i < rows.length; i++){
            let dateTableText = rows[i].getElementsByTagName('td')[3].innerText;
            let dateTableArr = dateTableText.split(' ')[0].split('-');
            let tableDate = new Date(dateTableArr[0],dateTableArr[1],dateTableArr[2]);

            if(toDate == undefined){
                if(dates.compare(tableDate,fromDate) == 1 || dates.compare(tableDate,fromDate) == 0){
                    rows[i].style.display = "";
                }else{
                    rows[i].style.display = "none";
                }
            }else{
                if((dates.compare(tableDate,fromDate) == 1 || dates.compare(tableDate,fromDate) == 0 ) &&  (dates.compare(tableDate,toDate) == -1 || dates.compare(tableDate,toDate) == 0)){
                    rows[i].style.display = "";
                }else{
                    rows[i].style.display = "none";
                }
            }
            
        }
    });   
}

function orderSort(){
        $('#orderSort').on('change',function(){
        let selectTag = document.getElementById('orderSort');
            let sort = selectTag.options[selectTag.selectedIndex].value;
            loadOrdersTable(sort);
        })
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

var dates = {
    convert:function(d) {
        // Converts the date in d to a date-object. The input can be:
        //   a date object: returned without modification
        //  an array      : Interpreted as [year,month,day]. NOTE: month is 0-11.
        //   a number     : Interpreted as number of milliseconds
        //                  since 1 Jan 1970 (a timestamp) 
        //   a string     : Any format supported by the javascript engine, like
        //                  "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
        //  an object     : Interpreted as an object with year, month and date
        //                  attributes.  **NOTE** month is 0-11.
        return (
            d.constructor === Date ? d :
            d.constructor === Array ? new Date(d[0],d[1],d[2]) :
            d.constructor === Number ? new Date(d) :
            d.constructor === String ? new Date(d) :
            typeof d === "object" ? new Date(d.year,d.month,d.date) :
            NaN
        );
    },
    compare:function(a,b) {
        // Compare two dates (could be of any type supported by the convert
        // function above) and returns:
        //  -1 : if a < b
        //   0 : if a = b
        //   1 : if a > b
        // NaN : if a or b is an illegal date
        // NOTE: The code inside isFinite does an assignment (=).
        return (
            isFinite(a=this.convert(a).valueOf()) &&
            isFinite(b=this.convert(b).valueOf()) ?
            (a>b)-(a<b) :
            NaN
        );
    },
    inRange:function(d,start,end) {
        // Checks if date in d is between dates in start and end.
        // Returns a boolean or NaN:
        //    true  : if d is between start and end (inclusive)
        //    false : if d is before start or after end
        //    NaN   : if one or more of the dates is illegal.
        // NOTE: The code inside isFinite does an assignment (=).
       return (
            isFinite(d=this.convert(d).valueOf()) &&
            isFinite(start=this.convert(start).valueOf()) &&
            isFinite(end=this.convert(end).valueOf()) ?
            start <= d && d <= end :
            NaN
        );
    }
}