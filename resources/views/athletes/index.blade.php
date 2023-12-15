<html>
<head>
    <title>Liste des sports</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
    <x-layout>
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
                        <td>{{$athlete['nom']}}</td>
                        <td>{{$athlete['nationalite']}}</td>
                        <td>{{$athlete['age']}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3>Aucun athlete</h3>
        @endif
    </x-layout>
</body>
</html>
