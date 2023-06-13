const sign_in_btn = document.querySelector("#sign-in-btn");
const container = document.querySelector(".container");

function check(){
  emails = ["jovankaberhimpon11@gmail.com", "naomikamea97@gmail.com", "shergiiwuisan@gmail.com"]
  email = document.getElementById('email').value;
  password = document.getElementById('password').value;
  if(email == "admin" && password == "12345") {
    window.location.href = "home.html";
  }
  else if(email == emails[0] && password == "12345") {
    window.location.href = "home.html";
  }
  else if(email == emails[1] && password == "12345") {
    window.location.href = "home.html";
  }
  else if(email == emails[2] && password == "12345") {
    window.location.href = "home.html";
  }
  // else {
  //   alert("SALAH!!! COBA ULANG")
  // }
}
