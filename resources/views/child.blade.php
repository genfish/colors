@extends('layouts.app')

@section('title', 'Colors')

@section('content')

<h1>@lang('colors.title')</h1>
<div class="content">
	<h2>@lang('colors.subtitle')</h2>

	<img src="{{ @asset('assets/img/colors.png') }}" alt="Paleta de colors">

	<form action="/result" method="post" enctype="multipart/form-data">
		<p><strong>@lang('colors.pregunta')</strong></p>
		<input type="file" name="uploadfile" size="20" onchange="this.form.submit()">
	</form>
</div>

@endsection