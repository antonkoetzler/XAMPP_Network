<?php // Signup script
if (isset($_POST['submit']))
{
	require_once 'db.inc.php';
	require_once 'functions.inc.php';

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$passwordRepeat = mysqli_real_escape_string($con, $_POST['repeatPassword']);

	// Empty (required) inputs
	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
	{
		header('location: ../index.php?error=signupEmptyInputs');
		exit();
	}
	// Invalid username
	if (!preg_match('/^[a-z\d_]{4,20}$/i', $username))
	{
		header('location: ../index.php?error=invalidUsername');
		exit();
	}
	// Invalid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header('location: ../index.php?error=invalidEmail');
		exit();
	}
	// Password mismatch
	if ($password !== $passwordRepeat)
	{
		header('location: ../index.php?error=passwordMismatch');
		exit();
	}
	// Existing username
	if (existingUsername($con, $username, $email) !== false)
	{
		header('location: ../index.php?error=existingUsername');
		exit();
	}

	createUser($con, $username, $email, $name, $password);

	// Setting the profile picture status
	$sql = "SELECT * FROM user_credentials WHERE username = '$username' AND name = '$name';";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$uid = $row['id'];

			// Status = 1 means the user has a default profile picture
			$sql = "INSERT INTO user_pfp (userid, status) VALUES ('$uid', 1);";
			mysqli_query($con, $sql);

			header('location: ../index.php?signupSuccess');
			exit();
		}
	}
	else
	{
		header('location: ../index.php?error=potentialSqlError');
		exit();
	}
}
else
{
	header('location: ../index.php?error=signupSubmissionError');
	exit();
}
?>
