$(function() {
    $(".sortby li").on('click', function() {
    	if(!$(this).hasClass('active')) {
    		$(this).siblings('li').removeClass('active');
    		$(this).addClass('active');
    	}
    	});
});