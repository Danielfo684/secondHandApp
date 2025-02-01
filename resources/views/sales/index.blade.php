@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Productos</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-info">
            <i class="fas fa-plus"></i> New Product
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
                    <img src="{{ asset('images/default-thumbnail.jpg') }}"
                        class="card-img-top"
                        style="height: 400px; object-fit: cover;">
                    @endif



                    @if($sale->isSold)
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <span class="badge bg-danger fs-2 p-3" style="transform: rotate(-45deg);">SOLD</span>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $sale->product }}</h5>
                    <p class="card-text text-truncate">{{ $sale->description }}</p>
                    <h6 class="text-info">Price: {{ number_format($sale->price, 0, ',', '.') }}€</h6>
                    <span class=""> Category: {{ $sale->category->name }}</span>
                </div>
                <div class="m-3">
                    <a href="{{ route('sales.show', $sale->id) }}"
                        class="btn btn-info">
                        More Info
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection