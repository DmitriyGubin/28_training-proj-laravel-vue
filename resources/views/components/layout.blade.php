<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title }}</title>
		<!-- @vite(['resources/css/app.scss','resources/js/app.js']) -->
		<link rel="preload" as="style" href="/public/build/assets/app-CQUNt_Rm.css">
		<link rel="preload" as="style" href="/public/build/assets/app-BX9K7OKd.css">
		<link rel="modulepreload" href="/public/build/assets/app-p92UEJO9.js">
		<link rel="stylesheet" href="/public/build/assets/app-CQUNt_Rm.css">
		<link rel="stylesheet" href="/public/build/assets/app-BX9K7OKd.css">
		<script type="module" src="/public/build/assets/app-p92UEJO9.js"></script>
	</head>
	<body>
		<div class="main_wrapper">
			<div>
				<x-header />
				<div class="wrap">
					{{ $slot }}
				</div>
			</div>
			<x-footer />
		</div>
		<div style="display: none;" id="sucsess_popup">
			Письмо доставлено!
		</div>
		<script type="module" src="/public/js/main.js"></script>
	</body>
</html> 