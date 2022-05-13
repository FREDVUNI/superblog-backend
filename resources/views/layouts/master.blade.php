<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Superblog | dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="dist/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="dist/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper" id="app">
		<footer class="main-footer text-sm">
			<strong>Copyright &copy; {{ date('Y')}} <a href="https://Superblog.io">Superblog</a>.</strong> All rights reserved.
		</footer>
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="dist/js/adminlte.min.js"></script>
		<script src="dist/js/jquery.dataTables.min.js"></script>
		<script src="dist/js/dataTables.bootstrap4.min.js"></script>
		<script src="dist/js/dataTables.responsive.min.js"></script>
		<script src="dist/js/responsive.bootstrap4.min.js"></script>
	</div>
	{{-- <script src="dist/js/jquery.min.js"></script> --}}
</body>
</html>
