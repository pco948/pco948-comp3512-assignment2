/* JavaScript file to check for empty fields in the login form. 
   If there are empty fields when the submit button is clicked, the fields will be highlighed red.
*/

//Gets the Submit button and adds an event listener to check for empty fields.
var submit = document.getElementById("submit");
submit.addEventListener("click", function(e) {
	var required = document.querySelectorAll(".required");
	var missing = new Array();
	var nonMissing = new Array();
	for (var j = 0; j < required.length; j++) {
		if (isEmpty(required[j])) {
			missing.push(required[j]);
		} else {
			nonMissing.push(required[j]);
		}
	}
	if (missing.length > 0) {
		addClass(missing);
		e.preventDefault();
	}
});

//Function to check if the passed element is empty. 
function isEmpty(element) {
	if (element.value == "") {
		return true;
	} else {
		return false;
	}
}

//Function to add the error class to the element(s) in the passed array. 
function addClass(missing) {
	for (var q = 0; q < missing.length; q++) {
		var element = document.getElementById(missing[q].id);
		element.classList.add("error");
	}
}

//Function to remove the error class to the element(s) if they are no longer empty.
var req = document.querySelectorAll(".required")
for (var i = 0; i < req.length; i++) {
	req[i].addEventListener("change", function(e) {
		var element = document.getElementById(e.target.id);
		element.classList.remove("error");
	})
}

