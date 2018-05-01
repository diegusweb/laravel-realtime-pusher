<div class="form-group">
    <label>Producto (*)</label>
    <select
        name="product_id"
        class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}"
    >
        @foreach(\App\Product::doesnthave('promotion')->orderBy('id')->pluck('name', 'id') as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    </select>
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
    <label>Finaliza en (*)</label>
    <input
        type="date"
        class="form-control{{ $errors->has('ends_at') ? ' is-invalid' : '' }}"
        name="ends_at"
        value="{{ old('ends_at') }}"
    />
</div>


<button type="submit" class="btn btn-primary">{{ $btnText }}</button>
