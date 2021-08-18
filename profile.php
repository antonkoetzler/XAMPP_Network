<!DOCTYPE html>

<html>

<head>
	<link rel="stylesheet" href="css/profile.css">

<?php include_once 'template.php'; ?>

		<header id="profileHeader">
			<!-- Remove profile picture -->
			<?php
			if (empty($_GET['user']))
				echo '
					<a href="scripts/removePfp.inc.php">
						<span>Remove Profile Picture</span>
					</a>
				';
			?>

			<!-- Profile picture and username -->
			<section>
				<?php
				include_once 'scripts/db.inc.php';

				$profileId; // ID to display profile information

				// Getting either session or ?user ID
				if (empty($_GET['user']))
				{
					if (isset($_SESSION['id']))
					{
						$profileId = $_SESSION['id'];
					}
					else
					{
						header('location: ../index.php?error=noSession');
						exit();
					}
				}
				else
				{
					$profileId = $_GET['user'];
				}

				// Getting the profile picture status
				$sql = "SELECT * FROM user_pfp WHERE userid = '$profileId';";
				$result = mysqli_query($con, $sql);

				// Displaying the profile picture
				if (mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_assoc($result))
					{
						// Default profile picture
						if ($row['status'] == 1)
						{
							echo '<img src="img/defaultPfp.png">';
						}
						// User has set their profile picture
						else
						{
							$fileName = "pfps/".$profileId."*";
							$fileGlob = glob($fileName);
							$fileParse = explode('.', end($fileGlob));
							$fileExtension = end($fileParse);
							$pfpDirectory = "pfps/".$profileId.".".$fileExtension;
							echo '<img src="'.$pfpDirectory.'">';
						}
					}
				}

				// Getting the username
				$sql = "SELECT * FROM user_credentials WHERE id = '$profileId';";
				$result = mysqli_query($con, $sql);

				// Printing the username
				if (mysqli_num_rows($result) > 0)
					while ($row = mysqli_fetch_assoc($result))
						echo '<p>'.$row['username'].'</p>';
				?>
			</section>

			<!-- Change profile picture -->
			<?php
			if (empty($_GET['user']))
				echo '
					<form action="scripts/changePfp.inc.php" method="post" enctype="multipart/form-data">
						<input type="file" placeholder="New Picture" name="file" style="padding: 10px 5px 5px 5px;">
						<input type="submit" value="Change Profile Picture" name="submit" id="changeSubmit" style="width: 200px; height: 40px; font-size: 16px;">
					</form>
				';
			?>
		</header>

		<section id="profileContent">
			<?php // Printing the user's contents

			// Getting the username
			$sql = "SELECT * FROM user_credentials WHERE id = '$profileId';";
			$result = mysqli_query($con, $sql);

			// With the username result, we'll have the user's profile directory (htdocs/users/USER)
			$userDirectory;

			if (mysqli_num_rows($result) > 0)
				while ($row = mysqli_fetch_assoc($result))
					$userDirectory = "users/".$row['username']."/";

			// Getting the user's posts
			$sql = "SELECT * FROM user_content WHERE userid = '$profileId';";
			$result = mysqli_query($con, $sql);

			// Looping through every post, and displaying them on the profile page
			if (mysqli_num_rows($result) > 0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$fileName;
					// Asserting the filename isn't too large
					if (strlen($row['filename']) > 25)
					{
						// Making sure the filename isn't too large within the page
						$fileParse = explode('.', $row['filename']);
						$fileExtension = strtolower(end($fileParse));

						// Cutting the file name
						$fileName = substr($row['filename'], 0, 20);
						$fileName .= ".".$fileExtension;
					}
					else
					{
						$fileName = $row['filename'];
					}

					// Creating arguments for our JS function to display these posts
					$title = "'".$row['title']."'";
					$caption = "'".$row['caption']."'";
					$fileDirectory = "'".$userDirectory.$row['filename']."'"; // We need quotes around everything...

					echo '
						<div onclick="modalProfilePost('.$title.', '.$caption.', '.$fileDirectory.')">
							<span id="title">'.$row['title'].'</span>
							<span id="caption">'.$row['caption'].'</span>
							<span id="filename">'.$fileName.'</span>
						</div>
					';
				}
			}


			?>
		</section>
	</main>
</body>

</html>