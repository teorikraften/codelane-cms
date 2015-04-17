// Will comment code at a later stage, this is a alpha version
function enable(div_id) {
	var el = document.getElementById(div_id);
	el.style.display = 'block';
}
function disable(div_id) {
	var el = document.getElementById(div_id);
	el.style.display = 'none';
}
function window_pos(infoWindow) {
	if (typeof window.innerWidth != 'undefined') {
		viewportwidth = window.innerHeight;
	} else {
		viewportwidth = document.documentElement.clientHeight;
	}
	if ((viewportwidth > document.body.parentNode.scrollWidth) && (viewportwidth > document.body.parentNode.clientWidth)) {
		window_width = viewportwidth;
	} else {
		if (document.body.parentNode.clientWidth > document.body.parentNode.scrollWidth) {
			window_width = document.body.parentNode.clientWidth;
		} else {
			window_width = document.body.parentNode.scrollWidth;
		}
	}
	var infoWindow = document.getElementById(infoWindow);
	window_width=window_width/4-150;// TODO: Better and smarter for adaption 
	infoWindow.style.left = window_width + 'px';
}
function show(windowname) {
	window_pos(windowname);
	enable(windowname);		
}
function hide(windowname) {
	window_pos(windowname);
	disable(windowname);		
}
