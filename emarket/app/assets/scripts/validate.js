function validateMail(){


	var elem = document.getElementById("mail");
	var val  = elem.value;
	var patt = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var errBox = document.getElementById("mail-error");
	if( patt.test( val ) ){
		errBox.style.display="none";
		return true;
	}
	errBox.innerHTML="Invalid E-mail Address!!";
	errBox.style.display="inline-block";
	elem.focus();
	return false;
}


/*
*** Password   Validation
*/
function  validatePassword(){

	var elem = document.getElementById("password");
	var val = elem.value;
	var errBox = document.getElementById("pass-error");
	if( !/[A-Z]/.test( val ) || !/[a-z]/.test(val) || !/[0-9]/.test(val) || !/[!@#$%^&*]/.test(val) || val.length<6 ){
		errBox.innerHTML = "Invalid Password!!";
		errBox.style.display = "inline-block";
		//alert(val);
		elem.focus();
		return false;
	}
	errBox.style.display = "none";
	return true;

}


/*
*** Name Validation
*/
function validateName( elem ){

	// var elem = document.getElementById("name");
	var val  = elem.value;
	var errBox = document.getElementById("name-error");
	if( !/^[a-z A-Z]{4,20}$/.test( val ) ){
		errBox.innerHTML = "Invalid Name!.Should Contain 4-20 Alpha Numeric Caharacters!";
		errBox.style.display = "inline-block";
		return false;
	}
	errBox.style.display = "none";
	return true;
}

/*
*** UID Validation
*/
function validateUid(elem){
	// var elem = document.getElementById("userId");
	var val  = elem.value;
	var errBox = document.getElementById("id-error");
	if( val.length<5 || val.length>15 ){
		errBox.innerHTML = "Length of User Id Can Be 5-15!";
		errBox.style.display = "inline-block";
		elem.focus();
		return false;
	}
	errBox.style.display = "none";
	return true;
}

/*
*** ZIP Validation
*/
function validateZip(elem){
	// var elem = document.getElementById("zip");
	var val  = elem.value;
	var errBox = document.getElementById("zip-error");
	if( !/^[0-9]{4}$/.test(val) ){
		errBox.innerHTML = "Invalid Zip Code!!";
		errBox.style.display = "inline-block";
		elem.focus();
		return false;
	}
	errBox.style.display = "none";
	return true;

}


function validateCountry(){
	var elem = document.getElementById("country");
	var val  = elem.value;
	var errBox = document.getElementById("country-error");
	if( val<0 ){
		errBox.innerHTML = "You Must Select A Country!";
		errBox.style.display = "inline-block";
		elem.focus();
		return false;
	}
	errBox.style.display = "none";
	return true;

}

function validateSex(){
	var eb;
	eb = document.getElementById("sex-error");
	if( !(document.form1.sex.value=="female" || document.form1.sex.value=="male") ){
		alert(document.form1.sex.value);
		eb.innerHTML = "You Must Select Any Gender";
		eb.style.display = "inline-block";
		return false;
	}
	
	eb.style.display="none";
	return true;

}

function validateLang(){
	var eb = document.getElementById("lang-error");
	if( !document.form1.lang1.checked && !document.form1.lang2.checked ){
		eb.innerHTML = "You Must Select At Least One Language Version!";
		eb.style.display = "inline-block";
		return false;
	}
	eb.style.disabled="none";
	return true;
}




function validate(){

	var res = true;
	res = validateUid() && validatePassword() && validateName()  && validateMail();
	return res;

}