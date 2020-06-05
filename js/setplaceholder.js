

var fname = document.getElementById('fname');
var fnameValue = fname.getAttribute('value');
var lname = document.getElementById('lname');
var lnameValue = lname.getAttribute('value');
var username = document.getElementById('username');
var usernameValue = username.getAttribute('value');
var email = document.getElementById('email');
var emailValue = email.getAttribute('value');
var email2 = document.getElementById('email2');
var email2Value = email2.getAttribute('value');
var password = document.getElementById('password');
var passwordValue = password.getAttribute('value');
var password2 = document.getElementById('password2');
var password2Value = password2.getAttribute('value');









fname.onfocus = function() {
	if (fname.getAttribute('value') =='First Name') {

		fname.setAttribute('value','');

	}
};


fname.onblur = function () {
	if (fname.getAttribute('value')=='') {


		fname.setAttribute('value','First Name');
	}
};



lname.onfocus = function() {
	if (lname.getAttribute('value') =='Last Name') {

		lname.setAttribute('value','');

	}
};


lname.onblur = function () {
	if (lname.getAttribute('value')=='') {


		lname.setAttribute('value','Last Name');
	}
};



username.onfocus = function() {
	if (username.getAttribute('value') =='Username') {

		username.setAttribute('value','');

	}
};


username.onblur = function () {
	if (username.getAttribute('value')=='') {


		username.setAttribute('value','Username');
	}
};

 email.onfocus = function() {
	if  (email.getAttribute('value') =='Email') {

	 email.setAttribute('value','');

	}
};

 email.onblur = function () {
	if  (email.getAttribute('value')=='') {


	 email.setAttribute('value','Email');
	}
};


email2.onfocus = function() {
	if (email2.getAttribute('value') =='Confirm email') {

		email2.setAttribute('value','');

	}
};


email2.onblur = function () {
	if (email2.getAttribute('value')=='') {


		email2.setAttribute('value','Confirm email');
	}
};


password.onfocus = function() {
	if (password.getAttribute('value') =='Password') {

		password.setAttribute('value','');

	}
};


password.onblur = function () {
	if (password.getAttribute('value')=='') {


		password.setAttribute('value','Password');
	}
};


password2.onfocus = function() {
	if (password2.getAttribute('value') =='Confirm password') {

		password2.setAttribute('value','');

	}
};


password2.onblur = function () {
	if (password2.getAttribute('value')=='') {


		password2.setAttribute('value','Confirm password');
	}
};






