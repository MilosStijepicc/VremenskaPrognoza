@extends('layout')

@section('content')

    <h2 class="mb-4">Change Weather</h2>

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th>City</th>
            <th>Temperature</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        @foreach($weather as $w)
            <tr>
                <td>{{ $w->city->name }}</td>
                <td>{{ $w->temperature }}°C</td>

                <td>
                    <a href="{{ route('weather-edit', $w->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                </td>

                <td>
                    <form method="POST" action="{{ route('weather-destroy', $w->id) }}">
                        @csrf
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this item?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
