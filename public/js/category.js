$(function() {
    $(".sortby li").on('click', function() {
    	if(!$(this).hasClass('active')) {
    		$(this).siblings('li').removeClass('active');
    		$(this).addClass('active');
    	}
    });
    
	$("span.cat").click(function() {
		expand($(this).prop('id'));
		return false;
	});
});

function expand(elId) {
	var el = $("#" + elId);
	if (el.hasClass('a')) {
		el.removeClass('a');
		el.html('&#9656; ');
		el.parent().siblings().removeClass('active');
	} else {
		el.addClass('a');
		el.html('&#9662; ');
		el.parent().siblings().addClass('active');
	}
}