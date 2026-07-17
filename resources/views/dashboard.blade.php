@extends('layout')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title text-center mb-3">
                            <i class="fas fa-city text-primary"></i> Pretraga grada
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
                                    <i class="fas fa-search"></i> Pronađi
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

            </div>
        </div>
    </div>

@endsection
