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
        <h2>Your Rank</h2>
        <table class="table table-bordered">
            <tbody>
                @php
                    use Carbon\Carbon;
                @endphp
                <thead>
                    <tr>
                        <th scope="col" style="background-color: #D8EFD3;">Rank</th>
                        <th scope="col" style="background-color: #D8EFD3;">Name</th>
                        <th scope="col" style="background-color: #D8EFD3;">Days Streak</th>
                        <th scope="col" style="background-color: #D8EFD3;">Last Relapsed</th>
                    </tr>
                </thead>
                @foreach ($rankUser as $dataUsers)
                    @php
                        if ($dataUsers->lastRelapsed) {
                            $lastRelapsed = Carbon::parse($dataUsers->lastRelapsed);
                            $daysAgo = $lastRelapsed->diffInDays(Carbon::now()); // Selisih dalam hari penuh
                            $daysAgo = floor($daysAgo);
                            Carbon::setLocale('id');
                            $formattedDate = $lastRelapsed->translatedFormat('j F Y');  // Format: 1 Februari 2024
                        } else {
                            $daysAgo = '0';
                            $formattedDate = '-';
                        }
                    @endphp
                  @if ($dataUsers->id == auth()->user()->id)
                  <tr>
                    <th style="background-color: #d7d3ef" scope="row">
                        @if ($loop->iteration == 1)
                        {{ $loop->iteration }}.&nbsp;
                            <img src="{{ asset('images/gold.png') }}" alt="Gold"
                                style="width: 20px;"> <!-- Ikon emas -->
                        @elseif ($loop->iteration == 2)
                        {{ $loop->iteration }}.&nbsp;

                            <img src="{{ asset('images/silver.png') }}" alt="Silver"
                                style="width: 20px;"> <!-- Ikon perak -->
                        @elseif ($loop->iteration == 3)
                        {{ $loop->iteration }}.&nbsp;

                            <img src="{{ asset('images/bronze.png') }}" alt="Bronze"
                                style="width: 20px;"> <!-- Ikon perunggu -->
                        @else
                            {{ $loop->iteration }}
                        @endif
                    </th>
                      <td style="background-color: #d7d3ef">{{ $dataUsers->name }}</td>
                      <td style="background-color: #d7d3ef"><b>[{{ $daysAgo }}]</b> days ago</td>
                      <!-- Menampilkan selisih hari -->
                      <td style="background-color: #d7d3ef">{{ $formattedDate }}</td>
                      <!-- Menampilkan lastRelapsed -->
                  </tr>
              @else
                  <tr>
                      <th scope="row">
                          @if ($loop->iteration == 1)
                          {{ $loop->iteration }}.  &nbsp;
                              <img src="{{ asset('images/gold.png') }}" alt="Gold"
                                  style="width: 20px;"> <!-- Ikon emas -->
                          @elseif ($loop->iteration == 2)
                          {{ $loop->iteration }}.  &nbsp;

                              <img src="{{ asset('images/silver.png') }}" alt="Silver"
                                  style="width: 20px;"> <!-- Ikon perak -->
                          @elseif ($loop->iteration == 3)
                          {{ $loop->iteration }}.  &nbsp;

                              <img src="{{ asset('images/bronze.png') }}" alt="Bronze"
                                  style="width: 20px;"> <!-- Ikon perunggu -->
                          @else
                              {{ $loop->iteration }}
                          @endif
                      </th>
                      <td>{{ $dataUsers->name }}</td>
                      <td><b>[{{ $daysAgo }}]</b> days ago</td> <!-- Menampilkan selisih hari -->
                      <td>{{ $formattedDate }}</td> <!-- Menampilkan lastRelapsed -->
                  </tr>
              @endif

                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
