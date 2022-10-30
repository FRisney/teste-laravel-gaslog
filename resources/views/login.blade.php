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
    <div style="height: 100vh;display: flex;justify-items: center;align-items: center;justify-content: center;">
        <form action="/auth" method="post" style="max-height: 300px;max-width:300px;align-self: center;display: flex; flex-direction: column">
            @csrf
            <div>
                <label for="login">Login</label>
                <input type="email" name="login" id="login">
            </div>
            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Login</button>
            <a href="/auth/register">Registrar-se</a>
        </form>
    </div>
</body>
</html>
