<x-layout titre="Sport">
        <div class="text-center" style="margin-top: 2rem">
            @if($action == 'delete')
                <h3>Suppression du sport</h3>
                <hr class="mt-2 mb-2">
            @elseif($action == 'upload')
                <h3>Ajout d'une image pour le sport</h3>
                <hr class="mt-2 mb-2">
            @else
                <h3>Affichage du sport</h3>
                <hr class="mt-2 mb-2">
                @can('update',$sport)
                    <a href="{{ route('sports.edit', ['sport' => $sport]) }}"><button>Modifier le sport</button></a>
                @endcan
                @can('delete',$sport)
                    <a href="{{ route('sports.show', ['sport' => $sport, 'action' => 'delete']) }}"><button>Supprimer le sport</button></a>
                @endcan
                @can('upload',$sport)
                    <a href="{{ route('sports.show', ['sport' => $sport, 'action' => 'upload']) }}"><button>Ajouter une image pour le sport</button></a>
                @endcan
            @endif
        </div>
        <h2>{{$sport['nom']}}</h2>
        <h3>{{$sport['description']}}</h3>
        <h3>Ajouté en : {{$sport['annee_ajout']}}</h3>
        <h3>Nombre de disciplines : {{$sport['nb_disciplines']}}</h3>
        <h3>Nombre d'épreuves : {{$sport['nb_epreuves']}}</h3>
        <h3>Débute le : {{$sport['date_debut']->format("d/m/Y")}}</h3>
        <h3>Fini le : {{$sport['date_fin']->format("d/m/Y")}}</h3>
        <h3>Crée par : {{$sport->user->name}}</h3>
        <h3>Liste des athlètes :</h3>
        @if(count($sport->athletes) > 0)
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Nationalité</th>
                    <th>Rang</th>
                    <th>Performance</th>
                </tr>
                @foreach($sport->athletes as $athlete)
                    <tr>
                        <td><a href="{{route('athletes.show', $athlete->id)}}">{{$athlete->nom}}</a></td>
                        <td>{{$athlete->nationalite}}</td>
                        <td>{{$athlete->classement->rang}}@switch($athlete->classement->rang) @case(1)🥇@break @case(2)🥈@break @case(3)🥉@break @endswitch</td>
                        <td>{{$athlete->classement->performance}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h4>Aucun athlète</h4>
        @endif
        @if (isset($sport['url_media']))
            <img src="{{Storage::url($sport['url_media'])}}">
        @endif
        @if($action == 'delete')
            <form action="{{route('sports.destroy',$sport)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <button type="submit" name="delete" value="valide">Valide</button>
                    <button type="submit" name="delete" value="annule">Annule</button>
                </div>
            </form>
        @elseif($action == 'upload')
            <h2>Choix d'une image</h2>
            <form action="{{route('sports.upload', ['id' => $sport])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="doc">Image : </label>
                    <input type="file" name="document" id="doc">
                </div>
                <input type="submit" value="Télécharger" name="submit">
            </form>
        @endif
</x-layout>
