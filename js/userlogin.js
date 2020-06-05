


var username = document.getElementById('username');
var usernameValue = username.getAttribute('value');

var password = document.getElementById('password');
var passwordValue = password.getAttribute('value');


username.placeholder = function() {
	if (username.getAttribute('value') =='Username') {

		username.setAttribute('value','');

	}
};


username.onblur = function () {
	if (username.getAttribute('value')=='') {


		username.setAttribute('value','Username');
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


