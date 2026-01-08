<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Harga (Rp)</label>
    <input
        type="number"
        name="price"
        class="form-control @error('price') is-invalid @enderror"
        value="{{ old('price', 1000) }}"
        min="1000"
        step="100"
        required
    >
    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="col-md-4 mb-3">
    <label class="form-label fw-semibold">Harga Diskon (Opsional)</label>
    <input
        type="number"
        name="discount_price"
        class="form-control @error('discount_price') is-invalid @enderror"
        value="{{ old('discount_price') }}"
        min="0"
        step="100"
    >
    @error('discount_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
