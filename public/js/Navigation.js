
    function create(name){
    return document.createElement(name);
}

    function createMenu(menu){
        let nav = create('nav');
        let ul = create('ul');
        let elements = menu["el"];

        for (let i=0;i<elements.length;i++){
            let link = create("a");
            let e = create("li")
            e.innerText = elements[i].name;

            link.addEventListener("click", function() {
                console.log("Clicked on " + elements[i].name);
                elements[i].a();
            });
            link.addEventListener("click", function(){
                elements[i].a();
            });
            // add hover color
            link.addEventListener("mouseover", function(){
                e.style.cssText = 'color:' +  elements[i].hoverColor();
            });
            link.addEventListener("mouseout", function(){
                e.style.cssText = 'color: inherit';
            });

            link.appendChild(e);
            ul.appendChild(link);


    // if submenu exists
    if (elements[i].sub === true){
    let sub_ul = create('ul');
    let j = 1;

    for (j=1; j<=elements[i].anzahl;j++)
{
    let sub_e = create("li");
    let sub_link = create("a");
    sub_e.innerText = elements[i+j].name;
    console.log(j);
    sub_link.addEventListener("mouseover", function(){
    sub_e.style.cssText = 'color:' +  elements[j].hoverColor();
});
    sub_link.addEventListener("mouseout", function(){
    sub_e.style.cssText = 'color: inherit';
});
    sub_link.append(sub_e);
    sub_ul.append(sub_link);
}
    ul.append(sub_ul);
    i += elements[i].anzahl;
}
}
    nav.append(ul);

    document.body.append(nav);
}

    let menu = {
    el:
    [
{name:"Home", link: "home", a: function(){return location.href = "/"}, hoverColor: function(){return "#fc0303"}},
{name: "Kategorien", link: "kategorien",a: function(){return location.href = "/articles"}, hoverColor: function(){return "#fc1c03"}, sub:false},
{name: "Verkaufen", link: "verkaufen",a: function(){return location.href = "/newarticle"}, hoverColor: function(){return "#fc3503"}, sub:false},
{name: "Unternehmen", link:"unternehmen",a: function(){return location.href = "#"}, hoverColor: function(){return "#fc4a03"}, sub:true, anzahl: 2},
{name: "Philosophie", link:"Philosophie",a: function(){return location.href = "#"},hoverColor: function(){return "#fc6b03"}, sub:false},
{name: "Karriere", link: "karriere",a: function(){return location.href = "#"},hoverColor: function(){return "#fc9803"}, sub: false},
    ]
};


    createMenu(menu);

    // Cookie akzeptieren reset
    //document.cookie = "check=false; expires=Thu, 01 Jan 2022 00:00:00 UTC; path=/;";
    console.log(document.cookie);


    setCookieDiv();







