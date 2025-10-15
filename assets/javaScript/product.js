
function addToCart(productId) {
  const product = productItem.find(p => parseFloat(p.id) === productId);
  if (!product) return;

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  const existingItem = cart.find(item => item.id === productId);

  if (existingItem) {

    existingItem.quantity += 1;
  } else {
    // New product, add to cart with quantity 1
    cart.push({ ...product, quantity: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  showMessage(`${product.name} added to Cart`,  color = "rgba(27, 179, 52, 0.6)");
}

function addToFavourite(productId) {
  const product = productItem.find(p => parseFloat(p.id) === productId);
  if (!product) return;

  let favourites = JSON.parse(localStorage.getItem("favourites")) || [];

  const existingFavourite = favourites.find(item => parseFloat(item.id) === productId);

  if (!existingFavourite) {
    favourites.push(product);
    localStorage.setItem("favourites", JSON.stringify(favourites));
    showMessage(`${product.name} added to Favourites`,  color = "rgba(27, 179, 52, 0.6)"); 
  } else {
    showMessage(`${product.name} is Already in Your Favourites`,  color = "rgba(236, 18, 102, 0.6)");
  }
  
}

// status message
function showMessage(text, color = "") {
  const box = document.getElementById("prompt");
  box.innerHTML = `<b id="show-prompt" style="background-color: ${color}">${text}</b>`;
  // box.style.color = color;
  box.style.display = "flex";

  setTimeout(() => {
    box.style.display = "none";
  }, 2000); // hides after 2 seconds
}
