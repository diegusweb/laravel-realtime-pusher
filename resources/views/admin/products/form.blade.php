<div class="form-group">
    <label>Nombre (*)</label>
    <input
        name="name"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        value="{{ old('name') }}"
    />
</div>
<div class="form-group">
    <label>Descripción (*)</label>
    <textarea
        rows="3"
        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
        name="description">{{ old('description') }}</textarea>
</div>

<div class="form-group">
    <label>Precio (*)</label>
    <input
        type="number"
        class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
        name="price"
        value="{{ old('price') }}"
    />
</div>

<div class="form-group">
    <div class="custom-file">
        <input
            type="file"
            class="custom-file-input{{ $errors->has('image') ? ' is-invalid' : '' }}"
            name="image"
        />
        <label class="custom-file-label">
            Selecciona un archivo de imagen
        </label>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ $btnText }}</button>
