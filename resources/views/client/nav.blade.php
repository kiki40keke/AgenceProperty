@php

    $route=Route::currentRouteName();

@endphp


<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">Simple header</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{route('home')}}" @class(['nav-link','active'=>str_contains($route,'home')])>Home</a></li>
            <li class="nav-item"><a href="{{route('properties.index')}}" @class(['nav-link','active'=>str_contains($route,'properties.')])>Properties</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
    </header>
</div>


