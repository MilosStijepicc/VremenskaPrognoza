@extends('layout')

@section('content')

    <h2 class="mb-4">Weather List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>City</th>
            <th>Temperature</th>
        </tr>
        </thead>

        <tbody>
        @foreach($weather as $w)
            <tr>
                <td>{{ $w->id }}</td>
                <td>{{ $w->city->name }}</td>
                <td>{{ $w->temperature }}°C</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
