function cookiesEnabled(cname) {
    var carray = document.cookie.split(';');
    for (var i = 0; i < carray.length; i++) {
        var c = carray[i].trim(); // Trim whitespace
        if (c.indexOf(cname + '=') === 0) { // Check if the cookie name matches
            console.log("cookie enabled");
            return c.substring(c.indexOf('=') + 1);
        }
    }
    console.log("cookie not enabled");
    return false;
}

function setCookieDiv() {
    if (!cookiesEnabled("MyCookie")) {
        let div = document.createElement('div');
        div.innerText = "Auf unserer Seite werden Cookies verwendet, um Ihre Web-Erfahrung zu verbessern.";
        div.style.position = "absolute";
        div.style.bottom = "0px";
        div.style.left = "0px";
        div.style.width = "100%";
        div.style.backgroundColor = "lightgray";
        div.style.display = "block";
        let btn = document.createElement('button');
        btn.innerText = "Alle akzeptieren";
        btn.addEventListener('click', acceptCookie); // Use addEventListener to set the click event
        div.appendChild(btn);
        let body = document.getElementsByTagName('body')[0];
        body.appendChild(div);
    }
}

function acceptCookie() {
    if (!cookiesEnabled("MyCookie")) {
        document.cookie = "MyCookie=true; expires=Thu, 18 Dec 2025 00:00:00 UTC; path=/;";
        setTimeout(checkCookieSet, 1000); // Check after a short delay
    }
}

function checkCookieSet() {
    if (cookiesEnabled("MyCookie")) {
        console.log("The cookie has been set.");
        let div = document.getElementById('cookieConsentBar');
        if (div) {
            div.style.display = 'none'; // Hide the div
        }
    } else {
        console.log("The cookie has not been set.");
    }
}

setCookieDiv();

console.log(cookiesEnabled("MyCookie"));
