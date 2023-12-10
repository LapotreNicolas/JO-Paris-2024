<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
        <h3>Coucou</h3>
        <x-sport titre="Météo du jour" message="Temps dégagé">
            <p>Ces informations ont été obtenues sur le site <a href="https://meteofrance.com/" target="_blank">météo france</a></p>
        </x-sport>
        <img src="{{ Vite::asset('resources/images/I-love-Paris.jpg') }}" alt="I love Paris">
    </x-layout>
</body>
</html>
