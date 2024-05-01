function cookiesEnabled(cname) {
    var carray=document.cookie.split(';');
    for (var i=0;i<carray.length;i++)
    {
        var c=carray[i];
        if(c.indexOf("cname")!==-1)
        {
            return c.substring(c.indexOf('=')+1);
        }
    }
    return false;
}


function setCookieDiv() {
    console.log("Check: " + cookiesEnabled("check"));
    if(!cookiesEnabled("check"))
    {    let div=document.createElement('div');
        div.innerText = "Auf unsere Seite werden Cookies verwendet um ihre Web-Erfahrung zu verbessern ";
div.style.position="absolute";
div.style.bottom="0px";
div.style.left="0px";
div.style.width="100%";
div.style.backgroundColor="lightgray";
div.style.display="block";
        let btn = document.createElement('button');
        btn.innerText = "Alle akzeptieren";
        btn.setAttribute('onclick', 'acceptCookie()');

        div.appendChild(btn);

        document.body.appendChild(div);

    }}
function acceptCookie() {
if(cookiesEnabled("check")!==false) {
    document.cookie = "check=true; expires=Thu, 18 Dec 2025 00:00:00 UTC; path=/;";
    document.getElementsByName('div')[0].style.visibility = "hidden";
}
}
