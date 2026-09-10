@props(['field', 'bag' => null])

@error($field, $bag)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
