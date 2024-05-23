<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Search </h1>

<script>
    "use strict;"
    console.log("Hello");
    var xhr=new XMLHttpRequest();
    var url=new URL(window.location.href);
    var search= url.searchParams.get("search");
    xhr.open('GET',"/api/articles?search="+search,true);
    //xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader("Content-Type","application/json");

    xhr.onreadystatechange=function (){
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);
                // Handle the response data here
            } else {
                console.error("Error: " + xhr.status);
            }
        }
    };
    xhr.send();
</script>

</body>
</html>
