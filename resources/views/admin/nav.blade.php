@php

    $route=Route::currentRouteName();

@endphp


<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{route('admin.dashboard')}}" @class(['nav-link','active'=>str_contains($route,'dashboard')])>Home</a></li>
            <li class="nav-item"><a href="{{route('admin.property.index')}}" @class(['nav-link','active'=>str_contains($route,'property.')]) >Properties</a></li>
            <li class="nav-item"><a href="{{route('admin.option.index')}}" @class(['nav-link','active'=>str_contains($route,'option.')])>Options</a></li>

        </ul>
        <div class="col-md-3 text-end">
            @auth
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary me-2">Logout</button>
                </form>
            @endauth

        </div>
    </header>
</div>

