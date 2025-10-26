@extends('admin.layout')

@section('title', 'Property Listings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Property Listings</h1>
        <a href="{{ route('admin.property.create') }}" class="btn btn-primary">Add New Property</a>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Surface</th>
                <th>Price</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->surface }}m²</td>
                    <td>${{ number_format($property->price, 2) }}</td>
                    <td>{{ $property->city }}</td>
                    <td>
                        <a href="{{ route('admin.property.show', $property) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this property?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $properties->links() }}
@endsection
