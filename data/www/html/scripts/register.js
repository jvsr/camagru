function changeBorderFormInput(id, key, bool) {
	let formInput = document.getElementById(id).elements[key];

	if ((bool === true && !formInput.classList.contains("redBorder"))
	|| (bool === false && formInput.classList.contains("redBorder"))) {
		formInput.classList.toggle("redBorder");
	}
}

function validateFormInputPassword(id, key, length) {
	if (length < 6) {
		changeBorderFormInput(id, key, true);
		return false;
	}
	changeBorderFormInput(id, key, false);
	return true;
}

function validateFormInputEmail(id, key, jsonData) {
	var regex = /^[a-z0-9\._%+!$&*=^|~#%'`?{}/\-]+@([a-z0-9\-]+\.){1,}([a-z]{2,16})$/;

	if (!regex.test(jsonData[key])) {
		changeBorderFormInput(id, key, true);
		return false;
	}
	changeBorderFormInput(id, key, false);
	return true;
}

function validateFormInput(id, jsonData) {
	var returnValue = true;

	for (var key in jsonData) {
		var length = jsonData[key].length;
		if (length <= 0) {
			changeBorderFormInput(id, key, true);
			returnValue = false;
		} else if (key === "password") {
			if (validateFormInputPassword(id, key, length) === false) {
				returnValue = false;
			}
		} else if (key === "email") {
			if (validateFormInputEmail(id, key, jsonData) === false) {
				returnValue = false;				
			}
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

function removeClass(divClass) {
	var allDiv = document.getElementsByClassName(divClass);
	while(allDiv[0])
		allDiv[0].parentNode.removeChild(allDiv[0]);
}

function displayMessage(divClass, response) {
	removeClass('confirmationBox');
	removeClass('errorBox');
	var creationMessage = document.createElement('div');
	creationMessage.className += divClass;

	var messageH1 = document.createElement('h1');
	messageH1.innerHTML = response['message'];

	creationMessage.appendChild(messageH1);
	document.body.appendChild(creationMessage);
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
				displayMessage('confirmationBox', json);
			} else {
				displayMessage('errorBox', json);
			}
			console.log('Success:', json);
		})
	})
	.catch(error => console.error('Error:', error));
};
