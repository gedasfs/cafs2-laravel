<form action="{{ $route }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $name ?? '') }}">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
    </div>
    <div class="mb-3">
        <label for="code" class="form-label">Code</label>
        <input name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code', $code ?? '') }}">

        @error('code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input name="price" type="numeric" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price', $price ?? '') }}">

        @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
    </div>
    <div class="mb-3">
        <label for="categoryId" class="form-label">Product category</label>
        <select class="form-select @error('category_id') is-invalid @enderror" aria-label="category_id" name="category_id" id="categoryId">
            <option value="0">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $categoryId ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>

        @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $description ?? '') }}</textarea>

        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
		@enderror
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
