
$(document).ready(function() {

	$('#file').on("change", function() {
		$('#upload').submit();
	});

	$('#upload').on("submit", function(event) {
		$('.result').html('<h3>carregant...</h3>');

		$elem = $(event.currentTarget);

		type	= $elem.attr('method');
		url		= $elem.attr('action');
		token	= $elem.find('#token').val();

		dataFiles = new FormData();

		$elem.find('[type=file]').each(function() {
			$.each(this.files, function(key, value) {
				dataFiles.append('file', value);
			});
		});

		$.ajax({
			cache		: false
		,	contentType	: false
		,	beforeSend	: function() {}
		,	data		: dataFiles
		,	dataType	: 'json'
		,	headers		: {
				'X-CSRF-TOKEN': token
			}
		,	processData	: false
		,	type		: type
		,	url			: url
		})
		.done(function(data) {
			$(".result").html(data.html);
		})
		.fail(function(data) {
			$(".result").html("<p>Format d'imatge incorrecte.</p>");
		});

		return false;
	});
});
