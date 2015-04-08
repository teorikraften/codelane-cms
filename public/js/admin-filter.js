$(function() {
	$("#filter-p").show();
	$("#filter").keyup(function() { fetchData($(this).val()); });
});

function fetchData(val) {
	$.ajax({
		method: "POST",
	  	url: "/pm-filter",
	  	data: {
	  		filter: val,
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
				'<td><a href="/pm/' + data[i].token + '" title="Visa"><img src="/images/view.png" alt="Visa"></a></td>' +
				'<td><a href="/pm/' + data[i].token + '/andra" title="Ändra"><img src="/images/edit.png" alt="Ändra"></a></td>' +
				'<td><a href="/pm/' + data[i].token + '/andra-personer" title="Ändra personer"><img src="/images/persons.png" alt="Ändra personer"></a></td>' +
				'<td><a href="/admin/pm/ta-bort/' + data[i].token + '" title="Ta bort"><img src="/images/delete.png" alt="Ta bort"></a></td>' +
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
	$("#table-fill").html(result);
}