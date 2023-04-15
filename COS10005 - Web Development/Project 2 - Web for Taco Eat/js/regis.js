/* validation script */
function validate() {
        /* lấy id từ html (inport id from html) */
		var email = document.getElementById("email").value;
		var pwd1 = document.getElementById("pwd1").value;
		var pwd2 = document.getElementById("pwd2").value;
		var fullname = document.getElementById("fullname").value;
        var username = document.getElementById("username").value; 
        var phone = document.getElementById("phone").value;
        var genm = document.getElementById("genm").checked;
        var genf = document.getElementById("genf").checked;
        var genn = document.getElementById("genn").checked;  
        /* tạo var errmsg result và pattern (create var errmsg,result and pattern) */
		var errMsg = ""; 
		var result = true; 
		var pattern = /^[a-zA-Z ]+$/; 
        /* code validate theo yêu cầu đề bài (validation code) */
        if (pwd1.length < 9) {
		            errMsg += "Passwords must be at least 8 characters.\n";
		}
        if (email == "") {
					errMsg += "Email cannot be empty.\n";
					}
        if (username == "") {
					errMsg += "Username cannot be empty.\n";
					}
        if (phone == "") {
					errMsg += "Phone Number cannot be empty.\n";
					}
        if (pwd1 == "") {
					errMsg += "Password cannot be empty.\n";
					}
        if (pwd2 == "") {
					errMsg += "Password confirmation cannot be empty.\n";
					}
        if (fullname == "") {
					errMsg += "Full Name cannot be empty.\n";
					}
        if ((genm == "")&&(genf == "")&&(genn == "")) {
					errMsg += "A gender must be selected.\n";
					}
		
		if (email.indexOf('@') == 0 ) {
			errMsg += "Email cannot start with an @ symbol.\n";
			}
			if (email.indexOf('@') < 0 ) {
			errMsg += "Email must contain an @ symbol.\n";
			}
		
		if (pwd1 != pwd2) {
		errMsg += "Passwords do not match.\n";
		}
            
		if (! fullname.match (pattern)) {
		errMsg += "Full Name can not contain symbols.\n";
		}
		
		if (errMsg != "") {
		alert(errMsg);
		result = false;
		}
		return result;
		}
		/* Gọi function theo html */
		function init () {
		var regForm = document.getElementById("regform");
		regForm.onsubmit = validate;
		}
		window.onload = init;
