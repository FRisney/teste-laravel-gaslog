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
    <script>
        function remover(){
            let resposta = confirm('Deseja remover este Post?');
            if(resposta) {
                window.location = '{{ route('post.delete', [$post->id, 'delete']) }}';
            }
        }
        function fechar(){
            let resposta = confirm('Deseja fechar este Post?');
            if(resposta) {
                window.location = '{{ route('post.edit', [$post->id, 'close'] ) }}';
            }
        }
        function reabrir(){
            let resposta = confirm('Deseja reabrir este Post?');
            if(resposta) {
                window.location = '{{ route('post.edit', [$post->id, 'open']) }}';
            }
        }
    </script>
    <div style="position:absolute;top:0px;right:0px;"><a href="{{ route('logout') }}">Sair</a></div>
    <h1>Novo Post</h1>
    <a href="{{route('feed')}}">Voltar</a>
    @if($isAuthor)
    <form method="post" action="{{ route('post.edit',[$post->id]) }}">
        @csrf
    @endif
        <div>
            <div>
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" value="{{ $post->name }}" {{ $isAuthor ?: 'disabled' }}></span>
            </div>
            <div>
                <label for="description">Descrição</label>
                <input type="text" name="description" id="description" value="{{ $post->description }}" {{ $isAuthor ?: 'disabled' }}></span>
            </div>
            @if($isAuthor)
            <button type="submit">Editar</button>
            <button type="button" onclick="remover()">Remover</button>
            <button type="button" onclick="{{ $post->closed ? 'reabrir' : 'fechar' }}()">{{ $post->closed ? 'Reabrir' : 'Fechar' }}</button>
            @endif
        </div>
    @if($isAuthor)
    </form>
    @endif
</body>
</html>
