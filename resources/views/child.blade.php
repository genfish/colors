@extends('layouts.app')

@section('title', 'Colors')

@section('content')

<h1>@lang('colors.title')</h1>
<div class="content">
	<h2>@lang('colors.subtitle')</h2>

	<img src="{{ @asset('assets/img/colors.png') }}" alt="Paleta de colors">

	<form id="upload" action="{{ URL::to('upload') }}" method="post" enctype="multipart/form-data">
		<p><strong>@lang('colors.pregunta')</strong></p>
		<input id="uploadfile" name="uploadfile" type="file" size="20">
		<input id="token" name="_token" type="hidden" value="{{ csrf_token() }}">
	</form>

	<div class="result"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$('#uploadfile').on("change", function() {
			$('#upload').submit();
		});

		$('#upload').on("submit", function(event) {
			$elem = $(event.currentTarget);

			type	= $elem.attr('method');
			url		= $elem.attr('action');
			token	= $elem.find('#token').val();

			dataFiles = new FormData();
			$elem.find('[type=file]').each(function() {
				$.each(this.files, function(key, value) {
					dataFiles.append(key, value);
				});
			});

			$.ajax({
				type		: type
			,	url			: url
			,	cache		: false
			,	data		: dataFiles
			,	dataType	: 'json'
			,	processData	: false
			,	contentType	: false
			,	headers		: {
					'X-CSRF-TOKEN': token
				}
			,	beforeSend	: function() {}
			})
			.done(function(data) {
console.log(data);
				$(".result").html(data);
			});

			return false;
		});
	});
</script>

@endsection