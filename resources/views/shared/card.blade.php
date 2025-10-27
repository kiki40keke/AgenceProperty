@php

    $route=Route::currentRouteName();

@endphp

<div class="container py-5">
    <div class="row g-4">

        @forelse($properties as $property)
        <!-- Carte 1 -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
                @if($property->pictures->isNotEmpty())
                    <img src="{{ $property->pictures->first()->getPicturesUrl() }}"    class="card-img-top" alt="Maison à Paris">
                @else
                    <img src="https://placehold.co/400x250" class="card-img-top" alt="Maison à Paris">

                @endif
                <div class="card-body">
                    <h5 class="card-title text-primary fw-bold">{{$property->title}}</h5>
                    <p class="card-text mb-1">
                        <i class="bi bi-geo-alt-fill text-danger"></i> <strong>Ville :</strong>  {{$property->city}}
                    </p>
                    <p class="card-text mb-1">
                        <i class="bi bi-aspect-ratio text-success"></i> <strong>Surface :</strong> {{$property->surface}} m<sup>2</sup>
                    </p>
                    <p class="card-text mb-3">
                        <i class="bi bi-cash-stack text-warning"></i> <strong>Prix :</strong> {{ number_format($property->price) }} €
                    </p>
                    <p class="card-text mb-3">
                        @if($property->options->isNotEmpty())
                            <i class="bi bi-cash-stack text-warning"></i> <strong>Biens :</strong>

                            {{-- option: vous pouvez afficher en badges pill --}}
                            @foreach($property->options as $opt)
                                <span class="badge bg-primary text-white rounded-pill">{{ $opt->name }}</span>
                            @endforeach

                        @endif
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{route('properties.show',['slug'=>$property->getSlug(),'property'=>$property])}}" class="btn btn-outline-primary btn-sm">Voir détails</a>
                        <small class="text-muted">
                          {{  $property['created_at']->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        @empty
            <p class="text-center">Aucune propriété trouvée.</p>
        @endforelse

    </div>
</div>


