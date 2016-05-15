function validateAddVendor(form) {
	var reason="";
	reason+= validateVendorName(form.artisanname);
	reason+= validateVendorEmail(form.artisanemail);
	reason+= validateVendorPw(form.artisanpw);
	reason+=validateDescription(form.artisandesc);

	if (reason!="") {
		event.preventDefault();
		alert("Some fields need correction:\n"+reason);
		return false;
	}
	return true;
}

function validateVendorName(field) {
	var error="";
	var illegalChars=/[^A-Za-z0-9 ]/;

	if (field.value=="") {
		field.className= "missing";
		error = "The required Name field is missing\n";
	}

	else if (illegalChars.test(field.value)) {
		field.className="invalid";
		error= "The artisan Name contains illegal characters.\n"
	}

	else {
		field.className='';
	}
	return error;
}

function validateVendorEmail(field) {
	var error="";
	var illegalChars=/[^A-Za-z0-9 @.]/;

	if (field.value=="") {
		field.className= "missing";
		error = "The required E-mail field is missing\n";
	}

	else if (illegalChars.test(field.value)) {
		field.className="invalid";
		error= "The artisan E-mail contains illegal characters.\n"
	}

	else {
		field.className='';
	}
	return error;
}

function validateVendorPw(field) {
	var error="";

	if (field.value=="") {
		field.className= "missing";
		error = "The required password field is missing\n";
	}
	else {
		field.className='';
	}
	return error;
}

function validateDescription(field) {
	var error="";
	var illegalChars=/[^A-Za-z0-9 ,-]/;

	if (illegalChars.test(field.value)) {
		field.className="invalid";
		error= "The description contains illegal characters.\n"
	}

	else {
		field.className='';
	}
	return error;
}

function validateEditVendor(form) {
	var reason="";
	reason+=validateDescription(form.descriptionedit);

	if (reason!="") {
		event.preventDefault();
		alert("Some fields need correction:\n"+reason);
		return false;
	}
	return true;
}