function validateForm()	{
      var name = document.getElementById("name").value;
      var email = document.getElementById("email").value;
      var errMsg ="";
      var result = true;
      if (name == ""){
          errMsg += "Name can not be empty.\n";
      }
      if (name.length < 2){
          result = false;
          errMsg += "Name must be at least 2 characters long.\n";
      }
      if (email == ""){
          errMsg += "Email can not be empty.\n";
      }
      if (email.indexOf('@')<=0){
          result = false;
          errMsg += "Email must contain at least 1@";
      }
      if (errMsg != ""){
          alert (errMsg);
          result = false;
      }
      return result;
}
function init (){
    var regform = document.getElementById("regform");
    regform.onsubmit = validateForm;
}        
window.onload = init;
