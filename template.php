	<link rel="stylesheet" href="css/template.css">
	<link rel="stylesheet" href="css/modal.css">
	<script src="js/template.js"></script>
	<script src="js/modal.js"></script>
</head>

<body>
	<!-- Taskbar -->
	<aside id="taskbar">
		<!-- Home button -->
		<a href="index.php">
			<img src="img/xampp.png" class="taskbarButton" style="position: relative; top: 5px;">
		</a>

		<!-- Search button -->
		<img src="img/search.png" class="taskbarButton" onclick="toggleSearchbar()">

		<!-- Navigation button -->
		<div id="navigationContainer">
			<img src="img/navigation.png" id="navigationButton" class="taskbarButton" onclick="toggleNavigation()">

			<ul id="navigationMenu">
				<li><a href="javascript:modalLogin()" id="navigationOption">Login</a></li>
				<li><a href="javascript:modalSignup()" id="navigationOption">Signup</a></li>
			</ul>
		</div>
	</aside>

	<?php include_once 'modal.php'; ?>

	<main id="container">
		<!-- Searchbar-->
		<input type="search" placeholder="Search (press esc to exit)" id="searchbar">