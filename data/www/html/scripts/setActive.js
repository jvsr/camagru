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

	let formElement = document.querySelector("form");
	let formData = new FormData(formElement);

	let xhttp = new XMLHttpRequest();
	xhttp.onload = function () {
		if (xhttp.status === 400) {
			console.log(xhttp.response);
			console.log(xhttp.responseText);
		}
	};
	xhttp.open(formElement.method, formElement.action, true);
	xhttp.send(formData);
};

function redirectRegister() {
	event.preventDefault();
	document.location.href = "register.php";
};
