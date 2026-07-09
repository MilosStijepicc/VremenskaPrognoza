@extends('layout')

@section('content')

    <h2 class="mb-4">Edit Weather</h2>

    <form method="POST" action="{{ route('weather-update', $weather->id) }}" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">City</label>

            <input type="text"
                   name="city"
                   value="{{ old('city', $weather->city->name) }}"
                   class="form-control">

            @error('city')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Temperature</label>

            <input type="number"
                   step="0.1"
                   name="temperature"
                   value="{{ old('temperature', $weather->temperature) }}"
                   class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>

@endsection
