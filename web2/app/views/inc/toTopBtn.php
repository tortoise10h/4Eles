<button id="backtotop" title="Back to top"><i class="fa fa-arrow-up"></i></button>
<script>
$(document).ready(function(){ 
        $(window).scroll(function(){ 
                        if ($(this).scrollTop() > 10) { 
                                        $('#backtotop').fadeIn(); 
                        } else { 
                                        $('#backtotop').fadeOut(); 
                        } 
        }); 
        $('#backtotop').click(function(){ 
                        $("html, body").animate({ scrollTop: 0 }, 50); 
                        return false; 
        }); 
});

</script>
