<?php // Login script
if (isset($_POST['submit']))
{
	require_once 'db.inc.php';
	require_once 'functions.inc.php';

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	// Empty inputs
	if (empty($username) || empty($password))
	{
		header('location: ../index.php?error=loginEmptyInputs');
		exit();
	}

	login($con, $username, $password);
}
else
{
	header('location: ../index.php?error=loginSubmissionError');
	exit();
}
?>
