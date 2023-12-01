<html>
<head>
    <title>Création sport</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <form action="{{route('sports.store')}}" method="POST">
        <input type="text" placeholder="Choisissez un sport" name="sport">
        <button type="submit" value="Rechercher"></button>
    </form>
</body>
</html>
