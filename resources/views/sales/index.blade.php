@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex gap-3 align-items-center mb-4">
        <a href="{{ route('sales.create') }}" class="btn btn-info">
            <i class="fas fa-plus"></i> New Product
        </a>
        <a href="{{ route('sales.user', ['user' => Auth::id()]) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> My Products
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
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
                    <p class="card-text text-truncate">{{ Str::limit($sale->description, 50) }}</p>
                    <h6 class="text-info">Price: {{ number_format($sale->price, 0, ',', '.') }}€</h6>
                    <span class=""> Category: {{ $sale->category->name }}</span> <br>
                    <span class=""> Seller: {{ $sale->user->name }}</span>

                </div>
                <div class="m-3 d-flex gap-3">

                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showModal-{{ $sale->id }}">
                        <i class="fas fa-info-circle"></i> More Details
                    </button>

                    @if(Auth::id() != $sale->user_id && !$sale->isSold)
                <form action="{{ route('sales.shop', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger w-100"
                        onclick="return confirm('¿Are you sure you want to buy this product?')">
                        <i class="fas fa-trash"></i> Buy Product
                    </button>
                </form>
                @endif
                </div>
                
            </div>
        </div>
        @include('sales.show-modal', ['sale' => $sale])
        @endforeach
    </div>


    @auth
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Confirmar Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas comprar "{{ $sale->product }}" por €{{ number_format($sale->price, 0, ',', '.') }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('sales.purchase', $sale->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Confirmar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth



</div>
@endsection