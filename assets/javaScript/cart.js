function displayCart() {
  const cartList = document.getElementById("cartList");
  const cartLength = document.getElementById("cartLength");
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  cartList.innerHTML = "";

  if (cart.length === 0) {
    cartList.innerHTML = `<h3 class="text-center">Your cart is empty</h3>`;
  }

  const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
  cartLength.textContent = `${totalItems} item`;

  let totalPrice = 0;
  cart.forEach((item, index) => {
    const cleanPrice = Number(item.price.replace(/,/g, ""));
    const total = cleanPrice * item.quantity;
    // Ensure total is a number
    totalPrice += total;

    cartList.innerHTML += `
                        <div class="cart-item flex"><a href="product-item.php?id=${
                          item.id
                        }">
                            <img src="assets/images/food/${
                              item.image
                            }" alt=""> </a>
                            <div class="cart-details flex flex-column justify-content-between p-2">
                                <div class="cart-price flex justify-content-between align-items-center">
                                    <h3 class="transform-text">${item.name}</h3>
                                    <div class="flex"><p class="pe-2">Total</p><h5><span class="naira">&#8358;</span> ${total.toLocaleString()}</span></h5></div>
                                </div>
                                <div class="flex flex-wrap justify-content-between">
                                    <button onclick="removeItem(${
                                      item.id
                                    })" class="remove-item border border-dark rounded-2 p-1"><i class="fas fa-trash"></i><span>Remove Item</span></button>
                                    <div class="flex align-items-center flex-wrap">
                                        <p><span>&#8358;</span>${
                                          item.price
                                        }.00 x</p>
                                        <input type="number" value='1' name='product[quantity][${
                                          item.id
                                        }]' class='modify-cart ms-2 mt-1'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product[id][]" value="${
                          item.id
                        }"/>
    `;
  });
  cartList.innerHTML +=
    "<button class='btn btn-primary' type='submit'>CHECKOUT </button>";
  document.getElementById(
    "totalAmount"
  ).innerHTML = `<span class="naira">&#8358;</span> ${totalPrice.toLocaleString()}.00`;
}
displayCart();

function updateQuantity(productId, change) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  const item = cart.find((p) => parseFloat(p.id) === productId);
  if (!item) return;

  item.quantity += change;

  // Remove item if quantity is 0 or less
  if (item.quantity <= 0) {
    cart = cart.filter((p) => parseFloat(p.id) !== productId);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  displayCart(); // refresh cart UI
}

function removeItem(productId) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart = cart.filter((item) => parseFloat(item.id) !== productId);
  localStorage.setItem("cart", JSON.stringify(cart));
  displayCart(); // refresh cart UI
}

// clear cart function
document.getElementById("clearCart").addEventListener("click", clearCart);

function clearCart() {
  localStorage.removeItem("cart");
  displayCart(); // refresh cart UI
}

// check out

// function checkOut() {
//   const checkoutbtn = document.querySelector("#checkoutBtn");
//   // checkoutbtn.textContent = "Hello world";

//   let products = JSON.parse(localStorage.getItem("cart")) || [];

//   products.forEach((product) => {
//     checkoutbtn.innerHTML += `<input type="text" name="productId[]" value="${product.id}"/>`;
//   });
//   checkoutbtn.innerHTML +=
//     "<button type='submit' class='btn color1'>Checkout</button>";
// }
// checkOut();
