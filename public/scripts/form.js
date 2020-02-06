$(function () {
	$('form').on('submit', function (e) {
		var json;
		e.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				console.log(data);
				json = jQuery.parseJSON(data);
				if (json.url) {
					window.location.href = '/' + json.url;
				} else {
					alert(json.status + ' - ' + json.message);
				}
			}
		})
	});
});

$(function () {
	$('#upload-form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				console.log(data);
				alert('список выгружен');
			}
		})
	});
});