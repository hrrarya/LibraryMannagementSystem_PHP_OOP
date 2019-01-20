function confirmDelete(anchor){
	var confirm = confirm("Are you sure?");
	if (confirm) {
		window.location = anchor.attr("href");
	}
}