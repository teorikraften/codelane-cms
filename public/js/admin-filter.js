function fetchData(val, pageUrl, type) {
	$.ajax({
		method: "POST",
	  	url: pageUrl,
	  	data: {
	  		filter: val,
	  	},
	  	datatype: 'json',
	    _token: $("meta[name='token']").attr('content'),
	}).done(function(data) {
		var res = "";
		if (type == 'pms')
			res = createResultPMs(data);
		else if (type == 'users')
			res = createResultUsers(data);
		else if (type == 'roles')
			res = createResultRoles(data);
		else if (type == 'tags')
			res = createResultTags(data);

		setResult(res);
	});
}

function filter(col, val) {
	return val;
}

function setResult(result) {
	$("#table-fill").html(result);
	$("#filter-pag").hide();
}

function createResultPMs(data) {
	var res = "";
	for (var i = 0; i < data.length; i++) {
		
		var persons = "";
		if (data[i].persons != undefined) {
			for (var j = 0; j < data[i].persons.length; j++) {
				persons += '<tr><td>' + data[i].persons[j].name + '</td><td>' + data[i].persons[j].pivot.assignment + '</td></tr>';
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
	return res;
}

function createResultUsers(data) {
	var res = "";
	for (var i = 0; i < data.length; i++) {
		res += '<tr>' + 
			'<td><a href="/admin/personer/andra/' + data[i].id + '" title="Ändra"><img src="/images/edit.png" alt="Ändra"></a></td>' +
			'<td><a href="/admin/personer/ta-bort/' + data[i].id + '" title="Ta bort"><img src="/images/delete.png" alt="Ta bort"></a></td>';
		if (data[i].privileges == 'Overifierad')
			res += '<td><a href="/admin/personer/verifiera/' + data[i].id + '" title="Verifiera"><img src="/images/check.png" alt="Verifiera"></a></td>';
		else
			res += '<td></td>'; 

		res += '<td>' + data[i].name + '</td>' +
			'<td>' + data[i].email + '</td>' +
			'<td>' + data[i].privileges + '</td>' +
		'</tr>';
	}
	return res;
}

function createResultRoles(data) {
	var res = "";
	for (var i = 0; i < data.length; i++) {
		res += '<tr>' + 
			'<td><a href="/admin/roller/andra/' + data[i].id + '" title="Ändra"><img src="/images/edit.png" alt="Ändra"></a></td>' +
			'<td><a href="/admin/roller/ta-bort/' + data[i].id + '" title="Ta bort"><img src="/images/delete.png" alt="Ta bort"></a></td>' +
			'<td>' + data[i].name + '</td>' +
			'<td>' + data[i].users.length + '</td>' +
		'</tr>';
	}
	return res;
}

function createResultTags(data) {
	var res = "";
	for (var i = 0; i < data.length; i++) {
		res += '<tr>' + 
			'<td><a href="/admin/taggar/andra/' + data[i].token + '" title="Ändra"><img src="/images/edit.png" alt="Ändra"></a></td>' +
			'<td><a href="/admin/tagg/' + data[i].token + '" title="Visa associerade PM"><img src="/images/pms.png" alt="Visa associerade PM"></a></td>' +
			'<td><a href="/admin/taggar/ta-bort/' + data[i].token + '" title="Ta bort"><img src="/images/delete.png" alt="Ta bort"></a></td>' +
			'<td>' + data[i].name + '</td>' +
			'<td>' + data[i].num + '</td>' +
		'</tr>';
	}
	return res;
}