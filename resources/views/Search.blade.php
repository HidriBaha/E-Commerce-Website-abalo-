<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
<h1>Search</h1>
<h1>List of Articles</h1>
<table id="Article_table">
    <thead>
    <tr>
        <th>id</th>
        <th>ab_name</th>
        <th>ab_price</th>
        <th>ab_description</th>
        <th>ab_creator_id</th>
        <th>ab_created_date</th>
        <th>ab_image</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($ab_article as $article)
        <tr id="{{ $article->id }}">
            <td>{{ $article->id }}</td>
            <td>{{ $article->ab_name }}</td>
            <td>{{ $article->ab_price }}</td>
            <td>{{ $article->ab_description }}</td>
            <td>{{ $article->ab_creator_id }}</td>
            <td>{{ $article->ab_createdate }}</td>
            <td>

                @if (file_exists(public_path('articelimages/' . $article->id . '.jpg')))
                    <img src="{{ url('./articelimages/'.$article->id).'.jpg' }}" alt="Image" width="120">
                @else
                    No image available
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
