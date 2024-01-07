<x-layout titre="Or">
    <h2>Médailles d'or pour <a href="{{route('sports.show', $sport->id)}}">{{$sport->nom}}</a></h2>
    <h3>Liste des athlètes :</h3>
    @if(count($athletes) > 0)
        <table>
            <tr>
                <th>Nom</th>
                <th>Rang</th>
                <th>Performance</th>
            </tr>
            @foreach($athletes as $athlete)
                <tr>
                    <td><a href="{{route('athletes.show', $athlete->id)}}">{{$athlete->nom}}</a></td>
                    <td>{{$athlete->classement->rang}}@switch($athlete->classement->rang) @case(1)🥇@break @case(2)🥈@break @case(3)🥉@break @endswitch</td>
                    <td>{{$athlete->classement->performance}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h4>Aucun athlète</h4>
    @endif
</x-layout>
