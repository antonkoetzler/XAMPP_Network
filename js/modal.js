// Disables everything in the modal
function clean()
{
	document.getElementById("signup").style.display = "none";
	document.getElementById("modal").style.display = "none";
}

function modalSignup()
{
	document.getElementById("modal").style.display = "block";
	document.getElementById("signup").style.display = "block";

	// Disable navigation menu
	document.getElementById("navigationMenu").style.display = "none";
}

window.addEventListener('click', function(event)
{
	// Disable when the modal background is clicked
	if (event.target == modal)
		clean();
});