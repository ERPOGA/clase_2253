<!DOCTYPE html>
<html>

<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<nav>
		<div class="nav-wrapper  blue lighten-5">
			<a href="#!" class="brand-logo center indigo-text text-darken-4">Logo</a>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger">
				<i class="material-icons indigo-text text-darken-">menu</i>
			</a>
			<ul class="right hide-on-med-and-down">
				<li>


				</li>
			</ul>
		</div>
	</nav>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="sass.html">Sass</a></li>
		<li><a href="badges.html">Components</a></li>
		<li><a href="collapsible.html">Javascript</a></li>
		<li><a href="mobile.html">Mobile</a></li>
	</ul>	
	
	<div class="fixed-action-btn toolbar direction-top active" style="transition: transform 0.2s cubic-bezier(0.55, 0.085, 0.68, 0.53) 0s, background-color 0s linear 0.2s; text-align: center; width: 100%; bottom: 0px; left: 0px; overflow: hidden; background-color: rgb(244, 67, 54);">
		<a class="btn-floating btn-large red" style="transition: transform 0.2s ease 0s; overflow: visible;">
			<i class="large material-icons">mode_edit</i>
			<div class="fab-backdrop" style="background-color: rgb(244, 67, 54); transform: scale(18.1); transition: transform 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s;"></div>
		</a>
		<ul>
			<li class="waves-effect waves-light"><a href="#!" style="opacity: 1;"><i class="material-icons">insert_chart</i></a></li>
			<li class="waves-effect waves-light"><a href="#!" style="opacity: 1;"><i class="material-icons">format_quote</i></a></li>
			<li class="waves-effect waves-light"><a href="#!" style="opacity: 1;"><i class="material-icons">publish</i></a></li>
			<li class="waves-effect waves-light"><a href="#!" style="opacity: 1;"><i class="material-icons">attach_file</i></a></li>
		</ul>
	</div>

	<h1>Hola Arranco el proyecto</h1>
	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="web/js/materialize.min.js"></script>
	<script>
		//edge 	String 	'left' 	Side of screen on which Sidenav appears.
		document.addEventListener('DOMContentLoaded', function() {
			M.AutoInit();
			var elems = document.querySelectorAll('.sidenav');
			options = {
				"edge": "right",
				"inDuration": 20,
				"outDuration": 2000
			};
			var instances = M.Sidenav.init(elems, options);

			var elems = document.querySelectorAll('.fixed-action-btn');
			var instances = M.FloatingActionButton.init(elems, {
				toolbarEnabled: true
			});

		});
	</script>
</body>

</html>