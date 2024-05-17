function cookiesEnabled(cname) {
    var carray = document.cookie.split(';');
    for (var i = 0; i < carray.length; i++) {
        var c = carray[i].trim(); // Trim whitespace
        if (c.indexOf(cname) !== -1) { // Use cname variable
            return c.substring(c.indexOf('=') + 1);
        }
    }
    return false;
}//referenz von YT ..?
//kommentar


function setCookieDiv() {
    if(!cookiesEnabled("check"))
    {
        let div=document.createElement('div');
        div.innerText = "Auf unsere Seite werden Cookies verwendet um ihre Web-Erfahrung zu verbessern ";
        div.style.position="absolute";
        div.style.bottom="0px";
        div.style.left="0px";
        div.style.width="100%";
        div.style.backgroundColor="lightgray";
        div.style.display="block";
        let btn = document.createElement('button');
        btn.innerText = "Alle akzeptieren";
        btn.addEventListener('click', acceptCookie); // use addEventListener to set the click event
        div.appendChild(btn);
let body=document.getElementsByTagName('body');
        body[0].appendChild(div);
    }}


function acceptCookie() {
    if (!cookiesEnabled("check")) {
        document.cookie = "myCookie=true; expires=Thu, 18 Dec 2025 00:00:00 UTC; path=/;";
        setTimeout(checkCookieSet, 1000); // Check after a short delay
    }
}

function checkCookieSet() {
    if (cookiesEnabled("MyCookie")) {
        console.log("The cookie has been set.");
    } else {
        console.log("The cookie has not been set.");
    }
}

setCookieDiv();

//console.log(cookiesEnabled("check"));
