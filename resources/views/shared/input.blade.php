@php
    /**
     * Usage:
     * @include('shared.input', [
     *   'type' => 'text'|'textarea'|'number'|'checkbox'|'file'|'select'|...,
     *   'class' => 'col-12', // wrapper class
     *   'name' => 'field_name',
     *   'label' => 'Mon label',
     *   'value' => old value or model value,
     *   'placeholder' => '...',
     *   'min' => 0, 'step' => '0.1', 'pattern' => '...',
     *   'accept' => 'image/*', 'multiple' => true (for file/select),
     *   'options' => [id => label] or ['Label1','Label2'] (for select),
     *   'rows' => 4,
     *   'help' => 'texte d aide'
     * ])
     *
     * Notes:
     * - For multiple selects the input name is rendered as name[] while old() lookups use the base name.
     * - For validation, use:
     *     'options'   => ['required','array'],
     *     'options.*' => ['exists:options,id']
     */
    $type = $type ?? 'text';
    $wrapperClass = $class ?? 'col-12';
    $name = $name ?? '';
    $label = $label ?? ucwords(str_replace('_', ' ', $name));
    $value = $value ?? '';
    $placeholder = $placeholder ?? '';
    $rows = $rows ?? 4;

    // numeric / pattern attrs
    $minAttr = isset($min) ? 'min="'.e($min).'"' : '';
    $stepAttr = isset($step) ? 'step="'.e($step).'"' : '';
    $patternAttr = isset($pattern) ? 'pattern="'.e($pattern).'"' : '';

    // file & select / multiple helpers
    $isMultiple = !empty($multiple);
    $acceptAttr = isset($accept) ? 'accept="'.e($accept).'"' : '';
    $multipleAttr = $isMultiple ? 'multiple' : '';
    // for file inputs we must append [] when multiple
    $nameForFile = ($type === 'file' && $isMultiple) ? $name . '[]' : $name;
    // for select inputs when multiple we must append []
    $nameForSelect = ($type === 'select' && $isMultiple) ? $name . '[]' : $name;

    // options for select
    $options = $options ?? [];
    // initial selected value(s)
    $initialSelected = $value;
@endphp

<div class="{{ $wrapperClass }}">
    {{-- Do not duplicate label for checkbox (label is rendered inside .form-check) --}}
    @if($type !== 'checkbox' && $type !== 'file')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    @if($type === 'textarea')
        <textarea
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
        >{{ old($name, $initialSelected) }}</textarea>

    @elseif($type === 'checkbox')
        <div class="form-check mt-2">
            <input
                class="form-check-input @error($name) is-invalid @enderror"
                type="checkbox"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value !== '' ? $value : 1 }}"
                @if( (is_bool(old($name)) && old($name)) || (!is_null(old($name)) && old($name) != '') || (!is_null($initialSelected) && $initialSelected) ) checked @endif
            >
            <label class="form-check-label" for="{{ $name }}">
                {{ $label }}
            </label>
        </div>

    @elseif($type === 'file')
        {{-- Hidden/visually-hidden label for accessibility --}}
        <label for="{{ $name }}" class="form-label visually-hidden" aria-hidden="true">{{ $label }}</label>
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

    @elseif($type === 'select')
        @php
            // selected via old() fallback
            $selected = old($name, $initialSelected);

            // normalize selected to array when multiple
            if($isMultiple) {
                if(is_null($selected)) {
                    $selectedArr = [];
                } elseif(is_array($selected)) {
                    $selectedArr = array_map('strval', $selected);
                } else {
                    $selectedArr = array_map('strval', (array)$selected);
                }
            } else {
                $selectedStr = is_null($selected) ? '' : (string)$selected;
            }

            // detect if $options is associative (id => label) or simple (0 => 'Label')
            $isAssoc = array_keys($options) !== range(0, count($options) - 1);
        @endphp

        <select
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $nameForSelect }}"
            {{ $multipleAttr }}
        >
            @if(!$isMultiple && !empty($placeholder))
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach($options as $optKey => $optLabel)
                @php
                    if($isAssoc) {
                        // keys are ids/values
                        $optValueNormalized = (string) $optKey;
                        $optLabelNormalized = $optLabel;
                    } else {
                        // simple array: use label as value
                        $optValueNormalized = (string) $optLabel;
                        $optLabelNormalized = $optLabel;
                    }

                    $isSelected = $isMultiple
                        ? in_array($optValueNormalized, $selectedArr, true)
                        : ($optValueNormalized === $selectedStr);
                @endphp

                <option value="{{ $optValueNormalized }}" @if($isSelected) selected @endif>
                    {{ $optLabelNormalized }}
                </option>
            @endforeach
        </select>

    @else
        {{-- default input (text, number, email, etc.) --}}
        <input
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $initialSelected) }}"
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
