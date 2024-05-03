if(document.readyState === "loading") {
    document.addEventListener('DOMContentLoaded',ready)
}
else{
    ready()
}

function ready() {

    var addToCartButtons = document.getElementsByClassName("atc")
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    var removeCartItemButtons = document.getElementsByClassName("removebutton");
    console.log(removeCartItemButtons);
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var removebutton = removeCartItemButtons[i]
        console.log("test".i)
        removebutton.addEventListener('click', removeCartItem)
    }
}
function removeCartItem(event){
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();

}
function addToCartClicked(event) {
    var button = event.target;
    var item = button.parentElement.parentElement.parentElement;
    var price = item.querySelector(".articleprice").textContent;
    var name = item.querySelector(".articlename").textContent;
    if(item.querySelector('.articlepicture').textContent.trim()== "No image available"){
        var picture = "No Image available"
    }
    else{
    var picture = item.querySelector(".articlepicture img").getAttribute("src");}
    console.log(picture);
    addItemToCart(price, name, picture);

}
function addItemToCart(price, name, picture){
    var cartItems = document.getElementsByClassName("cart-items")[0];
    var cartItemNames = document.getElementsByClassName("cart-item-title");
    for (var i = 0; i < cartItemNames.length; i++) {   //looped durch alle namen im Warenkorb und alerted den user
        if(cartItemNames[i].innerText === name){
            alert("Produkt befindet sich schon in Ihrem Warenkorb")
            return
        }
    }
    var cartRow = document.createElement("div");
    cartRow.classList.add("cart-row");
    var CartrowContents = ` <div class="cart-item cart-column">
            <img class="cart-item-image" src="${picture}" width="100" height="100">
            <span class="cart-item-title">${name}</span>
        </div>
        <span class="cart-price cart-column"> Preis: ${price}</span>
        <div >
            <button class="removebutton" type="button">REMOVE</button>
        </div>`;
    cartRow.innerHTML = CartrowContents;
    cartItems.append(cartRow);
    cartRow.getElementsByClassName("removebutton")[0].addEventListener("click", removeCartItem);
}

