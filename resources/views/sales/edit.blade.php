@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-light">
                    <h4 class="card-title mb-0 text-center">Modify your product</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('sales.update', $sale->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <label for="product" class="form-label">Name</label>
                                <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product" value="{{ old('product', $sale->product) }}" required>
                                @error('product')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="1" min="0" value="{{ old('price', $sale->price) }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="isSold" class="form-label">Is Sold</label>
                                <select class="form-select @error('isSold') is-invalid @enderror" id="isSold" name="isSold" required>
                                    <option value="0"  {{ old('isSold', $sale->isSold) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('isSold', $sale->isSold) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                                @error('isSold')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="">Select one</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $sale->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label">Image</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                            @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $sale->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Modify ad
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection