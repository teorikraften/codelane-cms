$(function() {
	$("#id-filter").keyup(function() { fetchData(); });
	$("#title-filter").keyup(function() { fetchData(); });
	$("#persons-filter").keyup(function() { fetchData(); });
});

function fetchData() {
	$.ajax({
		method: "POST",
	  	url: "/pm-filter",
	  	data: {
	  		idfilter: $("#id-filter").val(),
	  		titlefilter: $("#title-filter").val(),
	  		personsfilter: $("#persons-filter").val(),
	  	},
	  	datatype: 'json',
	    _token: $("meta[name='token']").attr('content'),
	}).done(function(data) {
		var res = "";
		for (var i = 0; i < data.length; i++) {
			
			var persons = "";
			if (data[i].persons != undefined) {
				for (var j = 0; j < data[i].persons.length; j++) {
					persons += '<tr><td>' + data[i].persons[j].real_name + '</td><td>' + data[i].persons[j].pivot.assignment + '</td></tr>';
				}
			}

			res += '<tr>' + 
				'<td><a href="/pm/' + data[i].token + '">V</a></td>' +
				'<td><a href="/pm/' + data[i].token + '/andra">Ä</a></td>' +
				'<td><a href="/pm/' + data[i].token + '/andra-personer">ÄP</a></td>' +
				'<td><a href="/admin/pm/ta-bort/' + data[i].token + '">X</a></td>' +
				'<td>' + data[i].id + '</td>' + 
				'<td>' + data[i].title + '</td>' +
				'<td>' +
					'<a href="#" onclick="$(\'#pm' + data[i].id + '\').toggle();return false;">Visa</a>' +
                    '<table style="display: none" id="pm' + data[i].id + '">' +
                    	persons +
                    '</table>' + 
                '</td>' +
			'</tr>';
		}
		setResult(res);
	});
}

function filter(col, val) {
	return val;
}

function setResult(result) {
	$("#filter-result").html(result);
}