@extends('layout-admin')

@php
    //Lakse mi je ovako iskoristiti USE
    use App\Http\ForecastHelper;
@endphp

@section('content')

    <div class="container mt-4">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fa-solid fa-cloud-sun"></i>
                    Dodaj prognozu
                </h4>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin-forecast-store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Grad
                        </label>

                        <select name="city_id" class="form-select">

                            @foreach($cities as $city)

                                <option value="{{ $city->id }}">
                                    {{ $city->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('city_id')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Temperatura
                        </label>

                        <input type="number"
                               name="temperature"
                               class="form-control">

                        @error('temperature')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Vrijeme
                        </label>

                        <select name="weather_type" class="form-select">

                            <option value="sunny">
                                Sunny
                            </option>

                            <option value="cloudy">
                                Cloudy
                            </option>

                            <option value="rainy">
                                Rainy
                            </option>

                            <option value="snowy">
                                Snowy
                            </option>

                        </select>

                        @error('weather_type')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Vjerovatnoća padavina (%)
                        </label>

                        <input type="number"
                               name="probability"
                               min="1"
                               max="100"
                               class="form-control">

                        @error('probability')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Datum
                        </label>

                        <input type="date"
                               name="date"
                               class="form-control">

                        @error('date')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <button class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Sačuvaj
                    </button>

                </form>

            </div>

        </div>


        <div class="card shadow-sm mt-4">

            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">
                    <i class="fa-solid fa-list"></i>
                    Prognoze gradova
                </h4>
            </div>

            <div class="card-body">

                @foreach($cities as $city)

                    <h5 class="mt-3">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $city->name }}
                    </h5>


                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">

                        <tr>
                            <th>Datum</th>
                            <th>Temperatura</th>
                            <th>Vrijeme</th>
                            <th>Padavine</th>
                        </tr>

                        </thead>


                        <tbody>

                        @foreach($city->forecasts as $forecast)

                            <tr>

                                <td>
                                    {{ $forecast->date }}
                                </td>


                                <td>

                                    <i class="{{ ForecastHelper::weatherIcon($forecast->weather_type) }}"></i>

                                    <span style="color: {{ ForecastHelper::temperatureColor($forecast->temperature) }}">
                                    {{ $forecast->temperature }}°C
                                </span>

                                </td>


                                <td>

                                    @if($forecast->weather_type == 'sunny')
                                        Sunčano

                                    @elseif($forecast->weather_type == 'cloudy')
                                        Oblačno

                                    @elseif($forecast->weather_type == 'rainy')
                                        Kišovito

                                    @elseif($forecast->weather_type == 'snowy')
                                        Snjegovito

                                    @endif

                                </td>


                                <td>

                                    @if($forecast->weather_type == 'rainy' || $forecast->weather_type == 'snowy')
                                        {{ $forecast->probability }}%
                                    @else
                                        -
                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                @endforeach

            </div>

        </div>

    </div>

@endsection
