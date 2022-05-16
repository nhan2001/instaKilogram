
document.cookie = "abc=false"; // for testing purpose
function display() {
  document.getElementById("popup").style.display = "none"
}
// "i understand" button in action
let accept= document.getElementById("accept");
accept.onclick= function(){
    setCookie();
}
// cookie setter
 let setCookie= function(){
  document.cookie = "Accepted=true";
  if(document.cookie){ // Check if cookies are allowed
    document.getElementById("popup").innerHTML = "Your related cookies have been stored. ";
	myTimeout = setTimeout(display, 2000);
  }else{
    alert("Set cookie is unsuccessful.Please enable cookies in your browser");
  }
 }
// cookie getter
let getCookie= function(){ 
  let nameGet = "Accepted=true";
  let tokens = document.cookie.split(';');
  for(let i = 0; i < tokens.length; i++) { //[1]
    let c = tokens[i];
    while (c.charAt(0) == ' ') { //This code is to truncate all beginning spaces of cookies yielded in an array tokens.
      c = c.substring(1);
    }
    if (c.indexOf(nameGet) == 0) {
      return "true";
    }
  }
  return "";
}
// check cookie status
let isSetCookie= function(){
    let value=getCookie();
    if(value!=""){
        document.getElementById("popup").innerHTML = "Welcome back!!";
		myTimeout = setTimeout(display, 2000);
    }else{
        
        document.getElementById("popup").style.display = "block";
    }
}
isSetCookie();

//[1] W3schools.com. 2018.JavaScript Cookies. [online] Available at: <https://www.w3schools.com/js/js_cookies.asp> [Accessed 12 May 2022].
