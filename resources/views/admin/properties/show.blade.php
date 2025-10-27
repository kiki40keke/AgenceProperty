@extends('admin.layout')
@section('title', 'Property Details')

@section('content')
    <div class="card shadow-sm mb-4" id="propertyCard">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h2 class="card-title mb-0">{{ $property->title }}</h2>
                    <small class="text-muted">{{ $property->address }}</small>
                </div>

                <div class="text-end">
                    <h4 class="text-success mb-1">
                        {{ number_format($property->price ?? 0, 0, ',', ' ') }} €
                    </h4>

                    <div class="d-flex gap-2 justify-content-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.property.edit', $property->id) }}">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>

                        <!-- Deletion via recommended form -->
                        <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cette propriété ?')">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>

                    <!-- Badges: état et équipements placés sous les actions pour cohérence -->
                    <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
                        <span class="badge rounded-pill {{ $property->sold ? 'bg-secondary' : 'bg-success' }}">
                            {{ $property->sold ? 'Sold' : 'Available' }}
                        </span>

                        @if($property->options->isNotEmpty())
                            {{-- option: vous pouvez afficher en badges pill --}}
                            @foreach($property->options as $opt)
                                <span class="badge bg-primary text-white rounded-pill">{{ $opt->name }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">Aucun équipement</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Left: image -->
                <div class="col-lg-6">
                    <div class="carousel-inner">
                        @foreach($property->pictures as $picture)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ $picture->getPicturesUrl() ?? 'https://placehold.co/600x400' }}"
                                     alt="Image propriété" width="600px" height="400px" class="img-fluid rounded shadow-sm">
                            </div>
                        @endforeach

                    </div>

                    {{-- If you want thumbnails or multiple images, consider adding them here --}}
                </div>

                <!-- Right: details -->
                <div class="col-lg-6">
                    <h5>Description</h5>
                    <p class="text-muted mb-3">
                        {{ $property->description }}
                    </p>

                    <h5 class="mt-2">Détails</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Surface</strong>
                                    <span class="text-muted">{{ $property->surface }} m²</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Pièces</strong>
                                    <span class="text-muted">{{ $property->rooms }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Chambres</strong>
                                    <span class="text-muted">{{ $property->bedrooms }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Floor</strong>
                                    <span class="text-muted">{{ $property->floor ?? '—' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Ville</strong>
                                    <span class="text-muted">{{ $property->city }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Code postal</strong>
                                    <span class="text-muted">{{ $property->postal_code }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ url('/admin/properties/' . $property->id . '/toggle-sold') }}">
                            {{ $property->sold ? 'Mark as available' : 'Mark as sold' }}
                        </a>

                        <a class="btn btn-outline-primary btn-sm" href="{{ url('/properties/' . $property->id) }}" target="_blank">See on the website</a>

                        <small class="text-muted d-block mt-2">
                            Created on : {{ optional($property->created_at)->format('d/m/Y H:i') ?? '—' }}
                            @if($property->updated_at)
                                — Modified : {{ $property->updated_at->format('d/m/Y H:i') }}
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Styles légers pour la page détails (statique) */

        #propertyCard .object-cover {
            object-fit: cover;
        }

        #propertyCard .ratio {
            min-height: 200px;
        }

        /* Ajustements responsive */
        @media (max-width: 576px) {
            #propertyCard .ratio { min-height: 140px; }
            #propertyCard h4 { font-size: 1.05rem; }
        }

        #propertyCard .badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.6rem;
        }

        #propertyCard .badge.rounded-pill {
            border-radius: 999px;
        }

        #propertyCard .list-group-item strong {
            font-weight: 600;
        }

        /* Petite marge entre badges pour lisibilité */
        #propertyCard .badge + .badge {
            margin-left: .35rem;
        }
    </style>
@endsection
