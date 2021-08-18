<div id="modal">
	<form action="scripts/signup.inc.php" method="post" class="form" id="signup">
		<input type="text" placeholder="Username" name="username" style="margin-top: 10px;">
		<input type="text" placeholder="Email" name="email">
		<input type="text" placeholder="Name" name="name">
		<input type="password" placeholder="Password" name="password">
		<input type="password" placeholder="Repeat password" name="repeatPassword">
		<input type="submit" value="Signup" name="submit" id="submit">
	</form>

	<form action="scripts/login.inc.php" method="post" class="form" id="login">
		<input type="text" placeholder="Username" name="username" style="margin-top: 10px;">
		<input type="password" placeholder="Password" name="password">
		<input type="submit" value="Login" name="submit" id="submit">
	</form>

	<form action="scripts/newPost.inc.php" method="post" enctype="multipart/form-data" class="form" id="post">
		<input type="text" placeholder="Title" name="title" style="margin-top: 10px;">
		<textarea placeholder="Caption" name="caption"></textarea>
		<input type="file" placeholder="Picture" name="file" style="height: 30px; padding-top: 5px;">
		<input type="submit" value="Post" name="submit" id="submit">
	</form>

	<!-- Container for looking at pictures/documents -->
	<section id="postContainer">
		<img id="postImg">

		<div id="postInfo">
			<h1 style="margin-top: 5px;">Title</h1>
			<span id="title"></span>
			<h1>Caption</h1>
			<span id="caption"></span>
		</div>
	</section>
</div>
