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
    <h1>Novo Post</h1>
    <a href="{{route('feed')}}">Voltar</a>
    <form method="post" action="{{ route('novo') }}">
        @csrf
        <div>
            <div>
                <label for="name">Nome</label>
                <input type="text" name="name" id="name"></input>
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" id="description"></input>
            </div>
            <button type="submit">Publicar</button>
        </div>
    </form>
</body>
</html>
