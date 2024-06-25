<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <title>Artikel</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="{{asset("js/cookiecheck.js")}}"></script>

    <style>
        table, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        table{
            min-width: 1000px;
            max-width: 1000px;
        }
        td{
            padding: 10px;
        }
    </style>

</head>
<body>
<h1>Artikel einkaufen</h1>

<div id="filter-div">
    <p>@{{message}}</p>
    Artikel suchen:<input id="filter" type="text" @input="addEvent"><br>

    <ul v-for="item in articles">
        <li> ID: @{{item.id}} Name: @{{item.ab_name}}</li>
    </ul>
</div>


<script>
    var filter = new Vue({
        el: "#filter-div",
        data:{
            message: null,
            articles: []
        },
        methods:{
            addEvent: function(event) {
                if (event.target.value.length >= 3)
                    this.sendAjax(event.target.value);
                if (event.target.value.length === 0)
                    this.articles = "";
            },
            sendAjax(text){
                let s = text;
                const limit = 5;
                axios
                    .get("/api/articles/?search=" + s + "&limit=" + limit)
                    .then(response => (this.articles = response.data))
                    .catch(error => console.log(error))
            }
        }
    })
</script>




    <h2>Artikelübersicht</h2>

    <table>
        @foreach ($ab_article as $a)
            <tr>
                <td id="{{$a->id}}">{{$a->id}}</td>
                <td>{{$a->ab_name}}</td>
                <td>{{$a->ab_description}}</td>
                <td>{{$a->ab_price}}€</td>
                <td>{{$a->ab_createdate}}</td>
            </tr>
            <!-- Wenn Artikel schon im Warenkorb ist ->display:none -->
            <script>

            </script>
        @endforeach

    </table>


</body>
</html>
