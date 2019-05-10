$(document).ready(function(){
    let currentLink = window.location.href;
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

        // $('#saveBill').on('click',function(){
        //     if(confirm("")){

        //     }
        // })
    }
    if(currentLink.split('/')[4] == 'checkouts' && currentLink.split('/')[5] == 'thankyou'){
        let payment = getCookie('payment');
        $('#paymentDisplay').html('You chose ' + payment + ' for payment');
        eraseCookie('payment');
    }
});