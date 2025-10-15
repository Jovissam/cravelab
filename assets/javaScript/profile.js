// status message
function showMessage(text, color = "") {
  const box = document.getElementById("prompt");
  box.innerHTML = `<b id="show-prompt" style="background-color: ${color}">${text}</b>`;
  box.style.display = "flex";

  setTimeout(() => {
    box.style.display = "none";
  }, 2000); // hides after 2 seconds
}

// address checkbox
function oneCheckbox(checkBox) {
  const checkboxes = document.querySelectorAll(".checkbox");
  checkboxes.forEach((check) => {
    if (check !== checkBox) {
      check.checked = false;
    }
  });
}
async function makeDefault(id, userId) {
  const result = await fetch("config/address.php", {
    method: "POST",
    headers: { "content-type": "application/json" },
    body: JSON.stringify({ id: id, postType: "setDefaultAddress", userId: userId }),
  }).then((result) => result.json());
showMessage(`${result.status}`,  color = "rgba(36, 155, 85, 0.6)");
}
