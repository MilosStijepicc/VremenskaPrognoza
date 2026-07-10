@extends('layout')


@section('content')


    <div class="container mt-5">


        <div class="card shadow-sm">


            <div class="card-header bg-primary text-white">

                <h3>
                    Dodaj prognozu
                </h3>

            </div>


            <div class="card-body">


                @if(session('success'))

                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>

                @endif



                <form method="POST"
                      action="{{ route('admin-forecast-store') }}">

                    @csrf



                    <div class="mb-3">

                        <label class="form-label">
                            Grad
                        </label>


                        <select name="city_id"
                                class="form-select">


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

                        <label>
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

                        <label>
                            Vrijeme
                        </label>

                        <select name="weather_type"
                                class="form-select">
                            <option value="sunny">
                                Sunny
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

                        <label>
                            Datum
                        </label>

                        <input type="date"
                               name="date"
                               class="form-control"
                        >

                        @error('date')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>

                    <button class="btn btn-success">
                        Sačuvaj
                    </button>

                </form>

            </div>

        </div>

        <div class="card shadow-sm mt-5">

            <div class="card-header bg-dark text-white">

                <h3>
                    Prognoze gradova
                </h3>

            </div>

            <div class="card-body">

                @foreach($cities as $city)

                    <h4 class="mt-3">
                        {{ $city->name }}
                    </h4>

                    <table class="table table-bordered">

                        <thead class="table-dark">

                        <tr>

                            <th>
                                Datum
                            </th>

                            <th>
                                Temperatura
                            </th>

                            <th>
                                Vrijeme
                            </th>

                            <th>
                                Padavine
                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($city->forecasts as $forecast)

                            <tr>

                                <td>
                                    {{ $forecast->date }}
                                </td>

                                <td>
                                    {{ $forecast->temperature }}°C
                                </td>

                                <td>
                                    {{ $forecast->weather_type }}
                                </td>

                                <td>

                                    @if($forecast->weather_type != 'sunny')

                                        {{ $forecast->probability }}%

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
