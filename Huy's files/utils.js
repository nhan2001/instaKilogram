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