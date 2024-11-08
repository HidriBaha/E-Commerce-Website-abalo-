<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <title>Artikel</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/cookiecheck.js') }}"></script>

    <style>
        table, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            min-width: 1000px;
            max-width: 1000px;
        }
        td {
            padding: 10px;
        }
    </style>
</head>
<body>
<h1>Artikel einkaufen</h1>

<div id="filter-div">
    <p>@{{ message }}</p>
    Artikel suchen: <input id="filter" type="text" @input="addEvent"><br>

    <ul>
        <li v-for="item in articles" :key="item.id">
            ID: @{{ item.id }} Name: @{{ item.ab_name }}
        </li>
    </ul>
</div>

<h2>Artikelübersicht</h2>

<table>
    @foreach ($ab_article as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->ab_name }}</td>
            <td>{{ $a->ab_description }}</td>
            <td>{{ $a->ab_price }}€</td>
            <td>{{ $a->ab_createdate }}</td>
        </tr>
    @endforeach
</table>

<script>
    var filter = new Vue({
        el: "#filter-div",
        data: {
            message: "Search for articles by name or ID",
            articles: []
        },
        methods: {
            addEvent: function(event) {
                if (event.target.value.length >= 3) {
                    this.sendAjax(event.target.value);
                } else if (event.target.value.length === 0) {
                    this.articles = [];
                }
            },
            sendAjax: function(text) {
                const limit = 5;
                axios.get("/api/articles", {
                    params: {
                        search: text,
                        limit: limit
                    }
                })
                    .then(response => {
                        console.log(response.data);  // Debugging: log the response data
                        this.articles = response.data.articles;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    });
</script>
</body>
</html>
