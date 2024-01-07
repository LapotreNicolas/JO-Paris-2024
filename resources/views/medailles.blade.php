<x-layout titre="Médailles">
    @foreach($sports as $sport)
        @if (count($sport->athletes()->where('rang', '<=', 3)->get()) > 0)
            <div>
                <h3>Médailles pour <a href="{{route('sports.show', $sport->id)}}">{{$sport->nom}}</a></h3>
                <ul>
                    @foreach($sport->athletes()->where('rang', '<=', 3)->get() as $athlete)
                        <li>@switch($athlete->classement->rang) @case(1)🥇@break @case(2)🥈@break @default🥉@break @endswitch <a href="{{route('athletes.show', $athlete->id)}}">{{$athlete->nom}}</a> {{$athlete->nationalite}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endforeach
</x-layout>
