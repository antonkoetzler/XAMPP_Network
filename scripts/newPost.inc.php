<?php // New post script
session_start();
require_once 'db.inc.php';

if (isset($_SESSION['id']))
{
	if (isset($_POST['submit']))
	{
		$title = mysqli_real_escape_string($con, $_POST['title']);
		$caption = mysqli_real_escape_string($con, $_POST['caption']);
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
						// Asserting the title is >= 100 characters
						if (strlen($title) <= 100)
						{
							$fileDestination = "../users/".$_SESSION['username']."/".$file['name'];
							move_uploaded_file($file['tmp_name'], $fileDestination);

							// Inserting the post into user_content in the user db
							$sql = "INSERT INTO user_content (userid, title, caption, filename) VALUES (?, ?, ?, ?);";
							$stmt = mysqli_stmt_init($con);

							if (!mysqli_stmt_prepare($stmt, $sql))
							{
								header('location: ../profile.php?error=postStmtError');
								exit();
							}

							mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['id'], $title, $caption, $file['name']);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);

							header('location: ../profile.php?postSuccess');
							exit();
						}
						else
						{
							header('location: ../profile.php?error=postTitleTooLong');
							exit();
						}
					}
					else
					{
						header('location: ../profile.php?error=postFileTooLarge');
						exit();
					}
				}
				else
				{
					header('location: ../profile.php?error=postFileError');
					exit();
				}
			}
			else
			{
				header('location: ../profile.php?error=postInvalidExtension');
				exit();
			}
		}
		else
		{
			header('location: ../profile.php?error=postEmptyFile');
			exit();
		}
	}
	else
	{
		header('location: ../index.php?error=postSubmissionError');
		exit();
	}
}
else
{
	header('location: ../index.php?error=postNoSession');
	exit();
}
?>