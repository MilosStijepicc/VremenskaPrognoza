@extends('layout')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">
                            <i class="fas fa-city text-primary"></i>
                            Pretraga grada
                        </h5>
                        <form action="{{ route('forecast-search') }}" method="GET">
                            <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    placeholder="Unesite ime grada">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Pronađi
                                </button>
                            </div>
                        </form>
                        @if ($errors->has('city'))
                            <div class="alert alert-danger mt-3">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                    </div>
                </div>

                @if(isset($favouriteCities) && $favouriteCities->count())

                    <div class="card shadow-sm mt-4">

                        <div class="card-body">

                            <h5 class="card-title mb-3">
                                <i class="fa-solid fa-heart text-danger"></i>
                                Moji omiljeni gradovi
                            </h5>

                            @foreach($favouriteCities as $favourite)

                                @php
                                    $city = $favourite->city;
                                    $icon = '';
                                    if ($city->todaysForecast) {
                                        $icon = \App\Http\ForecastHelper::weatherIcon(
                                            $city->todaysForecast->weather_type
                                        );
                                    }
                                @endphp

                                <a href="{{ route('forecast', ['city' => $city->name]) }}"
                                   class="btn btn-outline-primary w-100 mb-2 d-flex justify-content-between align-items-center">
                                <span>
                                    {{ $city->name }}

                                    @if($city->todaysForecast)
                                        - {{ $city->todaysForecast->temperature }}°C
                                    @endif

                                </span>
                                    @if($icon)
                                        <i class="{{ $icon }}"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection
