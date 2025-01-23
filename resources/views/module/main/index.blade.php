<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for user icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>TrackerDay | {{ $thisUser['name'] }}</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #95D2B3;
            margin: 0;
        }

        .container-time {
            text-align: center;
            position: relative;
            border: 2px solid #333;
            padding: px;
            border-radius: 50%;
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: white;
        }

        .title {
            font-size: 20px;
            color: #333;
        }

        .day {
            font-size: 62px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .clock {
            font-size: 23px;
            color: #679686;
            margin-top: -15px;
        }

        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #333333;
            /* A cool blue color */
        }
    </style>
</head>
@php
    use Carbon\Carbon;
    $lastRelapsed = Carbon::parse($thisUser->lastRelapsed);
    $date = str_pad($lastRelapsed->day, 2, '0', STR_PAD_LEFT); // Menjamin format 01, 02, dst.
    $month = str_pad($lastRelapsed->month, 2, '0', STR_PAD_LEFT); // Menjamin format 01, 02, dst.
    $year = $lastRelapsed->year; // Tahun tetap seperti apa adanya
@endphp

<body>
    <div class="container d-flex flex-column  align-items-center " style="width: 550px;">
        <div class="navbar" style="width: 100%;">
            <nav class="navbar  rounded" style="width: 100%; background-color: white;">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand" href="#">TrackerDay</a>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span>{{ $thisUser->name }}</span>
                            <i class="fas fa-user-circle fa-2x ms-2"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser">Edit</a></li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>

                        </ul>
                    </div>

                </div>
            </nav>
        </div>
        <div class="time">
            <div class="container-time mt-4">
                <div class="title">I Promise You!</div>
                <div id="day" class="day">0d</div>
                <h1 id="clock" class="clock">00:00:00</h1>
                @if ($thisUser->lastRelapsed == null)
                    <a id="restartButton" class="btn btn-primary rounded-circle position-absolute"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                        style="width: 50px; height: 50px; right: 27px; bottom: 10px;">
                        <p class="ms-1 fs-5" style="margin-top: 1.4px;">▷</p>
                    </a>
                @else
                    <a id="restartButton" class="btn btn-primary rounded-circle position-absolute"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                        style="width: 50px; height: 50px; right: 27px; bottom: 10px;">
                        <p class="ms-1 fs-5" style="margin-top: 1.4px;">↺</p>
                    </a>
                @endif
            </div>
        </div>
        <div class="table mt-4">
            <a href="{{ route('rank') }}" class="btn mb-2" style="background-color: #55AD9B; color: white;">My Rank</a>
            <a href="{{ route('history') }}" class="btn mb-2"
                style="background-color: white; color: #55AD9B;">History</a>
            <!-- <a href="" class="btn btn-warning mb-2">asdfs</a> -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="background-color: #D8EFD3;">Rank</th>
                        <th scope="col" style="background-color: #D8EFD3;">Name</th>
                        <th scope="col" style="background-color: #D8EFD3;">Days Streak</th>
                        <th scope="col" style="background-color: #D8EFD3;">Last Relapsed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankUser as $dataUsers)
                        @php
                            if ($dataUsers->lastRelapsed) {
                                $lastRelapsed = Carbon::parse($dataUsers->lastRelapsed);
                                $daysAgo = $lastRelapsed->diffInDays(Carbon::now()); // Selisih dalam hari penuh
                                $daysAgo = floor($daysAgo);
                                Carbon::setLocale('id');
                                $formattedDate = $lastRelapsed->translatedFormat('j F Y'); // Format: 1 Februari 2024
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
                                <td>{{ $dataUsers->name }}</td>
                                <td><b>[{{ $daysAgo }}]</b> days ago</td> <!-- Menampilkan selisih hari -->
                                <td>{{ $formattedDate }}</td> <!-- Menampilkan lastRelapsed -->
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('relapsed') }}" method="post">
                    @csrf
                    @if ($thisUser->lastRelapsed !== null)
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Why did it happen?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <textarea class="form-control" placeholder="tell me here!" name="reason" id="floatingTextarea"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Relapsed</button>
                        </div>
                    @else
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Get ready for the challenge!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Start</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('edit-user') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $thisUser->name }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script>
    let timer;
    let elapsedTime = 0;
    let thisUser = {!! json_encode($thisUser) !!}
    let startDate = 0;

    if (thisUser['lastRelapsed'] !== null) {
        startDate = new Date(thisUser['lastRelapsed']).getTime() + (7 * 3600000);
    }

    function startClock() {
        timer = setInterval(updateClock, 1000);
    }

    function updateClock() {
        const currentTime = Date.now();
        elapsedTime = currentTime - startDate;
        const formattedTime = formatTime(elapsedTime);
        console.log(formattedTime);
        document.getElementById('clock').innerText = formattedTime;

        const days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));
        document.getElementById('day').innerText = `${days} days`;
    }

    function formatTime(milliseconds) {
        const totalSeconds = Math.floor(milliseconds / 1000);
        const hours = Math.floor((totalSeconds % 86400) / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
    }

    function pad(num) {
        return num.toString().padStart(2, '0');
    }
    if (thisUser['lastRelapsed'] !== null) {
        window.onload = startClock;
    }
</script>

</html>
