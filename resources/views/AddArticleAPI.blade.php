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
<script>
    let xhr=new XMLHttpRequest();
    let url=new URL(window.location.href);
    let name=url.searchParams.get("name");
    let description=url.searchParams.get("description");
    let price=url.searchParams.get("price");
    if(price>null&& name!=="")
    {
        xhr.open('POST',"/api/articles");
        xhr.setRequestHeader("Content-Type","application/json");
        xhr.setRequestHeader("X-CSRF-TOKEN",document.getElementById("csrf").content);4
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
        xhr.send('name='+name+'&description='+description+'&price='+price);

    }
</script>

</body>
</html>
