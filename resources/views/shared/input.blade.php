@php
    // Defaults
    $type = $type ?? 'text';
    $wrapperClass = $class ?? 'col-12';
    $name = $name ?? '';
    $label = $label ?? ucwords(str_replace('_', ' ', $name));
    $value = $value ?? '';
    $placeholder = $placeholder ?? '';
    $rows = $rows ?? 4;

    // Numeric / pattern helpers
    $minAttr = isset($min) ? 'min="'.e($min).'"' : '';
    $stepAttr = isset($step) ? 'step="'.e($step).'"' : '';
    $patternAttr = isset($pattern) ? 'pattern="'.e($pattern).'"' : '';

    // File / multiple helpers
    $isMultiple = !empty($multiple);
    $acceptAttr = isset($accept) ? 'accept="'.e($accept).'"' : '';
    $multipleAttr = $isMultiple ? 'multiple' : '';
    $nameForFile = $isMultiple ? $name . '[]' : $name;
@endphp

<div class="{{ $wrapperClass }}">
    {{-- Pour les checkbox on affiche le label à l'intérieur de la structure form-check --}}
    @if($type !== 'checkbox')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    @if($type === 'textarea')
        <textarea
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
        >{{ old($name, $value) }}</textarea>

    @elseif($type === 'checkbox')
        <div class="form-check form-switch mt-2">
            <input
                class="form-check-input  @error($name) is-invalid @enderror"
                type="checkbox" role="switch"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value ?: 1 }}"
                @if(old($name, $value)) checked @endif
            >
            <label class="form-check-label" for="{{ $name }}">
                {{ $label }}
            </label>
        </div>

    @elseif($type === 'file')
        <label for="{{ $name }}" class="form-label sr-only" aria-hidden="true"></label>
        <input
            class="form-control @error($name) is-invalid @enderror"
            type="file"
            id="{{ $name }}"
            name="{{ $nameForFile }}"
            {{ $acceptAttr }} {{ $multipleAttr }}
        >
        @if(!empty($help))
            <div class="form-text">{{ $help }}</div>
        @endif

    @else
        <input
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {!! $minAttr !!} {!! $stepAttr !!} {!! $patternAttr !!}
        >
    @endif

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
