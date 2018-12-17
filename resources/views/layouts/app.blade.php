<html>
	<head>
		<title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}"/>
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
	</body>
</html>