
const ProductList = document.getElementById("ProductList");
const searchProducts = document.getElementById("searchProducts");

displayProducts(products);
function displayProducts(products) {
  ProductList.innerHTML = "";

  products.forEach((item) => {
    
    const id = parseFloat(item.id);
    const price = parseFloat(item.price);

    ProductList.innerHTML += `
                    <div class="food-card"> <a href="product-item.php?id=${id}">
                        <div class="food-img" style="background-image: url(${item.image});"><i onclick="addToFavourite(${item.id})" class="fas fa-heart fa-4x"></i></div>
                        <div class="food-name">${item.name}</div>
                        <div class="food-details">
                            <span class="rating"><i class="fas fa-star"></i>5.4 (32)</span>
                            <span class="food-price"><span class="naira">&#8358;</span>${price.toLocaleString()}</span></div>
                        </a>
                        <div class="food-purchase">
                            <button onclick="addToCart(${id})" class="add-to-cart"><span class="naira">+</span> Add To Cart</button>
                            <button class="buy-now"><a href=""><span>Buy Now</span></a></button>
                        </div>
                    </div>
        `;
        
  });
  
}

// for searching for products
function searchForProducts(e) {
  const userInput = e.value.toLowerCase();
  const output = products.filter(function (product) {
    const resultOutput = `${product.name}, ${product.price}, ${product.category}`;
    const converted = resultOutput.toLowerCase();
    return converted.includes(userInput);
  });
  if (userInput == 0) {
    displayProducts(products);
  } else {
    displayProducts(output);
  }
}

// for sorting from low to high
const sortProduct1 = document.querySelector("#sort1");
sortProduct1.addEventListener("click", sort1);

function sort1() {
  const sortLowToHigh = products.sort(function (a, b) {
    return parseFloat(a.price) - parseFloat(b.price);
  });
  displayProducts(sortLowToHigh);
}

// for sorting from high to low
const sortProduct2 = document.querySelector("#sort2");
sortProduct2.addEventListener("click", sort2);

function sort2() {
  const sortHighToLow = products.sort(function (a, b) {
    return parseFloat(b.price) - parseFloat(a.price);
  });
  displayProducts(sortHighToLow);
}

const allFoodFilter = document.querySelector("#allFoodsFilter");
allFoodFilter.addEventListener("click", function () {
  displayProducts(products);
});

// filter for burgers
const burgerDisplay = document.querySelector("#burgerDisplay");
burgerDisplay.addEventListener("click", filter1);

function filter1() {
  const filter = "snacks";
  const filterout = products.filter(function (category) {
    const out = `${category.category}`;
    return out.includes(filter);
  });

  displayProducts(filterout);
}

// filter for drinks
const drinkFilter = document.querySelector("#drinkFilter");
drinkFilter.addEventListener("click", filterForDrink);

function filterForDrink() {
  const filter = "drinks";
  const drinkFliterOut = products.filter(function (category) {
    const out = `${category.category}`;
    return out.includes(filter);
  });
  displayProducts(drinkFliterOut);
}

// filter toggle
const filterToogle = document.querySelector(".filterToogle");
const filterDisplay = document.querySelector(".mobile-toogle");

filterToogle.addEventListener("click", function () {
  filterDisplay.classList.toggle("d-block");
});

function oneCheckbox(checkBox) {
  const checkboxes = document.querySelectorAll(".checkbox");
  checkboxes.forEach((check) => {
    if (check !== checkBox) {
      check.checked = false;
    }
  });
}

// add to cart()
function addToCart(productId) {
  const product = products.find(p => parseFloat(p.id) === productId);
  if (!product) return;

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  const existingItem = cart.find(item => parseFloat(item.id) === productId);

  if (existingItem) {

    existingItem.quantity += 1;
  } else {
    // New product, add to cart with quantity 1
    cart.push({ ...product, quantity: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  showMessage(`${product.name} added to Cart`,  color = "rgba(27, 179, 52, 0.6)");
  console.log(products);
  
}


function addToFavourite(productId) {
  const product = products.find(p => parseFloat(p.id) === productId);
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
