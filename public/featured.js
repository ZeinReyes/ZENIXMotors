const bikes = [
    {
        image: "assets/yzf-r1.png",
        model: "Yamaha ZX10RR",
        topSpeed: "169 MPH </br>(272 KM/H)",
        power: "162 HP </br>@ 9,250 RPM",
        torque: "130.5 N·m </br>@ 8,000 RPM",
        fuelCapacity: "17 L </br>(4.50 US Gal)",
    },
    {
        image: "assets/panigale.png",
        model: "Ducati Panigale V4",
        topSpeed: "186 MPH </br>(299 KM/H)",
        power: "214 HP </br>@13,000 RPM",
        torque: "124 Nm </br>@11,500 RPM",
        fuelCapacity: "16 L </br>(4.20 US Gal)",
    },
    {
        image: "assets/CBR1000RR-R.png",
        model: "Honda CBR1000RR-R",
        topSpeed: "186 MPH </br>(299 KM/H)",
        power: "214 HP </br>@13,000 RPM",
        torque: "113.5 Nm </br>@11,000 RPM",
        fuelCapacity: "16.1 L </br>(4.25 US Gal)",
    },
    {
        image: "assets/GSX-R1000.png",
        model: "Suzuki GSX-R1000",
        topSpeed: "186 MPH </br>(299 KM/H)",
        power: "199 HP </br>@13,200 RPM",
        torque: "117.6 Nm </br>@10,800 RPM",
        fuelCapacity: "16.1 L </br>(4.25 US Gal)",
    },
    {
        image: "assets/zx10rr.png",
        model: "Kawasaki ZX-10R",
        topSpeed: "186 MPH</br>(299 KM/H)",
        power: "200 HP </br> @13,000 RPM",
        torque: "114 Nm </br> @11,500 RPM",
        fuelCapacity: "17 L </br> (4.50 US Gal)",
    }
];

let currentSlide = 0;
const totalSlides = bikes.length;

let slideInterval = setInterval(changeSlide, 10000);

function updateSlide() {
    const bike = bikes[currentSlide];

    // Update the slide content
    document.getElementById("bike-image").src = bike.image;
    document.getElementById("bike-top-speed").innerHTML = bike.topSpeed;
    document.getElementById("bike-power").innerHTML = bike.power;
    document.getElementById("bike-torque").innerHTML = bike.torque;
    document.getElementById("bike-fuel-capacity").innerHTML = bike.fuelCapacity;
    document.getElementById("model").innerHTML = bike.model;

    setTimeout(() => {
        document.getElementById('bike-image').classList.add('animate__slideInLeft');
        document.getElementById('model').classList.add('animate__fadeIn', 'animate__delay-1s');
        document.querySelector('.specs .top-speed').classList.add('animate__slideInRight', 'animate__delay-1s');
        document.querySelector('.specs .power').classList.add('animate__slideInRight', 'animate__delay-2s');
        document.querySelector('.specs .torque').classList.add('animate__slideInRight', 'animate__delay-3s');
        document.querySelector('.specs .fuel-capacity').classList.add('animate__slideInRight', 'animate__delay-4s');
    }, 30); // 30ms delay
}

function changeSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSlide();
}

function resetSlideInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(changeSlide, 10000); 
}

document.getElementById("next-slide").addEventListener("click", function() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSlide();
    resetSlideInterval();
});

document.getElementById("prev-slide").addEventListener("click", function() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateSlide();
    resetSlideInterval();
});
