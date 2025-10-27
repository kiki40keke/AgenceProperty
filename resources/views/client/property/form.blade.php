<form class="row g-2 mb-4" method="GET" action="{{ route('properties.index') }}">

    <div class="row g-3">
        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'min_price', 'value' => $inputs['min_price'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'price min'])
        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'max_price', 'value' => $inputs['max_price'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'price max'])

        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'min_surface', 'value' => $inputs['min_surface'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'surface min'])

        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'max_surface', 'value' => $inputs['max_surface'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'surface max'])

        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'rooms', 'value' => $inputs['rooms'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'rooms'])

        @include('shared.input', ['type' => 'number', 'class' => 'col-md-3', 'label' => '', 'name' => 'bedrooms', 'value' => $inputs['bedrooms'] ?? '', 'min' => 0, 'step' => '0.01', 'placeholder' => 'bedrooms'])

        @include('shared.input', [
                  'type' => 'select',
                  'class' => 'col-md-6',
                  'label' => '',
                  'name' => 'options',
                  'options' => $options,
                  'multiple' => true,
                  'value' => $inputs['options'] ?? []
                ])



        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </div>
</form>
