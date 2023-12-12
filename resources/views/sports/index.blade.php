<html>
<head>
    <title>Liste des sports</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
        @if(isset($cookieAnnee) && $annee === 'All' || isset($cookieNom) || isset($cookieDebut))
            <br>
            <a href="{{route('sports.index')}}?reset=true">Réinitialiser les cookies</a>
        @endif
        <br>
        <form action="{{route('sports.index')}}" method="get">
            <h4>Nom d'un sport</h4>
            <input type="text" placeholder="Entrez un nom" value="@if (isset($nom)){{$nom}}@else{{$cookieNom}}@endif" name="nom">
            <br>
            <h4>Filtrage par année d'ajout</h4>
            <select name="annee">
                <option value="All" @if($annee == 'All') selected @endif>-- Toutes les années d'ajout --</option>
                @foreach($annees_ajout as $annee_ajout)
                    <option value="{{$annee_ajout}}" @if($annee == $annee_ajout || $annee != 'All' && isset($cookieAnnee) && $cookieAnnee == $annee_ajout) selected @endif>{{$annee_ajout}}</option>
                @endforeach
            </select>
            <br>
            <div>
                <label>Pas de tri</label>
                <input type="radio" name="debut" value="none" @if (!isset($debut) || $debut == 'none' || isset($cookieDebut) && $cookieDebut === 'none') checked @endif>
            </div>
            <div>
                <label>Tri par nom croissant</label>
                <input type="radio" name="debut" value="asc" @if ($debut == 'asc' || $debut != 'none' && isset($cookieDebut) && $cookieDebut === 'asc') checked @endif>
            </div>
            <div>
                <label>Tri par nom décroissant</label>
                <input type="radio" name="debut" value="desc" @if ($debut == 'desc' || $debut != 'none' && isset($cookieDebut) && $cookieDebut === 'desc') checked @endif>
            </div>
            <button type="submit">Rechercher</button>
        </form>
        <br>
        <a href="{{route('sports.create')}}"><button>Ajouter un sport</button></a>
        <h2>La liste des sports : ({{count($sports)}})</h2>
        @if(!empty($sports))
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
