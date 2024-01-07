<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    <title>{{$titre ?? "Application Laravel"}}</title>
</head>
<body>
    <menu>
        <x-header></x-header>
    </menu>
    <main>
        @if(session('msg'))
            <x-message-info :type="session('type')" :message="session('msg')"></x-message-info>
        @endif
        {{$slot}}
    </main>
    <footer>
        <x-footer></x-footer>
    </footer>
</body>
</html>
