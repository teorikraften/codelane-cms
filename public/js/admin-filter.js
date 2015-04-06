$(function() {
	$("#id-filter").click(function() { fetchData('name'); });
	$("#title-filter").click(function() { fetchData('title'); });
	$("#persons-filter").click(function() { fetchData('persons'); });
});

function fetchData(type) {
	var result = filter('id', $(this).val());
	result = 'Det här en så kallad TODO.'; // TODO
	if (result.length > 0)
		setResult(result);
}

function filter(col, val) {
	return val;
}

function setResult(result) {
	$("#filter-result").html(result);
}