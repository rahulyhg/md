
//search by ID
$(document).ready(function(){
    $('.searchID > a.searchLink').live('click',function(){
		$(this).addClass('select');
        $('.searchID > div.sbID').each(function(){
            $(this).hide();    
        });
        $(this).parent().find('.sbID').show();
    });
    $("div.sbID").mouseup(function() {
	return false
    });
    $(document).mouseup(function(){
        $('.searchID > div.sbID').each(function(){
            $(this).hide();
			$(".searchLink").removeClass("select");
        });
    });
});
