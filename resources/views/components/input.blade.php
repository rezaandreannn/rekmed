<div class="mb-3">
    <label for="{{ $field }}" class="form-label text-capitalize">
        {{ $label ?? '' }}<span class="text-danger">{{ $required ?? '' }}</span>
    </label>
    <input type="{{ $type ?? 'text' }}" class="form-control @error($field) is-invalid @enderror" id="{{ $field }}"
        name="{{ $field }}" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}">

    @error($field)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
