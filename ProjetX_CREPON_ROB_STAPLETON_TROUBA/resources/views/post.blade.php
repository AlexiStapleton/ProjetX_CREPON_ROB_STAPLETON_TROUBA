<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <title>Post</title>
</head>
<body>
    <div id="divpost">
        <p>{{ $post->compte->pseudocompte }}</p>
        <p>{{ $post->textpost }}</p>
        <p>{{ count($post->rt) }} rt</p>
        <p>{{ count($post->likes) }} likes</p>
    </div>
</body>
</html>
