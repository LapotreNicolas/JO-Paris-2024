<html>
<head>
    <title>Sport</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
        <div class="text-center" style="margin-top: 2rem">
            @if($action == 'delete')
                <h3>Suppression du sport</h3>
                <hr class="mt-2 mb-2">
            @else
                <h3>Affichage du sport</h3>
                <hr class="mt-2 mb-2">
                <a href="{{ route('sports.edit', ['sport' => $sport]) }}"><button>Modifier le sport</button></a>
                <a href="{{ route('sports.destroy', ['sport' => $sport, 'action' => 'delete']) }}"><button>Supprimer le sport</button></a>
            @endif
        </div>
        <h2>{{$sport['nom']}}</h2>
        <h3>{{$sport['description']}}</h3>
        <h3>Ajouté en : {{$sport['annee_ajout']}}</h3>
        <h3>Nombre de disciplines : {{$sport['nb_disciplines']}}</h3>
        <h3>Nombre d'épreuves : {{$sport['nb_epreuves']}}</h3>
        <h3>Débute le : {{$sport['date_debut']->format("d/m/Y")}}</h3>
        <h3>Fini le : {{$sport['date_fin']->format("d/m/Y")}}</h3>
        @if($action == 'delete')
            <form action="{{route('sports.destroy',$sport)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <button type="submit" name="delete" value="valide">Valide</button>
                    <button type="submit" name="delete" value="annule">Annule</button>
                </div>
            </form>
        @endif
    </x-layout>
</body>
</html>
