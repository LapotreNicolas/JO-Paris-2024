<x-layout titre="Liste des athletes">
    <h2>La liste des athletes : ({{count($athletes)}})</h2>
    @if(!empty($athletes))
        <table>
            <tr>
                <th>Nom</th>
                <th>Nationalité</th>
                <th>Age</th>
            </tr>
            @foreach($athletes as $athlete)
                <tr>
                    <td><a href="{{route('athletes.show', $athlete->id)}}">{{$athlete['nom']}}</a></td>
                    <td>{{$athlete['nationalite']}}</td>
                    <td>{{$athlete['age']}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h3>Aucun athlete</h3>
    @endif
</x-layout>
