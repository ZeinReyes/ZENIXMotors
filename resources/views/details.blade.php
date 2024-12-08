<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Motorcycle Details')</title>

    <link rel="stylesheet" href="details.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex">
        <!-- Main Content -->
        <div class="main-content" style="margin-left: 250px; width: 100%; height: 100vh; overflow: hidden;">
            @yield('content')
            <a class="text-decoration-none text-light btn btn-dark my-5 w-25 mx-3" href="{{ route('motorcycles') }}">Back</a>

            <div class="details-container my-5">
                <div class="row">
                    <!-- Motorcycle Image -->
                    <div class="col-md-6 mx-3">
                        <img src="{{ asset('frontend/images/motorcycles/'.$motorcycle['image']) }}" class="img-fluid rounded" alt="Motorcycle Image">
                    </div>

                    <!-- Motorcycle Details -->
                    <div class="col-md-5">
                        <h2>{{ $motorcycle->name }}</h2>
                        <p>{{ $motorcycle->description }}</p>
                        <div>
                            <h3>Specifications</h3>
                            <ul>
                                <li>Engine Type: {{ $motorcycle->engine_type}}</li>
                                <li>Displacement: {{ $motorcycle->displacement}}</li>
                                <li>Top Speed: {{ $motorcycle->top_speed}} </li>
                                <li>Fuel Tank Capacity: {{ $motorcycle->fuel_capacity}}</li>
                            </ul>
                        </div>
                        <p class="fs-4 fw-bold text-danger">Price: {{ $motorcycle->price}}</p>
                        <div class="mt-1">
                            <button class="btn btn-dark btn-lg w-100" data-bs-toggle="modal" data-bs-target="#reserveModal">Reserve Now</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Reserve Now Modal -->
    <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveModalLabel">Reserve Your Motorcycle!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.reserve.motorcycle') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full-name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="full-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" id="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label">Payment Method</label>
                            <select class="form-select" name="payment_method" id="payment-method" required>
                                <option value="cash">Cash</option>
                                <option value="credit-card">Credit Card</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reservation-date" class="form-label">Preferred Reservation Date</label>
                            <input type="date" name="reservation_date" class="form-control" id="reservation-date" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Submit Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
