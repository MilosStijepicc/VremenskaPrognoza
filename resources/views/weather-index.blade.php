@extends('layout')

@section('content')

    <div class="container mt-5">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add Weather</h3>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>

                        </div>
                    @endif

                <form method="POST" action="{{ route('admin-weather-update') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">City</label>

                        <select name="city_id" class="form-select">

                            @foreach($cities as $city)

                                <option value="{{ $city->id }}">
                                    {{ $city->name }}
                                </option>

                            @endforeach

                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Temperature</label>

                        <input type="number"
                               step="0.1"
                               name="temperature"
                               class="form-control"
                               placeholder="Unesite temperaturu">
                    </div>


                    <button class="btn btn-success">
                        Snimi
                    </button>

                </form>

            </div>

        </div>


        <div class="card shadow-sm mt-4">

            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Weather List</h3>
            </div>

            <div class="card-body">

                <table class="table table-striped table-bordered">

                    <thead class="table-dark">
                    <tr>
                        <th>City</th>
                        <th>Temperature</th>
                    </tr>
                    </thead>


                    <tbody>

                    @foreach($weather as $w)

                        <tr>
                            <td>
                                {{ $w->city->name }}
                            </td>

                            <td>
                                {{ $w->temperature }}°C
                            </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
