<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Motorcycles')</title>
    
    <link rel="stylesheet" href="motorcycles.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    @stack('styles')
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            @include('components.sidebar')
        </div>

        <!-- Main Content -->
        <div class="main-content" style="margin-left: 250px; width: 100%;">
            @yield('content')
            <div class="container my-4">
                <h1 class="mt-4 text-center">Ride the Best with Our Motorcycles</h1>
                <p class="text-center mb-4">Browse Our Collection of High-Performance Motorcycles, Engineered for Speed and Adventure.</p>

                <!-- Search and Filter Section -->
                <div class="search-filter-container w-100 d-flex align-items-center gap-2 mb-4">
                    <div class="search-bar flex-grow-1">
                        <input 
                            type="text" 
                            id="search-input" 
                            class="form-control" 
                            placeholder="Search motorcycles...">
                    </div>
                    <button id="search-btn" class="btn btn-dark w-25">Enter</button>
                    <div class="w-25">
                        <select class="form-select" id="sort-select">
                            <option value="">Sort by</option>
                            <option value="az">A-Z</option>
                            <option value="za">Z-A</option>
                            <option value="low-high">Price: Low to High</option>
                            <option value="high-low">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="card-container">
                    @foreach($motorcycles as $motorcycle)
                        <div class="card" data-name="{{ $motorcycle->name }}" data-price="{{ $motorcycle->price }}">
                            <img src="{{ asset('frontend/images/motorcycles/'.$motorcycle['image']) }}" class="card-img-top" alt="{{ $motorcycle->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $motorcycle->name }}</h5>
                                <p class="card-text">{{ $motorcycle->description }}</p>
                                <p class="text-muted">Price: P{{ number_format($motorcycle->price, 2) }}</p>
                                <a href="{{ route('motorcycle.details', $motorcycle->id) }}" class="btn btn-dark w-100">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const cards = document.querySelectorAll('.card');
            const cardContainer = document.querySelector('.card-container');
            const sortSelect = document.getElementById('sort-select');

            // Filter products by search term
            function filterProducts() {
                const searchTerm = searchInput.value.toLowerCase();
                cards.forEach(card => {
                    const name = card.getAttribute('data-name').toLowerCase();
                    card.style.display = name.includes(searchTerm) ? 'block' : 'none';
                });
            }

            // Sort products
            function sortProducts() {
                const sortValue = sortSelect.value;
                const sortedCards = Array.from(cards).sort((a, b) => {
                    if (sortValue === 'az') {
                        return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                    } else if (sortValue === 'za') {
                        return b.getAttribute('data-name').localeCompare(a.getAttribute('data-name'));
                    } else if (sortValue === 'low-high') {
                        return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                    } else if (sortValue === 'high-low') {
                        return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                    }
                    return 0;
                });

                // Reorder cards in the container
                cardContainer.innerHTML = '';
                sortedCards.forEach(card => cardContainer.appendChild(card));
            }

            // Event listeners
            searchInput.addEventListener('input', filterProducts);  // Changed to 'input' event
            sortSelect.addEventListener('change', sortProducts);
        });
    </script>
</body>
</html>
