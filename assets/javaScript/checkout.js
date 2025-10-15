function displayCart() {
  const cartList = document.getElementById("cart-List");
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
console.log(cartList)
  cartList.innerHTML = "";
let totalPrice = 0;
  cart.forEach((item) => {
    const cleanPrice = Number(item.price.replace(/,/g, ""));
    const total = cleanPrice * item.quantity;
    // Ensure total is a number
    totalPrice += total;

    cartList.innerHTML += `
                        <div class="flex mx-3" mb-1>
                            <b class="pe-2">.</b> <p class="">${item.name} x ${item.quantity} = ${total}</p>
                            <input type="hidden" value="${item.quantity}" name='product[quantity][${item.id}]'/>
                        </div>
                        <input type="hidden" name="product[id][]" value="${item.id}"/>
    `;
  });
  }
displayCart();

function checkbox(checkbox){
    const checkboxes = document.querySelectorAll(".checkout-radio")
    checkboxes.forEach(check => {
        if (check !== checkbox) {
            check.checked = false
        }
    });
}