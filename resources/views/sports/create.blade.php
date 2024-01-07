<x-layout titre="Création sport">
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('sports.store', ['user_id' => Auth::id()])}}" method="POST">
        {!! csrf_field() !!}
        <div class="text-center" style="margin-top: 2rem">
            <h3>Ajout d'un sport</h3>
            <hr class="mt-2 mb-2">
        </div>
        <div>
            <label for="nom"><strong>Nom : </strong></label>
            <input type="text" placeholder="Nom" value="{{ old('nom') }}" name="nom">
        </div>
        <div>
            <label for="description"><strong>Description : </strong></label>
            <textarea name="description" id="description" rows="6" class="form-control"
                      placeholder="Description...">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="annee_ajout"><strong>Année d'ajout : </strong></label>
            <input type="number" placeholder="1900" name="annee_ajout" value="{{ old('annee_ajout') }}">
        </div>
        <div>
            <label for="nb_disciplines"><strong>Nombre de disciplines : </strong></label>
            <input type="range" min="1" max="10" value="{{ old("nb_disciplines") }}" name="nb_disciplines">
        </div>
        <div>
            <label for="nb_epreuves"><strong>Nombre d'épreuves : </strong></label>
            <input type="range" min="1" max="10" value="{{ old("nb_epreuves") }}" name="nb_epreuves">
        </div>
        <div>
            <label for="date_debut"><strong>Date de début : </strong></label>
            <input type="date" name="date_debut" id="date_debut" value="{{ old("date_debut") }}"
                   placeholder="aaaa-mm-jj">
        </div>
        <div>
            <label for="date_fin"><strong>Date de fin : </strong></label>
            <input type="date" name="date_fin" id="date_fin" value="{{ old("date_debut") }}"
                   placeholder="aaaa-mm-jj">
        </div>
        <div>
            <input type="submit" value="Envoyer">
        </div>
    </form>
</x-layout>
