<html>
<head>
    <title>Liste des sports</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
<form>
    <input type="text" placeholder="Choisissez un sport" name="sport">
    <button type="submit" value="Rechercher"></button>
</form>
<h2>La liste des sports : ({{count($sports)}})</h2>
@if(!empty($sports))
    <h4>Filtrage par nombre d'épreuves</h4>
    <form action="{{route('sports.index')}}" method="get">
        <select name="nb">
            <option value="All" @if($nb == 'All') selected @endif>-- Toutes catégories --</option>
            @foreach($nb_epreuves as $epreuves)
                <option value="{{$epreuves}}" @if($nb == $epreuves) selected @endif>{{$epreuves}}</option>
            @endforeach
        </select>
        <input type="submit" value="OK">
    </form>

    <table>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Année d'ajout</th>
            <th>Nombre de disciplines</th>
            <th>Nombre d'épreuves</th>
            <th>Date de début</th>
            <th>Date de fin</th>
        </tr>
        @foreach($sports as $sport)
            <tr>
                <td>{{$sport['nom']}}</td>
                <td>{{$sport['description']}}</td>
                <td>{{$sport['annee_ajout']}}</td>
                <td>{{$sport['nb_disciplines']}}</td>
                <td>{{$sport['nb_epreuves']}}</td>
                <td>{{$sport['date_debut']}}</td>
                <td>{{$sport['date_fin']}}</td>
            </tr>
        @endforeach
    </table>
@else
    <h3>aucun sport</h3>
@endif
<x-sport titre="Météo du jour" message="Temps dégagé">
    <p>Ces informations ont été obtenues sur le site <a href="https://meteofrance.com/">météo france</a></p>
</x-sport>
<img src="{{ Vite::asset('resources/images/I-love-Paris.jpg') }}">
    </body>
    </html>
