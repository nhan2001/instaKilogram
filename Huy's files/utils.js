function show() {
  const x = document.getElementsByClassName("abc");
  if (x[0].type === "password" && x[1].type === "password") {
    x[0].type = "text";
    x[1].type = "text";
  } else {
    x[0].type = "password";
    x[1].type = "password";
  }
}
function verify(){
	 var pass = document.getElementsByClassName("abc");
	 var name = document.getElementsByClassName("name");
	 submitable = "true";
	 if(!(pass[0].value=== pass[1].value)){
		alert("The confirm password is incorrect!");
    submitable = "false";
	 }
	 else if(!(name[0].value.length>=2&&name[0].value.length<=20&&name[1].value.length>=2&&name[1].value.length<=20)){
		alert("First Name and Last Name must be from 2 to 20 any characters");
    submitable = "false";
	 }
	else if(!(pass[0].value.length>=8&&pass[0].value.length<=20)){
		alert("Password must be from 8 to 20 characters");
    submitable = "false";
	 }
	 else if(!(containsLC(pass[0].value)&&containsUC(pass[0].value)&&containsDigit(pass[0].value))){
		 alert("Password must contains atleast one lowercase letter, one uppercase letter and one digit");
    submitable = "false";
	 }
	 if (submitable == "false") {
	return false;
    }
}
function containsLC(str) {
    return str.match(/[a-z]/);
}
function containsUC(str) {
    return str.match(/[A-Z]/);
}
function containsDigit(str) {
    return str.match(/[0-9]/);
}