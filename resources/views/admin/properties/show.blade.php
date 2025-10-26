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

                            <!-- Deletion via recommended form, here direct link if you want -->
                            <form action="{{ route('admin.property.destroy', $property) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cette propriété ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Left: image -->
                    <div class="col-lg-6">
                        <div class="ratio ratio-16x9 rounded overflow-hidden">
                            <img
                                src="{{ $property->image ? asset('storage/' . $property->image) : 'https://via.placeholder.com/900x500?text=Image+propriété' }}"
                                alt="Image propriété"
                                class="w-100 h-100 object-cover"
                            >
                        </div>

                        <div class="mt-3 d-flex gap-2 align-items-center">
                            @if($property->sold)
                                <span class="badge bg-secondary">Sold</span>
                            @else
                                <span class="badge bg-success">Available</span>
                            @endif

                            <small class="text-muted">Étage: {{ $property->floor ?? '—' }}</small>
                        </div>
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
                                        <strong>Étage</strong>
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
                                {{ $property->sold ? 'Marquer comme disponible' : 'Marquer comme vendu' }}
                            </a>

                            <a class="btn btn-outline-primary btn-sm" href="{{ url('/properties/' . $property->id) }}" target="_blank">Voir sur le site</a>

                            <small class="text-muted d-block mt-2">
                                Créé le : {{ optional($property->created_at)->format('d/m/Y H:i') ?? '—' }}
                                @if($property->updated_at)
                                    — Modifié : {{ $property->updated_at->format('d/m/Y H:i') }}
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
                font-size: 0.9rem;
                padding: 0.45rem 0.6rem;
                border-radius: 0.5rem;
            }

            #propertyCard .list-group-item strong {
                font-weight: 600;
            }
        </style>
@endsection

