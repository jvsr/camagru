function setActive () {
	const current = location.href
    var listItems = document.getElementsByClassName("navbar")[0].getElementsByTagName("ul")[0].getElementsByTagName("li");

	for (i = 0; i < listItems.length; i++) {
		var anchors = listItems[i].getElementsByTagName("a");
		for (i2 = 0; i2 < anchors.length; i2++) {
            var href = anchors[i2].href;
			if (href === current) {
				anchors[i2].className += "active";
				return ;
			}
		}
	}
};

function submitForm() {
	event.preventDefault();
	var formElement = document.querySelector("form");
	var formData = new FormData(formElement);
	var xhttp = new XMLHttpRequest();

	console.log(formData);

	xhttp.open(formElement.method, formElement.action);
	// xhttp.send();
};

function redirectRegister() {
	event.preventDefault();
	document.location.href = "register.php";
	console.log("a");
};
