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
    <a href="{{route('post',[$post->id])}}">Voltar</a>
    <form method="post" action="{{ route('analysis.create',[$post->id]) }}">
        @csrf
        <div>
            <div>
                <h4 style="display: inline-block">Voce Recomenda?</h4>
                <label for="recy">SIM</label>
                <input type="radio" name="recommends" id="recy" value="y">
                <label for="recn">NAO</label>
                <input required type="radio" name="recommends" id="recn" value="n">
            </div>
            <div>
                <label for="description">Analise</label>
                <textarea required name="description" id="description"></textarea>
            </div>
            <button type="submit">Publicar</button>
        </div>
    </form>
</body>
</html>
