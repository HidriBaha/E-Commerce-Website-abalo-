if(document.readyState === "loading") {
    document.addEventListener('DOMContentLoaded',ready)
}
else{
    ready()
}

function ready() {
    let xhr = new XMLHttpRequest();
   let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhr.open('GET','/api/shoppingcart')
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            updatecart(xhr.response);
        }



    var addToCartButtons = document.getElementsByClassName("atc")
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    var removeCartItemButtons = document.getElementsByClassName("removebutton");
    console.log(removeCartItemButtons);
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var removebutton = removeCartItemButtons[i]
        removebutton.addEventListener('click', removeCartItem)
    }
}
function removeCartItem(articleId, shoppingcartId,item) {


    let xhr = new XMLHttpRequest();
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhr.open('DELETE', '/api/shoppingcart/'+shoppingcartId+'/articles/'+articleId)
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            let response = JSON.parse(xhr.responseText);
            let textmessage = response.success ?? response.error ?? 'Unknown Error';
            item.append(textmessage);
            updatecart(xhr.response);
        }

    }}

    function addToCartClicked() {
        let button = event.target;
        var item = button.parentElement.parentElement.parentElement;
        let id = item.querySelector(".id").textContent;
        var price = item.querySelector(".articleprice").textContent;
        var name = item.querySelector(".articlename").textContent;
        if (item.querySelector('.articlepicture').textContent.trim() === "No image available") {
            var picture = "No Image available"
        } else {
            var picture = item.querySelector(".articlepicture img").getAttribute("src");
        }
        addItemToCart(id, item);

    }

    function addItemToCart(id, item) {
        var xhr = new XMLHttpRequest();
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.open('POST', '/api/shoppingcart')
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        let formdata = new FormData();
        formdata.append("articleid", id);
        xhr.send(formdata);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                let response = JSON.parse(xhr.responseText);
                let textmessage = response.success ?? response.error ?? 'Unknown Error';
                item.append( textmessage);
                updatecart(xhr.response);
            }

        }
    }

    function updatecart(responddata) {
        var cartContainer = document.getElementById("cart-container")
        cartContainer.innerHTML = '';
        let response = JSON.parse(responddata);
        response = response.cartdata;
        for (let i = 0; i < response.length; i++) {

            var cartRow = document.createElement("div");
            cartRow.classList.add("cart-row");

            var productImage = document.createElement("img");
            productImage.src = "/articelimages/" + response[i].ab_article_id + ".jpg";
            productImage.classList.add("cart-image");
            productImage.width = 100;
            productImage.height = 100;

            var productName = document.createElement("div");
            productName.classList.add("cart-item");
            productName.textContent = response[i].product_name;

            var productPrice = document.createElement("div");
            productPrice.classList.add("cart-price");
            productPrice.textContent = response[i].ab_price + " €";

            var removeButton = document.createElement("button");
            removeButton.classList.add("remove-button");
            removeButton.textContent = "Remove";
            removeButton.addEventListener('click', function() {
                removeCartItem(response[i].ab_article_id, response[i].ab_shoppingcart_id,cartRow);
            });

            cartRow.appendChild(productImage);
            cartRow.appendChild(productName);
            cartRow.appendChild(productPrice);
            cartRow.appendChild(removeButton);
            cartContainer.appendChild(cartRow);
        }
    }
}

