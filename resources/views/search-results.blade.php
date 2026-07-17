@extends("layout")

@section("content")

    <div class="container mt-4">

        @foreach($cities as $city)

            @php
                $icon = '';

                if ($city->todaysForecast) {
                    $icon = \App\Http\ForecastHelper::weatherIcon($city->todaysForecast->weather_type);
                }
            @endphp

            <a href="{{ route('forecast', ['city' => $city->name]) }}"
               class="btn btn-outline-primary m-2">

                @if($icon)
                    <i class="{{ $icon }}"></i>
                @endif

                {{ $city->name }}

            </a>

        @endforeach

    </div>

@endsection
