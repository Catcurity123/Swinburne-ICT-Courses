/* validation script */
function validate() {
        /* lấy id từ html (inport id from html) */
		var ShippingAd = document.getElementById("ShippingAd").value;
        var genm = document.getElementById("genm").checked;
        var genf = document.getElementById("genf").checked;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var pick = document.getElementById("pick").checked;
        var online = document.getElementById("online").checked;
        var visa = document.getElementById("visa").value;
        var mastercard = document.getElementById("mastercard").value;
        var americanex = document.getElementById("americanex").value;
        /* tạo var errmsg result(create var errmsg,result and) */
		var errMsg = ""; 
		var result = true; 
		/* code validate theo yêu cầu đề bài (validation code) */
        if (visa.length > 16) {
		            errMsg += "Visa Number can only be 16 digits.\n";
		}
        if (mastercard.length > 16) {
		            errMsg += "Mastercard Number can only be 16 digits.\n";
		}
        if (americanex.length > 15) {
		            errMsg += "American Express Number can only be 16 digits.\n";
		}
    
    
        if ((genm == "")&&(genf == "")){
					errMsg += "A Delivery type must be selected.\n";
					}
        if ((pick == "")&&(online == "")){
					errMsg += "A payment method must be selected.\n";
					}
        if (ShippingAd == "") {
					errMsg += "Billing Address cannot be empty.\n";
					}
        if (phone == "") {
					errMsg += "Contact Number cannot be empty.\n";
					}
        if (email == "") {
					errMsg += "Email cannot be empty.\n";
					}
        
		
		if (errMsg != "") {
		alert(errMsg);
		result = false;
		}
		return result;
		}
/* Gọi function theo html */
		function init () {
		var orform = document.getElementById("orform");
		orform.onsubmit = validate;
		}
		window.onload = init;