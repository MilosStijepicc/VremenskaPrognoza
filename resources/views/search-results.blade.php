@extends("layout")

@section("content")

    <div class="container mt-4">

        @if(\Illuminate\Support\Facades\Session::has('error'))
            <p class="text-danger fw-bold col-12"> {{\Illuminate\Support\Facades\Session::get('error')}} </p>
        @endif

        @foreach($cities as $city)

            @php
                $icon = '';

                if ($city->todaysForecast) {
                    $icon = \App\Http\ForecastHelper::weatherIcon($city->todaysForecast->weather_type);
                }
            @endphp

            <div class="d-inline-flex align-items-center m-2">

                @if(in_array($city->id, $userFavourites))
                    <a href="{{ route("city-remove", ['city' => $city->name]) }}" class="btn btn-outline-danger me-2">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                @else
                    <a href="{{ route("city-favourite", ['city' => $city->name]) }}" class="btn btn-outline-danger me-2">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                @endif



                <a href="{{ route('forecast', ['city' => $city->name]) }}" class="btn btn-outline-primary">
                    @if($icon)
                        <i class="{{ $icon }} me-1"></i>
                    @endif

                    {{ $city->name }}
                </a>

            </div>


        @endforeach

    </div>

@endsection
