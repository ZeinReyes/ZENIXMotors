<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    
    <link rel="stylesheet" href="home.css">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <section class="section">
            <div class="hero">
                <div class="hero-content w-100 h-100 d-flex justify-content-between align-items-center">
                    <div class="hero-description d-flex justify-content-center flex-column">
                        <h1 class="text-light">Unleash the <span>Power</span> Within</h1>
                        <p class="text-light">Discover the ultimate riding experience with our collection of superbikes. Built for speed, crafted for perfection.</p>
                        <div class="hero-buttons">
                            <button class="text-light"><a class="text-light" href="{{ route('motorcycles') }}">Browse Motorcycles</a></button>
                            <button class="text-light"><a class="text-light" href="{{ route('accessories') }}">Browse Accessories</a></button>
                        </div>
                    </div>
                    <div class="socials d-flex flex-column">
                    <svg class="my-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg>
                    <svg class="my-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    <svg class="my-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                    <svg class="my-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>
                    </div>
                </div>
            </div>
            </section>
            <section class="section">
            <div class="about d-flex justify-content-center align-items-center">
                <div class="about-images w-50 h-100 d-flex justify-content-center align-items-center flex-column">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462546688_938725491016579_8937866633082009164_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeF7ekJLNb82i9dbk-42RwZ98RqgX2-SD5nxGqBfb5IPmbkWVGTNGf1uGPXRNy_2fgms9jO-fjP1EZ3U3S9cWWf3&_nc_ohc=w9D4ioOzV9cQ7kNvgHLtG4-&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QGN_jgJFlQkVgjLTjsua1aUOswZKFcUN61XiRTVCrG_dA&oe=6779DE42" alt="" style="width: 50%;">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462557784_929548035439624_8953252774314313507_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeH821s7VFLINPM3bM_ZNRUOQKn_jH0lyMtAqf-MfSXIy_gkf1gzYzRCcAcSA2uwgWQixN5CzvMM5DPiHf34Jc_8&_nc_ohc=IxJKwCG7xCcQ7kNvgHwlcEy&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QHuev1BqarIuhQULsV_9mnNnvLc4pVxSHz8F8eEikx5rQ&oe=6779CA8B" alt="" style="width: 50%;">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462580048_3976999965952958_4341764862517621341_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeEGTHt-IwSHzTzbB25OIHf1CvNxg_0hSpsK83GD_SFKm_3Vy9enBFOXaV9Keo-PAA50GqA3QYk6KJtZCvVW7GKr&_nc_ohc=cAXYlBJbGCIQ7kNvgGBjDxh&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QE1VYGdElelFljrVQF06ojf5vXMd6nYA-5Kq7dALa8CPA&oe=6779E603" alt="" style="width: 50%;">
                </div>
                <div class="about-description w-50 h-100 d-flex justify-content-center align-items-center flex-column">
                    <h1 class="text-center text-light">About Us</h1>
                    <div class="divider my-4"></div>
                    <p class="px-4 text-center text-light mb-5">At ZENIX-Motors, we’re dedicated to delivering the ultimate riding experience. Specializing in high-performance motorcycles, we offer top brands like Kawasaki, Yamaha, Ducati, Honda, and Suzuki. Whether you crave speed or the perfect blend of power and style, our collection has something for every enthusiast. We’re here to fuel your passion for the open road with expert knowledge and personalized service.</p>
                    <div class="members w-100">
                        <div class="members-top mb-3 d-flex justify-content-evenly align-items-center w-100 h-50">
                            <div class="member1 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="text-light">Zein Reyes</h5>
                                <div class="divider"></div>
                                <h6 class="text-light">Frontend Developer</h6>
                            </div>
                            <div class="member2 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="text-light">Jessa Sanchez</h5>
                                <div class="divider"></div>
                                <h6 class="text-light">Database Architect</h6>
                            </div>
                            <div class="member3 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="text-light">Neil Reyes</h5>
                                <div class="divider"></div>
                                <h6 class="text-light">Backend Developer</h6>
                            </div>
                        </div>
                        <div class="members-bottom d-flex justify-content-evenly align-items-center w-100 h-50">
                            <div class="member4 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="text-light">Iara Reateran</h5>
                                <div class="divider"></div>
                                <h6 class="text-light">Data Management Specialist</h6>
                            </div>
                            <div class="member5 d-flex justify-content-center align-items-center flex-column">
                                <h5 class="text-light">John Tolentino</h5>
                                <div class="divider"></div>
                                <h6 class="text-light">Web Designer</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <section class="section">
            <div class="featured">
                <div class="featured-image d-flex justify-content-between flex-column">
                    <h1 class="text-center">Featured</h1>
                    <img id="bike-image" src="assets/yzf-r1.png" alt="">
                    <h2 class="text-center" id="model">Yamaha ZX10RR</h2>
                </div>
                <div class="arrows">
                    <button class="text-light" id="prev-slide"><</button>
                    <button class="text-light" id="next-slide">></button>
                </div>
                <div class="featured-specs d-flex justify-content-evenly align-items-center">
                <div class="top-speed py-2 px-3 d-flex flex-column justify-content-around align-items-center text-center">
                        <h5>Top Speed</h5>
                        <p id="bike-top-speed">169 MPH<br> (272 KM/H)</p>
                    </div>
                    <div class="power py-2 px-3 d-flex flex-column justify-content-around align-items-center text-center">
                        <h5>Power</h5>
                        <p id="bike-power">162 HP<br> @ 9,250 RPM</p>
                    </div>
                    <div class="torque py-2 px-3 d-flex flex-column justify-content-around align-items-center text-center ">
                        <h5>Torque</h5>
                        <p id="bike-torque">130.5 N·m<br> @ 8,000 RPM</p>
                    </div>
                    <div class="fuel-capacity py-2 px-3 d-flex flex-column justify-content-around align-items-center text-center">
                        <h5>Fuel Capacity</h5>
                        <p id="bike-fuel-capacity">17 L <br>(4.5 US Gal)</p>
                    </div>
                </div>
            </div>
            </section>
            <section class="section">
            <div class="contact py-5">
                <div class="contact-header">
                <h1 class="text-center text-light">Get in Touch with Us</h1>
                <h5 class="text-center text-light">Reach out to us, and we'll get back to you as soon as possible!</h5>
                </div>
                <div class="divider mx-auto mt-5"></div>
                <div class="form-container my-5">
                    <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-light">Name</label>
                            <input type="text" id="name" name="name" required placeholder="e.g. John Doe">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-light">Email</label>
                            <input type="email" id="email" name="email" required placeholder="e.g. johndoe@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="message" class="text-light">Message</label>
                            <textarea id="message" name="message" required placeholder="Enter message here"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            </section>
        </div>
    </div>

    <script src="featured.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let currentSection = 0;
        const sections = document.querySelectorAll('.section');

        function updateActiveElements() {
            navLinks.forEach((link, index) => {
                link.classList.toggle('active', index === currentSection);
            });
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSection);
            });
        }

        function scrollToSection(index) {
            currentSection = index;
            sections[currentSection].scrollIntoView({ behavior: 'smooth', block: 'start' });
            updateActiveElements();
        }

        window.addEventListener('wheel', (event) => {
            if (event.deltaY > 0 && currentSection < sections.length - 1) {
                scrollToSection(currentSection + 1);
            } else if (event.deltaY < 0 && currentSection > 0) {
                scrollToSection(currentSection - 1);
            }
        });

        updateActiveElements();
    </script>
</body>
</html>
