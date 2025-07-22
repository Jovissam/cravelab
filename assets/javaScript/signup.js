const passwordInput = document.getElementById("pwd");
const submit = document.getElementById("submit");
const check1 = document.getElementById("check1");
const check2 = document.getElementById("check2");
passwordInput.addEventListener("keyup", (e) => {
  const value = e.target.value;
  let auth1 = null
  if (value.length < 8) {
    submit.setAttribute("disabled", "true");
    check1.removeAttribute("checked");
  } else {
    // submit.removeAttribute("disabled");
    check1.setAttribute("checked", "true");
    auth1 = true;
  }
  let auth2 = null
  for (let nums of ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"]) {
    if (value.includes(nums)) {
      check2.checked = true;
      auth2 = true
      submit.removeAttribute("disabled");
    }
  }
  if (!auth1 || !auth2) {
    check2.checked = false
    submit.setAttribute("disabled", "true");
  }
});
