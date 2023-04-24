let email = document.querySelector("#email");
let password = document.querySelector("#password");
let message = document.querySelector("#message");
let login = document.querySelector("#login");

function isLogin() {
  if (email.value == "") {
    document.getElementById("message").innerText = "Empty email field";
    return false;
  } else if (password.value == "") {
    document.getElementById("message").innerText = "Empty password field";
    return false;
  } else {
    return true;
  }
}
login.addEventListener("submit", (e) => {
  if (isLogin() == false) {
    e.preventDefault();
  }
});
