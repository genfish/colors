@extends('layouts.app')

@section('title', 'Colors')

@section('content')

<h1>@lang('colors.title')</h1>
<div class="content">
	<h2>@lang('colors.subtitle')</h2>

	<img src="{{ @asset('assets/img/colors.png') }}" alt="Paleta de colors">

	<form id="upload" action="{{ URL::to('upload') }}" method="post" enctype="multipart/form-data">
		<p class="title"><strong>@lang('colors.pregunta')</strong></p>
		<input id="file" name="file" type="file" size="20">
		<input id="token" name="_token" type="hidden" value="{{ csrf_token() }}">
	</form>

	<div class="result"></div>
</div>

@endsection