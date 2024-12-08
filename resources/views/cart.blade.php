<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cart')</title>
    <link rel="stylesheet" href="cart.css">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Shopping Cart Section -->
            <div class="col-md-8">
                <a href="{{ route('accessories') }}" class="text-muted">&larr; Continue Shopping</a>
                <h2 class="my-4">Shopping Cart</h2>
                <div class="border-top"></div>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                            <div class="d-flex">
                                <img src="{{ asset('frontend/images/accessories/'.$details['image']) }}" alt="{{ $details['name'] }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $details['name'] }}</h5>
                                    <p class="text-muted mb-1">Price: P{{ number_format($details['price'], 2) }}</p>
                                    <div class="input-group mb-0" style="max-width: 150px;">
                                        <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity('{{ $id }}', 'decrease')">−</button>
                                        <input type="text" class="form-control form-control-sm text-center" id="quantity-{{ $id }}" value="{{ $details['quantity'] }}" readonly>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="updateQuantity('{{ $id }}', 'increase')">+</button>
                                    </div>
                                </div>
                            </div>
                            <p class="fw-bold" id="total-{{ $id }}" data-price="{{ $details['price'] }}">P{{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-center mt-4">Your cart is empty!</p>
                @endif
            </div>

            <!-- Order Summary Section -->
            <div class="col-md-4">
                <div class="bg-dark p-4 rounded">
                <h3 class="my-2 text-light">Order Summary</h3>
                    <p class="text-light">Items: <span class="fw-bold" id="item-count">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span></p>
                    <p class="text-light">Amount: <span id="total-price" class="fw-bold text-light">P{{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart', []))), 2) }}</span></p> 
                    <h3 class="text-light">Billing Information</h3>
                    <form action="{{ route('checkout') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="mb-3 text-light">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3 text-light">
                            <label for="address" class="form-label">Delivery Address</label>
                            <input type="text" id="address" name="address" class="form-control" required>
                        </div>
                        <div class="mb-3 text-light">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select id="payment_method" name="payment_method" class="form-control" required>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="credit_card">Credit Card</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function updateQuantity(id, action) {
        const quantityInput = document.getElementById(`quantity-${id}`);
        const totalElement = document.getElementById(`total-${id}`);
        const totalPriceElement = document.getElementById('total-price');
        const itemCountElement = document.getElementById('item-count');

        let quantity = parseInt(quantityInput.value);
        const price = parseFloat(totalElement.dataset.price);

        if (action === 'increase') quantity++;
        if (action === 'decrease' && quantity > 1) quantity--;

        // Optimistically update the UI
        quantityInput.value = quantity;
        totalElement.textContent = `P${(quantity * price).toFixed(2)}`;

        fetch('{{ route("updateCart") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id, quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update total price and item count
                const newTotalPrice = data.totalPrice;
                const newItemCount = data.totalQuantity;

                totalPriceElement.textContent = `P${newTotalPrice.toFixed(2)}`;
                itemCountElement.textContent = newItemCount;
            } else {
                alert('Failed to update cart. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
    </script>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
</body>
</html>
