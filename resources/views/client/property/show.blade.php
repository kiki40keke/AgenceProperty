@extends('client.layout')

@section('title', $property->title)

@section('content')
    <div class="container py-5">

        <div class="row">
            <!-- Image -->
            <div class="col-md-6 mb-4">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($property->pictures as $picture)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ $picture->getPicturesUrl() ?? 'https://placehold.co/600x400' }}"
                                     alt="Image propriété" width="600px" height="400px" class="img-fluid rounded shadow-sm">
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <p class="mb-3">
                    @if($property->options->isNotEmpty())
                        {{-- option: vous pouvez afficher en badges pill --}}
                        <strong>Équipements :</strong>
                        @foreach($property->options as $opt)
                            <span class="badge bg-primary text-white rounded-pill">{{ $opt->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Aucun équipement</span>
                    @endif
                </p>
            </div>


            <!-- Infos principales -->
            <div class="col-md-6">
                <h2 class="fw-bold text-primary">{{ $property->title }}</h2>
                <p class="text-muted mb-2">{{ $property->address }}</p>

                <h4 class="text-success fw-bold mb-3">{{ number_format($property->price, 0, ',', ' ') }} €</h4>

                <p class="mb-3">{{ $property->description }}</p>

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="fw-semibold mb-2">Détails</h5>
                        <ul class="list-unstyled">
                            <li><strong>Surface :</strong> {{ $property->surface }} m<sup>2</sup></li>
                            <li><strong>Pièces :</strong> {{ $property->rooms }}</li>
                            <li><strong>Chambres :</strong> {{ $property->bedrooms }}</li>
                            <li><strong>Étage :</strong> {{ $property->floor }}</li>
                            <li><strong>Ville :</strong> {{ $property->city }}</li>
                            <li><strong>Adresse :</strong> {{ $property->address }}</li>

                            <li><strong>Code postal :</strong> {{ $property->postal_code }}</li>
                        </ul>
                    </div>


                </div>



                <a href="{{ route('properties.index') }}" class="btn btn-outline-primary mt-3">
                    Retour à la liste
                </a>
            </div>
        </div>

        <div class="mt-4">
            <h5>Do you like ?</h5>
            <form action="{{route('properties.contact',$property)}}" method="post">

                @csrf
                <div class="row">
                    @include('shared.input', ['type' => 'text', 'class' => 'col-6', 'label' => 'First name', 'name' => 'first_name', 'value' => '',  'placeholder' => 'Your first name'])
                    @include('shared.input', ['type' => 'text', 'class' => 'col-6', 'label' => 'Last name', 'name' => 'last_name', 'value' => '',  'placeholder' => 'Your last name'])
                </div>

                <div class="row">
                    @include('shared.input', ['type' => 'text', 'class' => 'col-6', 'label' => 'Phone', 'name' => 'phone', 'value' => '',  'placeholder' => 'Your phone number'])
                    @include('shared.input', ['type' => 'email', 'class' => 'col-6', 'label' => 'Email', 'name' => 'email', 'value' => '',  'placeholder' => 'Your email address'])
                </div>

                @include('shared.input', ['type' => 'textarea', 'class' => 'col-12', 'label' => 'Message', 'name' => 'message', 'value' => '',  'placeholder' => 'Your message', 'rows' => 5])




                <div class="col-md-6 mt-3">
                    <button type="submit" class="btn btn-outline-primary">
                        Contact us
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

