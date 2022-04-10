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
	 submitable = "true";
	 if(!(pass[0].value=== pass[1].value)){
		alert("The confirm password is incorrect!");
    submitable = "false";
	 }
	 if (submitable == "false") {
	return false;
    }
}