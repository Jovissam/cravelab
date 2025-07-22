

function displayFavourite() {
    const favouriteList = document.getElementById("favourite-list");
      const favLength = document.getElementById("favLength");
    const favourite = JSON.parse(localStorage.getItem("favourites")) || [];
    
    favouriteList.innerHTML = ""; // Clear previous content

    favourite.forEach(item => {
        favouriteList.innerHTML += `
            <div class="cart-item flex"><a href="product-item.html?id=${item.id}">
                            <img src="${item.image}" alt="">
                            <div class="cart-details flex flex-column justify-content-between p-2">
                                <div class="cart-price flex justify-content-between align-items-center">
                                    <h3>${item.name}</h3>
                                    <div class="flex"><h5><span class="naira">&#8358;</span> ${item.price}.00</span></h5></div>
                                </div></a>
                                <div class="remove-item text-center">
                                    <button onclick="removeItem(${item.id})" class=" border border-dark rounded-2 p-1"><i class="fas fa-trash"></i> Remove From Favorite</button>
                                </div>
                            </div>
                        </div>
        `;
    });
    favLength.textContent = `${favourite.length} item`;
    
}
displayFavourite()

function removeItem(productId) {
  let cart = JSON.parse(localStorage.getItem("favourites")) || [];
  cart = cart.filter(item => parseFloat(item.id) !== productId);
  localStorage.setItem("favourites", JSON.stringify(cart));
  displayFavourite(); // refresh cart UI
}
const jj = "how are you";
