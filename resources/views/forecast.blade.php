@extends('layout')

@section('content')

    <div class="container mt-5">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">
                    Forecast za {{ $city->name }}
                </h3>
            </div>

            <div class="card-body">

                @if($forecasts->isEmpty())

                    <div class="alert alert-danger">
                        Nema podataka za ovaj grad.
                    </div>

                @else

                    <p class="mb-3">
                        Prognoza za naredne dane:
                    </p>

                    <table class="table table-striped">

                        <thead class="table-dark">
                        <tr>
                            <th>Datum</th>
                            <th>Temperatura</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($forecasts as $forecast)

                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($forecast->date)->format('d.m.Y') }}
                                </td>

                                <td>
                                    {{ $forecast->temperature }}°C
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                @endif

            </div>

        </div>

    </div>

@endsection
