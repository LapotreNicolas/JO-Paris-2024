<html>
<head>
    <title>Sport</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <h2>{{$sport}}</h2>
    <h3>{{$sport['description']}}</h3>
    <h3>Ajouté en : {{$sport['annee_ajout']}}</h3>
    <h3>Nombre de disciplines : {{$sport['nb_disciplines']}}</h3>
    <h3>Nombre d'épreuves : {{$sport['nb_epreuves']}}</h3>
    <h3>Débute le : {{$sport['date_debut']}}</h3>
    <h3>Fini le : {{$sport['date_fin']}}</h3>
</body>
</html>
