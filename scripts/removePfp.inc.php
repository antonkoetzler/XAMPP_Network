<?php
session_start();
require_once 'db.inc.php';

if (isset($_SESSION['id']))
{
	// Makes life easier
	$id = $_SESSION['id'];

	$file = "../pfps/".$id."*";

	// Finding common files to the string above, getting the pfp file
	$fileGlob = glob($file);

	// Splitting the string to get the extension
	$fileParse = explode('.', end($fileGlob));
	$fileExtension = strtolower(end($fileParse));

	$fileName = "../pfps/".$id.".".$fileExtension;

	// Deleting the file
	if (!unlink($fileName))
	{
		header('location: ../profile.php?error=pfpNotDeleted');
		exit();
	}

	// Updating user_pfp status to 1 again
	$sql = "UPDATE user_pfp SET status = 1 WHERE userid = '$id';";
	mysqli_query($con, $sql);

	header('location: ../profile.php?pfpDeleted');
	exit();
}
else
{
	header('location: ../profile.php?error=pfpNoSession');
	exit();
}
?>