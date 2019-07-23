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

function createJsonFromFormData(formData) {
	let jsonData = {}

	for (const [key, value] of formData.entries()) {
		jsonData[key] = value;
	}

	return (jsonData);
}

function submitForm() {
	event.preventDefault();

	let formElement = document.querySelector("form");
	let formData = new FormData(formElement);

	let jsonData = createJsonFromFormData(formData);


	fetch(formElement.action, {
        method: formElement.method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
        })
    .then(res => res.json())
	.then(res => console.log(res)) 
	
	// let xhttp = new XMLHttpRequest();
	// xhttp.open(formElement.method, formElement.action, true);

	// xhttp.send(JSON.stringify(jsonData));
};

function redirectRegister() {
	event.preventDefault();
	document.location.href = "register.php";
};
