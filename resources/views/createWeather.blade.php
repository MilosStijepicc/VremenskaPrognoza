@extends('layout')

@section('content')

    <h2 class="mb-4">Dodaj Weather</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('weather-store') }}" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control">
        </div>
        @if ($errors->has('city'))
            <div class="alert alert-danger mt-2">
                {{ $errors->first('city') }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Temperature</label>
            <input type="number" step="0.1" name="temperature" class="form-control">
        </div>

        <button class="btn btn-primary">Save</button>
    </form>

@endsection
