<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Font Awesome for user icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}">kembali</a>
        <h2>Your History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="background-color: #D8EFD3;">No</th>
                    <th scope="col" style="background-color: #D8EFD3;">Relapse Days</th>
                    <th scope="col" style="background-color: #D8EFD3;">Reasons</th>
                </tr>
            </thead>
            @php
                use Carbon\Carbon;
            @endphp
            @foreach ($history as $his)
                @php
                    $lastRelapsed = Carbon::parse($his->relapseDays);

                    Carbon::setLocale('id');
                    $formattedDate = $lastRelapsed->translatedFormat('j F Y');
                @endphp
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{$formattedDate}}</td>
                <td>{{$his->reasons}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>

