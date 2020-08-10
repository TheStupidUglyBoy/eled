<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<title>  @yield('page.title')  </title>
	<meta name="description" content="@yield('page.description')">
	<meta name="robots" content="index,follow"><!-- All Search Engines -->
	<meta name="googlebot" content="index,follow"><!-- Google Specific -->
	<meta name="_token" content="{{csrf_token()}}" />
	<link rel="stylesheet" href="{{asset('css/base.css')}}" >
	@yield('style')
	<!-- Favicon-->
	<link rel="shortcut icon" href="{{asset('favicon.png')}}">
	<!-- Tweaks for older IEs--><!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  
	<script src="{{asset('js/home.lib.js')}}"></script>
</head>

<body >

<x-home.navigation-home/>
@yield('page.content')






<x-home.footer-home/>
  @yield('script')
<script type="text/javascript">
	$(document).ready(function() {
		$("img").addClass("img-fluid");
    });
</script>
</body>
</html>
