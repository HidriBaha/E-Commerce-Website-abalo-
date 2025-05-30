<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="{{asset("js/servercart.js")}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Warenkorb</h1>
<div class = "cart-items" ></div>
<div id="cart-container"></div>
<div class="container">
    <h1 class="mt-5 mb-4">List of Articles</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Creator ID</th>
            <th>Created Date</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ab_article as $article)
            <tr id="{{ $article->id }}">
                <td class="id">{{ $article->id }}</td>

                <td class = "articlename">{{ $article->ab_name }}</td>
                <td class = "articleprice">{{ $article->ab_price }}</td>
                <td>{{ $article->ab_description }}</td>
                <td>{{ $article->ab_creator_id }}</td>
                <td>{{ $article->ab_createdate }}</td>
                <td class = "articlepicture">
                    @if (file_exists(public_path('articelimages/' . $article->id . '.jpg')))
                        <img src="{{ url('./articelimages/'.$article->id).'.jpg' }}" alt="Image" class="img-thumbnail" style="max-width: 120px;">
                    @else
                        No image available
                    @endif
                </td>
                <td> <form class = "atc">
                        <input type="hidden" id="id" name="id">
                        <button type="button">Add to cart</button>
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
