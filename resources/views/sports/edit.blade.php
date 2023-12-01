<html>
<head>
    <title>Modification sport</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
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
            <label for="Nom"><strong>Date d'expiration : </strong></label>
            <input type="text" name="nom" id="nom"
                   value="{{ $sport->nom }}">
        </div>
        <div>
            <label for="categorie"><strong>Catégorie</strong></label>
            <input type="text" class="form-control" id="categorie" name="categorie"
                   value="{{ $sport->categorie}}">
        </div>
        <div>
            <label for="accomplie"><strong>Accomplie ?</strong></label>
            @if($sport->accomplie !== NULL && ($sport->accomplie == 'O' || $sport->accomplie == 'on'))
                <input type="checkbox" name="accomplie" checked id="accomplie">
            @else
                <input type="checkbox" name="accomplie" id="accomplie">
            @endif
        </div>
        <div>
            <label for="textarea-input"><strong>Description :</strong></label>
            <textarea name="description" id="description" rows="6" class="form-control"
                      placeholder="Description..">{{ $sport->description }}</textarea>
        </div>
        <div>
            <button class="btn btn-success" type="submit">Valide</button>
        </div>
    </form>
</body>
</html>
