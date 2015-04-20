// Will comment code at a later stage, this is a alpha version
function blanket_size(bg) {
	blanket_height = document.body.parentNode.scrollHeight;
	var blanket = document.getElementById('blanket');
	blanket.style.height = blanket_height + 'px';
	var heighter = window.getComputedStyle(document.getElementById("infoWindow"), null).getPropertyValue("height");
	var blanketDiv = document.getElementById(bg);
	blanketDiv_height = document.body.parentNode.clientHeight/2-parseInt(heighter)/2;
	blanketDiv.style.top = blanketDiv_height + 'px';
}

function window_pos(infoWindow) {
	window_width = document.body.parentNode.clientWidth;
	var infoWindow = document.getElementById(infoWindow);
	var widther = window.getComputedStyle(document.getElementById("infoWindow"), null).getPropertyValue("width");
	window_width=window_width/2-parseInt(widther)/2;// TODO: Better and smarter for adaption 
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
	var elem = document.getElementById(div_id);
	var time = 1;
	elem.style.opacity = 0;
	elem.style.display = 'block';
	var intval = setInterval(function(){
		time++;
		elem.style.opacity = 0.10 * time;
		if(elem.style.opacity > 0.90){
			clearInterval(intval);
		}
	},30);
}
function disable(div_id) {
	var elem = document.getElementById(div_id);
	elem.style.display = 'none';
}
function enableBG(div_id) {
	var elem = document.getElementById(div_id);
	elem.style.display = 'block';
}