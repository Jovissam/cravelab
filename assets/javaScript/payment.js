const paymentTrigger = document.getElementById("payment-trigger")
const paymentDisplay = document.getElementById("payment-display")
const orderDisplay = document.getElementById("order-display")
const closeBtn = document.getElementById("close")

const accNo = document.getElementById("accNo")
const copyState = document.getElementById("copy-state")

paymentTrigger.addEventListener("click", () => {
    paymentDisplay.classList.remove("d-none");
    orderDisplay.classList.add("d-none");
});
closeBtn.addEventListener("click", () => {
    paymentDisplay.classList.add("d-none");
    orderDisplay.classList.remove("d-none");
})


accNo.addEventListener("click", () => {
    navigator.clipboard.writeText(accNo.innerText).then(() =>{
        copyState.textContent = "copied";
        copyState.style.color = "#6ad36a";
    })
})