<html>
<head>
    <title>Liste des sports</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
        <form action="{{route('sports.index')}}" method="get">
            <input type="text" placeholder="Choisissez un sport" name="sport">
            <button type="submit">Rechercher</button>
        </form>
        <a href="{{route('sports.create')}}"><button>Ajouter un sport</button></a>
        <h2>La liste des sports : ({{count($sports)}})</h2>
        @if(!empty($sports))
            <h4>Filtrage par année d'ajout</h4>
            <form action="{{route('sports.index')}}" method="get">
                <select name="annee">
                    <option value="All" @if($annee == 'All') selected @endif>-- Toutes les années d'ajout --</option>
                    @foreach($annees_ajout as $annee_ajout)
                        <option value="{{$annee_ajout}}" @if($annee == $annee_ajout) selected @endif>{{$annee_ajout}}</option>
                    @endforeach
                </select>
                <button type="submit">OK</button>
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
                        <td><a href="{{ route('sports.show', ['sport' => $sport]) }}">{{$sport['nom']}}</a></td>
                        <td>{{$sport['description']}}</td>
                        <td>{{$sport['annee_ajout']}}</td>
                        <td>{{$sport['nb_disciplines']}}</td>
                        <td>{{$sport['nb_epreuves']}}</td>
                        <td>{{$sport['date_debut']->format("d/m/Y")}}</td>
                        <td>{{$sport['date_fin']->format("d/m/Y")}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3>Aucun sport</h3>
        @endif
    </x-layout>
</body>
</html>
