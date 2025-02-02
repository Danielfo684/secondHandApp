<div class="modal fade" id="showModal-{{ $sale->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $sale->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel-{{ $sale->id }}">{{ $sale->product }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($sale->images->isNotEmpty())
                <img src="{{ asset('storage/' . $sale->images->first()->route) }}" class="img-fluid mb-3" alt="{{ $sale->product }}">
                @else
                <img src="{{ asset('images/basica.png') }}" class="img-fluid mb-3" alt="Default Image">
                @endif
                <p><strong>Description:</strong> {{ $sale->description }}</p>
                <p><strong>Published:</strong> {{ $sale->created_at->format('d/m/Y') }}</p>
                <p><strong>Price:</strong> {{ number_format($sale->price, 0, ',', '.') }}€</p>
                <p><strong>Category:</strong> {{ $sale->category->name }}</p>
                <p><strong>Seller:</strong> {{ $sale->user->name }}</p>

            </div>
            <div class="modal-footer">
                <form action="{{ route('sales.shop', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-info w-100"
                        onclick="return confirm('¿Are you sure you want to buy this product?')">
                        <i class="fas fa-trash"></i> Buy Product
                        
                    </button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>