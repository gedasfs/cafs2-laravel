<form method="GET">
    <div class="mb-3">
        <select class="form-select" aria-label="category_id" name="category_id">
            <option value="0" selected>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Filter by price</span>
        <input type="text" name="price_from" placeholder="from" aria-label="from" class="form-control">
        <input type="text" name="price_to" placeholder="to" aria-label="to" class="form-control">
    </div>

    <div class="mb-3">
        <span class="">Order By</span>
        <select class="form-select" name="order_by" aria-label="Default select example">
            @foreach ($orderBy as $value => $name)
                <option value="{{ $value }}">{{ $name }}</option>
            @endforeach
          </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-success" href="{{ route('home') }}">Clear</a>
</form>
