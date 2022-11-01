<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body>
    <div style="position:absolute;top:0px;right:0px;"><a href="{{ route('logout') }}">Sair</a></div>
    <h1>Seguindo</h1>
    <a href="{{route('feed')}}">Feed</a>
    <a href="{{route('novo')}}">Novo Post</a>
    @foreach($posts as $post)
        <div
            style="opacity:{{ $post->closed ? '50%' : '100%' }}"
        >
            <a href="{{route('post',[$post->id])}}">#{{$post->id}}</a>
            <span>{{$post->name}}</span>
            <span>{{$post->description}}</span>
        </div>
    @endforeach
</body>
</html>
