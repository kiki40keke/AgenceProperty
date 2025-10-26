@extends('admin.layout')

@section('title',$property->exists ? 'Edit Property' : 'Add New Property')

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3">Create a property</h3>

            <form action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store',$property) }}" method="post"  enctype="multipart/form-data" novalidate>
                @csrf
               @method($property->exists ? 'PUT' : 'POST')


                <div class="row g-3">
                    @include('shared.input', ['class' => 'col-12', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title ?? '', 'placeholder' => 'Ex: Beautiful bright apartment'])

                    @include('shared.input', ['type' => 'textarea', 'class' => 'col-12', 'label' => 'Description', 'name' => 'description', 'value' => $property->description ?? '', 'placeholder' => 'Décrivez la propriété...'])

                    @include('shared.input', ['type' => 'number', 'class' => 'col-sm-6 col-md-3', 'label' => 'Surface (m²)', 'name' => 'surface', 'value' => $property->surface ?? '', 'min' => 0, 'step' => '0.1', 'placeholder' => '85'])

                    @include('shared.input', ['type' => 'number', 'class' => 'col-sm-6 col-md-3', 'label' => 'Pièces', 'name' => 'rooms', 'value' => $property->rooms ?? '', 'min' => 0, 'step' => 1, 'placeholder' => '4'])

                    @include('shared.input', ['type' => 'number', 'class' => 'col-sm-6 col-md-3', 'label' => 'Chambres', 'name' => 'bedrooms', 'value' => $property->bedrooms ?? '', 'min' => 0, 'step' => 1, 'placeholder' => '2'])

                    @include('shared.input', ['type' => 'number', 'class' => 'col-sm-6 col-md-3', 'label' => 'Floor', 'name' => 'floor', 'value' => $property->floor ?? '', 'step' => 1, 'placeholder' => '3'])

                    @include('shared.input', ['type' => 'number', 'class' => 'col-sm-6 col-md-4', 'label' => 'Prix (€)', 'name' => 'price', 'value' => $property->price ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => '350000'])

                    @include('shared.input', ['class' => 'col-sm-6 col-md-4', 'label' => 'Address', 'name' => 'address', 'value' => $property->address ?? '', 'placeholder' => '_12RueDeLExemple'])

                    @include('shared.input', ['class' => 'col-sm-6 col-md-4', 'label' => 'City', 'name' => 'city', 'value' => $property->city ?? '', 'placeholder' => 'Paris'])

                    @include('shared.input', ['class' => 'col-sm-6 col-md-3', 'label' => 'codePostal', 'name' => 'postal_code', 'value' => $property->postal_code ?? '', 'pattern' => '[0-9]{2,10}', 'placeholder' => '75010'])

                    @include('shared.input', ['type' => 'checkbox', 'class' => 'col-sm-6 col-md-3 d-flex align-items-center', 'label' => 'sold', 'name' => 'sold', 'value' => $property->sold ?? 0])

                    @include('shared.input', ['type' => 'file', 'class' => 'col-12', 'label' => 'Images (optional)', 'name' => 'images', 'accept' => 'image/*', 'multiple' => true, 'help' => 'Accepted formats: jpg, png. Maximum size to manage on the server side.'])

                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ $property->exists ? 'Update Property' : 'Create Property' }}
                            </button>
                            <a href="/admin/properties" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
