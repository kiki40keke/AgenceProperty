@extends('admin.layout')

@section('title', 'Option Listings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>@yield('title')</h1>
        <a href="{{ route('admin.option.create') }}" class="btn btn-primary">Add New option</a>
    </div>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($options as $option)
            <tr>
                <td>{{ $option->id }}</td>
                <td>{{ $option->name }}</td>

                <td>
                    <a href="{{ route('admin.option.edit', $option) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.option.destroy', $option) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this option?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $options->links() }}
@endsection
