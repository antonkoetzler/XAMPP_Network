<?php session_start(); ?>

	<link rel="stylesheet" href="css/template.css">
	<link rel="stylesheet" href="css/modal.css">
	<script src="js/template.js"></script>
	<script src="js/modal.js"></script>
</head>

<body>
	<aside id="taskbar">
		<!-- Home button -->
		<a href="index.php">
			<img src="img/logo.png" style="margin-top: 5px;">
		</a>

		<!-- Search button -->
		<img src="img/search.png" onclick="toggleSearchbar()">

		<!-- Navigation menu -->
		<div id="navigationContainer">
			<img src="img/navigation.png" id="navigationButton" onclick="toggleNavigation()">

			<?php

			// If the user isn't signed in
			if (!isset($_SESSION['id']))
				echo '
				<ul id="navigationMenu">
					<li><a href="javascript:modalLogin()" id="navigationOption">Login</a></li>
					<li><a href="javascript:modalSignup()" id="navigationOption">Signup</a></li>
				</ul>
				';
			else
				echo '
				<ul id="navigationMenu">
					<li><a href="profile.php" id="navigationOption">Your Profile</a></li>
					<li><a href="scripts/logout.inc.php" id="navigationOption">Logout</a></li>
				</ul>
				';
			?>		
		</div>

		<!-- Post button -->
		<?php
		if (isset($_SESSION['id']))
			echo '<img src="img/newPost.png" onclick="modalPost()">';
		?>
	</aside>

	<?php include_once 'modal.php'; ?>

	<main id="container">
		<input type="search" placeholder="Search (press escape to exit)" id="searchbar">
