<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
bahaaaa
<script>
    "use strict;"
    var xhr = new XMLHttpRequest();

    var url = new URL(window.location.href);
    var name = url.searchParams.get("name");
    var price = parseInt(url.searchParams.get("price"));
    var description = url.searchParams.get("description");

    let formdata = new FormData();
       formdata.append("name", "baha");
         formdata.append("price", 22);
            formdata.append("description", "idk");

        xhr.open('POST', "/api/articles");
        xhr.setRequestHeader("X-CSRF-TOKEN",
            document.getElementById("csrf-token").getAttribute('content')
        );
    xhr.send(formdata);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error(xhr.statusText);
                }
            }
        }


</script>
</body>
</html>
