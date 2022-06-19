<div class="mb-3">
    <label for="{{ $field }}" class="form-label text-capitalize"> {{ $field }}</label>
    <select class="form-select @error($field) is-invalid @enderror" name="{{ $field }}"
        aria-label="Default select example">
        {{-- <option selected>Pilih</option> --}}
        {{ $slot }}
    </select>
    @error($field)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
