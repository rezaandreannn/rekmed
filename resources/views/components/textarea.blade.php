<div class="form-floating">
    <textarea class="form-control  @error($field) is-invalid @enderror" name="{{ $field }}"
        placeholder="{{ $placeholder ?? '' }}" id="{{ $field }}" style="height: 100px">{{ old($field) }}</textarea>
    <label for="{{ $field }}">{{ $label ?? '' }}</label>
    @error($field)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
