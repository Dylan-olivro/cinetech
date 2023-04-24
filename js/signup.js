let username = document.querySelector("#username");
let email = document.querySelector("#email");
let password = document.querySelector("#password");
let cpassword = document.querySelector("#cpassword");
let formSignUp = document.querySelector("#signup");
let message = document.querySelector("#message");
// laplateforme.io 15 carac

function isSignUp() {
  if (username.value == "") {
    document.getElementById("message").innerText = "Empty username field";
    return false;
  } else if (username.value.length < 4) {
    document.getElementById("message").innerText = "Username is too short";
    return false;
  } else if (email.value == "") {
    document.getElementById("message").innerText = "Empty email field";
    return false;
  }
  // else if (!email.value.endsWith("@laplateforme.io")) {
  //   document.getElementById("message").innerText = "Wrong domain name";
  //   return false;
  // }
  else if (password.value == "") {
    document.getElementById("message").innerText = "Empty password field";
    return false;
  } else if (cpassword.value == "") {
    document.getElementById("message").innerText =
      "Empty confirm password field";
    return false;
  } else if (password.value !== cpassword.value) {
    document.getElementById("message").innerText = "Different password";
    return false;
  } else {
    return true;
  }
}

formSignUp.addEventListener("submit", (e) => {
  if (isSignUp() == false) {
    e.preventDefault();
  }
});
