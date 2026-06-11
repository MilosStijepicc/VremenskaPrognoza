@extends('layout')

@section('content')

    <div class="container mt-5">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Forecast za {{ $city }}</h3>
            </div>

            <div class="card-body">

                @if($temps === null)
                    <div class="alert alert-danger">
                        Nema podataka za ovaj grad.
                    </div>
                @else
                    <p class="mb-3">Temperatura za narednih 5 dana:</p>

                    <ul class="list-group">
                        @foreach($temps as $index => $temp)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Dan {{ $index + 1 }}
                                <span class="badge bg-primary rounded-pill">
                                {{ $temp }}°C
                            </span>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>

    </div>

@endsection
