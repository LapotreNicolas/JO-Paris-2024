<html>
<head>
    <title>Liste des sports</title>
</head>
<body>
<form>
    <input type="text" placeholder="Choisissez un sport" name="sport">
    <button type="submit" value="Rechercher"></button>
</form>
<h2>La liste des sports : ({{count($sports)}})</h2>
@if(!empty($sports))
    <ul>
        @foreach($sports as $sport)
            <li>{{$sport['nom']}} : {{$sport['description']}}, ajouté en : {{$sport['annee_ajout']}},
                nombre de disciplines : {{$sport['nb_disciplines']}}, nombre d'épreuves : {{$sport['nb_epreuves']}},
                commence le {{$sport['date_debut']}} et fini le {{$sport['date_fin']}}
            </li>
        @endforeach
    </ul>
@else
    <h3>aucun sport</h3>
@endif
<x-sport titre="Météo du jour" message="Temps dégagé">
    <p>Ces informations ont été obtenues sur le site <a href="https://meteofrance.com/">météo france</a></p>
</x-sport>
    </body>
    </html>
