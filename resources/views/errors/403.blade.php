<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>403 Unauthorize Access </title>
</head>
<body>
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{asset('app/css/error.css')}}" />
<link type="text/css" rel="stylesheet" href="{{asset('app/css/bootstrap.min.css')}}" />
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<div id="notfound">
<div class="notfound">
<div class="notfound-404">
<h3>Sorry You Are Unauthorized</h3>
<h1><span>4</span><span>0</span><span>3</span></h1>
</div>
<h2>we are sorry, You Do Not Have Privilage To View This Page </h2>
<a class="btn btn-success" href="{{route('home')}}">Back To Home</a>
</div>
</div>
</body>
</html>