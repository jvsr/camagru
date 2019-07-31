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

function redirectRegister() {
	event.preventDefault();
	document.location.href = "register.php";
};

function changeBorderFormInput(id, key, bool) {
	let formInput = document.getElementById(id).elements[key];

	if ((bool === true && !formInput.classList.contains("redBorder"))
	|| (bool === false && formInput.classList.contains("redBorder"))) {
		formInput.classList.toggle("redBorder");
	}
}
function validateFormInput(id, jsonData) {
	var returnValue = true;

	for (var key in jsonData) {
		var length = jsonData[key].length;
		if (length <= 0) {
			changeBorderFormInput(id, key, true);
			returnValue = false;
		} else {
			changeBorderFormInput(id, key, false);
		}
	}
	return (returnValue);
}

function createJsonFromFormData(formData) {
	let jsonData = {}
	for (const [key, value] of formData.entries()) {
		jsonData[key] = value;
	}
	return (jsonData);
}
function submitForm(id) {
	event.preventDefault();

	let formElement = document.getElementById(id);
	let formData = new FormData(formElement);
	
	let jsonData = createJsonFromFormData(formData);

	if (!validateFormInput(id, jsonData))
		return;

	fetch(formElement.action, {
        method: formElement.method,
		body: JSON.stringify(jsonData),
        headers: {
            'Content-Type': 'application/json'
        }
	})
	.then(response => {
		response.json().then(json => {
            if (response.status === 200) {
				// location.replace('/');
			}
			console.log('Success:', json);
		})
	})
	.catch(error => console.error('Error:', error));
};
