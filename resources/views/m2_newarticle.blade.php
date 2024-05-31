<!DOCTYPE  HTML >
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <!-- Bootstrap CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/app.css">

    <link rel="stylesheet" href="../../public/css/main.css">

    <script src="{{asset("js/cookiecheck.js")}}"></script>

</head>

<body>

<script src="{{asset("js/Navigation.js")}}" ></script>
<h1 class="text-primary">New Article</h1>
@if(isset($success))
    {{"Das Produkt wurde erfolgreich eingetragen"}}
@elseif(isset($error))
    {{"Fehler beim einfügen"}}
@endif
<!-- The menu will be generated here
-->
<script>
    function sendData(name, preis, beschreibung, token) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/newarticle',true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.setRequestHeader("X-CSRF-TOKEN", token);

        let formData = new FormData();
        formData.append('name', name);
        formData.append('preis', preis);
        formData.append('beschreibung', beschreibung);

        xhr.onreadystatechange = function() {
            console.log(xhr.status);
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let json = JSON.parse(xhr.responseText);
                   console.log("json is"+json);
                    if (json.success === "SUCCESS") {
                        document.getElementById('ausgabe').innerText = "Das Produkt wurde erfolgreich hinzugefügt";
                    } else {
                        document.getElementById('ausgabe').innerText = "Fehler beim Einfügen: " + json.error;
                    }
                } else {
                    document.getElementById('ausgabe').innerText = "Fehler beim Einfügen: " + xhr.status;
                }
            }
        };
        xhr.send(formData);
    }

    function checkFields(event) {
        event.preventDefault();
        let p = document.getElementById('para');
        let check = true;

        if (document.getElementById('name').value === '') {
            p.innerText = 'Please add a name!';
            check = false;
        }
        if (document.getElementById('preis').value === '') {
            p.innerText = 'Please add a price!';
            check = false;
        }
        if (document.getElementById('preis').value <= 0) {
            p.innerText = 'Invalid Price!';
            check = false;
        }
        if (document.getElementById('beschreibung').value === '') {
            p.innerText = 'Please add a description!';
            check = false;
        }
        if (!check) {
            return false;
        }
        p.innerText = '';

        let name = document.getElementById('name').value;
        let preis = document.getElementById('preis').value;
        let beschreibung = document.getElementById('beschreibung').value;
        let token = document.getElementById('csrf').value;
        sendData(name, preis, beschreibung, token);
    }

    let f = document.createElement('form');
    f.setAttribute('method', 'post');
    f.setAttribute('action', '/newarticle');
    f.setAttribute('id', 'neuer_Artikel');

    let i1 = document.createElement('input');
    let i2 = document.createElement('input');
    let i3 = document.createElement('input');
    let btn = document.createElement('button');
    let csrf = document.createElement('input');
    let br = document.createElement('br');
    let p = document.createElement('p');

    p.setAttribute('id', 'para');
    p.style.color = 'blue';

    btn.innerText = 'Submit';
    btn.setAttribute("type", 'submit');

    i1.setAttribute('placeholder', 'Article name');
    i2.setAttribute('placeholder', 'Price');
    i3.setAttribute('placeholder', 'Description');

    i2.setAttribute('type', 'number');

    i1.setAttribute('id', 'name');
    i2.setAttribute('id', 'preis');
    i3.setAttribute('id', 'beschreibung');

    i1.setAttribute('name', 'name');
    i2.setAttribute('name', 'preis');
    i3.setAttribute('name', 'beschreibung');

    csrf.setAttribute('id', 'csrf');
    csrf.setAttribute('type', 'hidden');
    csrf.setAttribute('name', '_token');
    csrf.setAttribute('value', '{{ csrf_token() }}');

    f.appendChild(i1);
    f.appendChild(br.cloneNode());
    f.appendChild(i2);
    f.appendChild(br.cloneNode());
    f.appendChild(i3);
    f.appendChild(br.cloneNode());
    f.appendChild(csrf);
    f.appendChild(btn);
    f.appendChild(p);

    document.body.appendChild(f);

    f.addEventListener('submit', checkFields);

    setCookieDiv();
</script>

<p id="ausgabe"></p>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
