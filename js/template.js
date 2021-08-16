function toggleSearchbar()
{
	var searchbar = document.getElementById("searchbar");

	if (window.getComputedStyle(searchbar).display == "none")
		searchbar.style.display = "block";
	else
		searchbar.style.display = "none";
}

function toggleNavigation()
{
	var navigationMenu = document.getElementById("navigationMenu");

	if (window.getComputedStyle(navigationMenu).display == "none")
		navigationMenu.style.display = "block";
	else
		navigationMenu.style.display = "none";
}

window.addEventListener('keydown', function(event)
{
	if (event.key === "Escape")
		document.getElementById("searchbar").style.display = "none";
});
window.addEventListener('click', function(event)
{
	// Disables the navigation menu on click anywhere on screen
	if (event.target.id !== "navigationButton" && event.target.id !== "navigationOption")
		document.getElementById("navigationMenu").style.display = "none";
});