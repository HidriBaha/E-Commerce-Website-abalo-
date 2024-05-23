//defining navmenu Obj
const NavigationMenu = {
    create: function (name) {
        return document.createElement(name);
    },

    createMenu: function (menu) {
        let nav = this.create('nav');
        let ul = this.create('ul');

        // Iterate over main menu items
        menu.mainMenu.forEach(item => {
            let link = this.create("a");
            let e = this.create("li");
            e.innerText = item.name;

            link.addEventListener("click", function () {
                console.log("Clicked on " + item.name);
                item.a();
            });
            link.addEventListener("click", function () {
                item.a();
            });
            // add hover color
            link.addEventListener("mouseover", function () {
                e.style.cssText = 'color:' + item.hoverColor();
            });
            link.addEventListener("mouseout", function () {
                e.style.cssText = 'color: inherit';
            });

            link.appendChild(e);
            ul.appendChild(link);

            // if submenu exists
            if (item.sub) {
                let sub_ul = NavigationMenu.create('ul');
                // Iterate over submenu items
                for(let i = 0; i < item.anzahl; i++){
                    let sub_e = this.create("li");
                    let sub_link = this.create("a");
                    sub_e.innerText = menu.subMenu[i].name;
                    sub_link.addEventListener("mouseover", function ()
                    {
                        sub_e.style.cssText = 'color:' + menu.subMenu[i].hoverColor();
                    });
                    sub_link.addEventListener("mouseout", function ()
                    {
                        sub_e.style.cssText = 'color: inherit';
                    });
                    sub_link.append(sub_e);
                    sub_ul.append(sub_link);
                };
                ul.append(sub_ul);
            }
        });

        nav.append(ul);
        document.body.append(nav);
    }
};


let menu = {
    mainMenu: [
        {name: "Home", link: "home", a: function(){return location.href = "/"}, hoverColor: function(){return "#fc0303"}},
        {name: "Kategorien", link: "kategorien",a: function(){return location.href = "/articles"}, hoverColor: function(){return "#fc1c03"}, sub: false},
        {name: "Verkaufen", link: "verkaufen",a: function(){return location.href = "/newarticle"}, hoverColor: function(){return "#fc3503"}, sub: false},
        {name: "Unternehmen", link: "unternehmen",a: function(){return location.href = "#"}, hoverColor: function(){return "#fc4a03"}, sub: true, anzahl: 2},
        ],
    subMenu: [
        {name: "Philosophie", link: "Philosophie",a: function(){return location.href = "#"},hoverColor: function(){return "#fc6b03"}, sub: false},
        {name: "Karriere", link: "karriere",a: function(){return location.href = "#"},hoverColor: function(){return "#fc9803"}, sub: false}
        // Add more submenu items as needed
    ]
};


NavigationMenu.createMenu(menu);

// Cookie akzeptieren reset
document.cookie = "check=false; expires=Thu, 18 DEC 2025 00:00:00 UTC; path=/;";
console.log(document.cookie);
