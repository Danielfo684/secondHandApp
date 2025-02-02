@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex  gap-3 align-items-center mb-4">

        <a href="{{ route('sales.create') }}" class="btn btn-info">
            <i class="fas fa-plus"></i> New Product
        </a>
        <a href="{{ route('sales.index') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Search products
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row g-2">
        @foreach($sales as $sale)
        <div class="col-md-5 mx-auto">
            <div class="card h-100 shadow-sm">
                <div class="position-relative">
                    @if($sale->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $sale->images->first()->route) }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: cover;"
                        alt="{{ $sale->product }}">
                    @else
                    <img src="{{ asset('images/basica.png') }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: cover;">
                    @endif



                    @if($sale->isSold)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <span class="badge bg-danger fs-1 p-10" style="transform: rotate(-45deg);">SOLD</span>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $sale->product }}</h5>
                    <p class="card-text text-truncate">{{ $sale->description }}</p>
                    <h6 class="text-info">Price: {{ number_format($sale->price, 0, ',', '.') }}€</h6>
                    <span class=""> Category: {{ $sale->category->name }}</span> <br>
                    <span class=""> Seller: {{ $sale->user->name }}</span>

                </div>
                <div class="m-3">
                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100"
                            onclick="return confirm('¿Are you sure you want to delete this product?')">
                            <i class="fas fa-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection