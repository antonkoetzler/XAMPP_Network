// Disables every element of the modal
function clean()
{
	document.getElementById("signup").style.display = "none";
	document.getElementById("login").style.display = "none";
	document.getElementById("post").style.display = "none";
	document.getElementById("postContainer").style.display = "none";
	document.getElementById("modal").style.display = "none";
}

function modalSignup()
{
	document.getElementById("modal").style.display = "block";
	document.getElementById("signup").style.display = "block";

	// Disable the navigation menu
	document.getElementById("navigationMenu").style.display = "none";
}

function modalLogin()
{
	document.getElementById("modal").style.display = "block";
	document.getElementById("login").style.display = "block";

	// Disable the navigation menu
	document.getElementById("navigationMenu").style.display = "none";
}

function modalPost()
{
	document.getElementById("modal").style.display = "block";
	document.getElementById("post").style.display = "block";

	// Disable the navigation menu
	document.getElementById("navigationMenu").style.display = "none";
}

/* When you click on a post within a user's profile */
function modalProfilePost(title, caption, userDirectory)
{
	document.getElementById("modal").style.display = "block";
	document.getElementById("postContainer").style.display = "flex";

	// Placing the directory as the #postImg src
	document.getElementById("postImg").src = userDirectory;

	// Setting the title, caption
	document.getElementById("title").innerHTML = title;
	document.getElementById("caption").innerHTML = caption;

	// Disable the navigation menu
	document.getElementById("navigationMenu").style.display = "none";
}

window.addEventListener('click', function(event)
{
	// Disables everything when the modal background is clicked
	if (event.target.id === "modal")
		clean();
});
