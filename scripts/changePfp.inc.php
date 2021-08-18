<?php
session_start();
require_once 'db.inc.php';

if (isset($_SESSION['id']))
{
	if (isset($_POST['submit']))
	{
		$file = $_FILES['file'];

		// Breaking the file name into pieces
		// Asserts there is a file and an extension
		$fileParse = explode('.', $file['name']);

		// Asserting there is an extension and a name, so an array of size 2
		if (sizeof($fileParse) >= 2)
		{
			$fileExtension = strtolower(end($fileParse));
			$allowedExtensions = array('jpg', 'jpeg', 'png');

			// Checking if the extension is allowed
			if (in_array($fileExtension, $allowedExtensions))
			{
				// Asserting the file isn't corrupted
				if ($file['error'] === 0)
				{
					// Asserting the file is less than 2MB
					if ($file['size'] <= 2000000)
					{
						// New file name formatting: userid.extension (ex: 1.png)
						$newFileName = $_SESSION['id'].'.'.$fileExtension;
						// All pfps are stored in htdocs/pfps
						$fileDestination = '../pfps/'.$newFileName;
						move_uploaded_file($file['tmp_name'], $fileDestination);
						// Moving the file to the pfps directory
						$id = $_SESSION['id'];
						$sql = "UPDATE user_pfp SET status = 0 WHERE userid = '$id';";
						mysqli_query($con, $sql);

						header('location: ../profile.php?pfpChanged');
						exit();
					}
					else
					{
						header('location: ../profile.php?error=pfpFileTooLarge');
						exit();
					}
				}
				else
				{
					header('location: ../profile.php?error=pfpFileError');
					exit();
				}
			}
			else
			{
				header('location: ../profile.php?error=pfpInvalidExtension');
				exit();
			}
		}
		else
		{
			header('location: ../profile.php?error=pfpEmptyFile');
			exit();
		}
	}
	else
	{
		header('location: ../index.php?error=pfpSubmissionError');
		exit();
	}
}
else
{
	header('location: ../index.php?error=noSession');
	exit();
}
?>