<x-layout titre="Athlete">
    <h2>{{$athlete->nom}}</h2>
    <h3>{{$athlete->nationalite}}</h3>
    <h3>{{$athlete->age}} ans</h3>
    <h3>Liste des sports :</h3>
    @if(count($athlete->sports) > 0)
        <table>
            <tr>
                <th>Sport</th>
                <th>Rang</th>
                <th>Performance</th>
            </tr>
            @foreach($athlete->sports as $sport)
                <tr>
                    <td><a href="{{route('sports.show', $sport->id)}}">{{$sport->nom}}</a></td>
                    <td>{{$sport->classement->rang}}@switch($sport->classement->rang) @case(1)🥇@break @case(2)🥈@break @case(3)🥉@break @endswitch</td>
                    <td>{{$sport->classement->performance}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <h4>Aucun sport</h4>
    @endif
</x-layout>
