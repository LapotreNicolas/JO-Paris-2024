<html>
<head>
    <title>Modification sport</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('sports.update',$sport->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="text-center" style="margin-top: 2rem">
                <h3>Modification d'un sport</h3>
                <hr class="mt-2 mb-2">
            </div>
            <div>
                <label for="nom"><strong>Nom :</strong></label>
                <input type="text" placeholder="Nom" value="{{ $sport['nom'] }}" name="nom">
            </div>
            <div>
                <label for="description"><strong>Description :</strong></label>
                <textarea name="description" id="description" rows="6" class="form-control"
                          placeholder="Description...">{{ $sport['description'] }}</textarea>
            </div>
            <div>
                <label for="annee_ajout"><strong>Année d'ajout :</strong></label>
                <input type="number" placeholder="1900" value="{{ $sport['annee_ajout'] }}" name="annee_ajout">
            </div>
            <div>
                <label for="nb_disciplines"><strong>Nombre de disciplines :</strong></label>
                <input type="range" min="1" max="10" value="{{ $sport['nb_disciplines'] }}" name="nb_disciplines">
            </div>
            <div>
                <label for="nb_epreuves"><strong>Nombre d'épreuves :</strong></label>
                <input type="range" min="1" max="10" value="{{ $sport['nb_epreuves'] }}" name="nb_epreuves">
            </div>
            <div>
                <label for="date_debut"><strong>Date de début : </strong></label>
                <input type="date" name="date_debut" id="date_debut"
                       value="{{$sport['date_debut']->format('Y-m-d')}}">
            </div>
            <div>
                <label for="date_fin"><strong>Date de fin : </strong></label>
                <input type="date" name="date_fin" id="date_fin"
                       value="{{ $sport['date_fin']->format('Y-m-d') }}">
            </div>
            <div>
                <input type="submit" value="Modifier">
            </div>
        </form>
    </x-layout>
</body>
</html>
