@extends('client.layout')

@section('title', 'All Properties')
@section('content')
    <div class="bg-light">
        <div class="container py-4">
            <h1 class="fw-bold mb-3">All Properties</h1>
            <p class="lead text-muted">Explore our extensive list of properties available for sale and rent. Find your dream home today!</p>
          @include('client.property.form')
        </div>
    </div>
    @include('shared.card')
    <div class="container mt-4">
        {{ $properties->links() }}
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect('select[multiple]', {
                plugins: ['remove_button'],
                maxItems: null,
                placeholder: 'Select options...'
            });
        });
    </script>
@endsection
