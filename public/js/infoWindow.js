// Will comment code at a later stage, this is a alpha version

// TODO: Make it fade, and decrease copy-paste code.
function blanket_size(bg) {
	if (typeof window.innerWidth != 'undefined') {
		viewportheight = window.innerHeight;
	} else {
		viewportheight = document.documentElement.clientHeight;
	}
	if ((viewportheight > document.body.parentNode.scrollHeight) && (viewportheight > document.body.parentNode.clientHeight)) {
		blanket_height = viewportheight;
	} else {
		if (document.body.parentNode.clientHeight > document.body.parentNode.scrollHeight) {
			blanket_height = document.body.parentNode.clientHeight;
		} else {
			blanket_height = document.body.parentNode.scrollHeight;
		}
	}
	var blanket = document.getElementById('blanket');
	blanket.style.height = blanket_height + 'px';
	var blanketDiv = document.getElementById(bg);
	blanketDiv_height=blanket_height/2-100;
	blanketDiv.style.top = blanketDiv_height + 'px';
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
	blanket_size(windowname);
	enable(windowname);
	enableBG('blanket');
}
function hide(windowname) {
	window_pos(windowname);
	blanket_size(windowname);
	disable(windowname);
	disable('blanket');
}


function enable(div_id) {
		var el = document.getElementById(div_id);
		var time = 1;
		el.style.opacity = 0;
		el.style.display = 'block';
		var intval = setInterval(function(){
			time++;
			el.style.opacity = 0.10 * time;
			if(el.style.opacity > 0.90){
				clearInterval(intval);
			}
		},30);
}
function disable(div_id) {
	var el = document.getElementById(div_id);
	el.style.display = 'none';
}
function enableBG(div_id) {
	var el = document.getElementById(div_id);
	el.style.display = 'block';
}