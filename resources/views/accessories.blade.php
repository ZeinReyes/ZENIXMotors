<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Accessories')</title>
    
    <link rel="stylesheet" href="accessories.css">
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
                <h1 class="mt-4 text-center">Premium Motorcycle Accessories</h1>
                <p class="text-center mb-4">
                    Enhance Your Ride with Top-of-the-Line Gear and Parts for Every Rider
                </p>

                <!-- Search and Filter Section -->
                <div class="search-filter-container w-100 d-flex align-items-center gap-2 mb-4">
                    <div class="search-bar flex-grow-1">
                        <input 
                            type="text" 
                            id="search-input" 
                            class="form-control" 
                            placeholder="Search accessories...">
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
                <div id="card-container" class="card-container">
                @foreach ($accessories as $accessory)
                    <div class="card" data-name="{{ $accessory->name }}" data-price="{{ $accessory->price }}">
                        <img 
                            src="{{ asset('frontend/images/accessories/'.$accessory['image']) }}" 
                            class="card-img-top" 
                            alt="{{ $accessory->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $accessory->name }}</h5>
                            <p class="card-text">{{ $accessory->description }}</p>
                            <p class="text-muted">Price: P{{ number_format($accessory->price, 2) }}</p>
                            <!-- Add To Cart button -->
                            <form action="{{ route('addToCart', $accessory->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                            </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('search-input');
            const searchBtn = document.getElementById('search-btn');
            const sortSelect = document.getElementById('sort-select');
            const cardContainer = document.getElementById('card-container');
            const cards = Array.from(cardContainer.getElementsByClassName('card'));

            // Function to filter the cards
            function filterCards() {
                const searchQuery = searchInput.value.toLowerCase();
                const sortOption = sortSelect.value;

                // Filter cards based on search query
                const filteredCards = cards.filter(card => {
                    const name = card.getAttribute('data-name').toLowerCase();
                    return name.includes(searchQuery);
                });

                // Sort cards based on the selected option
                if (sortOption) {
                    filteredCards.sort((a, b) => {
                        const priceA = parseFloat(a.getAttribute('data-price'));
                        const priceB = parseFloat(b.getAttribute('data-price'));
                        const nameA = a.getAttribute('data-name').toLowerCase();
                        const nameB = b.getAttribute('data-name').toLowerCase();

                        if (sortOption === 'az') {
                            return nameA.localeCompare(nameB);
                        } else if (sortOption === 'za') {
                            return nameB.localeCompare(nameA);
                        } else if (sortOption === 'low-high') {
                            return priceA - priceB;
                        } else if (sortOption === 'high-low') {
                            return priceB - priceA;
                        }
                        return 0;
                    });
                }

                // Append filtered and sorted cards to the container
                cardContainer.innerHTML = '';
                filteredCards.forEach(card => cardContainer.appendChild(card));
            }

            // Event listeners for filtering
            searchInput.addEventListener('input', filterCards);
            searchBtn.addEventListener('click', filterCards);
            sortSelect.addEventListener('change', filterCards);
        });

        
    </script>
</body>
</html>
