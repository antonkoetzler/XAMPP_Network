<?php
function existingUsername($con, $username, $email)
{
	$sql = "SELECT * FROM user_credentials WHERE username = ? OR email = ?;";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header('location: ../index.php?error=stmtPrepare');
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	mysqli_stmt_close($stmt);

	if ($row = mysqli_fetch_assoc($result))
		return $row;
	else
		return false;
}

function createUser($con, $username, $email, $name, $password)
{
	$sql = "INSERT INTO user_credentials (username, email, name, password) VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($con);

	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		header('location: ../index.php?error=sqlError');
		exit();
	}

	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $name, $hashedPassword);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	// xampp/htdocs/users/username
	mkdir("../users/".$username);
}

function login($con, $username, $password)
{
	// Since our query checks for username OR email, we may use password
	$usernameExists = existingUsername($con, $username, $password);

	if ($usernameExists === false)
	{
		header('location: ../index.php?error=wrongLogin');
		exit();
	}

	// Verifying hashedPassword
	if (password_verify($password, $usernameExists['password']))
	{
		session_start();

		$_SESSION['id'] = $usernameExists['id'];
		$_SESSION['username'] = $usernameExists['username'];

		header('location: ../index.php?loginSuccess');
		exit();
	}
	else
	{
		header('location: ../index.php?error=wrongLogin');
		exit();
	}
}
?>
