// JavaScript untuk side images carousel - Fixed dengan null safety
document.addEventListener('DOMContentLoaded', function() {
    const dots = document.querySelectorAll(".dot");
    const mainCard = document.querySelector(".main-destination-card");
    const mainCardImage = document.querySelector(".main-card-image");
    const mainCardContent = document.querySelector(".main-card-content");
    const sideCards = document.querySelectorAll(".side-card");
    const navArrow = document.getElementById("nextBtn");
    const bannerContainer = document.querySelector(".banner-container");

    // Check if required elements exist
    if (!mainCard || !mainCardImage || !mainCardContent || !dots.length || !sideCards.length) {
        console.warn('Some required elements are missing from the DOM');
        return;
    }

    let currentSlide = 0;
    let isTransitioning = false;

    // Data destinasi Ternate - Updated dengan Jikomalamo dan diving spot
    const destinations = [{
            title: "Jikomalamo",
            location: "Pulau Ternate",
            description: "Pantai dengan spot diving terbaik di sekitar Ternate yang memukau",
            image: "/assets/jikomalamo.PNG",
            sideImages: [{
                    image: "/assets/tolire.jpg",
                    title: "Danau Tolire",
                    location: "Ternate"
                },
                {
                    image: "/assets/sulamadaha.jpg",
                    title: "Pantai Sulamadaha",
                    location: "Ternate"
                }
            ]
        },
        {
            title: "Danau Tolire",
            location: "Ternate",
            description: "Danau vulkanik yang eksotis dengan legenda mistis dan pemandangan yang memukau",
            image: "/assets/tolire.jpg",
            sideImages: [{
                    image: "/assets/sulamadaha.jpg",
                    title: "Pantai Sulamadaha",
                    location: "Ternate"
                },
                {
                    image: "/assets/jikomalamo.PNG",
                    title: "Diving Jikomalamo",
                    location: "Ternate"
                }
            ]
        },
        {
            title: "Pantai Sulamadaha",
            location: "Ternate",
            description: "Pantai dengan terumbu karang spektakuler dan kehidupan bawah laut yang menakjubkan",
            image: "/assets/sulamadaha.jpg",
            sideImages: [{
                    image: "/assets/jikomalamo.PNG",
                    title: "Diving Jikomalamo",
                    location: "Ternate"
                },
                {
                    image: "/assets/tolire.jpg",
                    title: "Danau Tolire",
                    location: "Ternate"
                }
            ]
        }
    ];

    function updateContent(index) {
        if (isTransitioning) return;
        isTransitioning = true;

        const destination = destinations[index];

        // Add switching classes untuk animasi
        if (mainCard) mainCard.classList.add('switching');
        if (mainCardImage) mainCardImage.classList.add('switching');
        if (mainCardContent) mainCardContent.classList.add('switching');

        // Add switching classes untuk side cards
        sideCards.forEach(card => {
            if (card) {
                card.classList.add('switching');
                const cardImage = card.querySelector('.side-card-image');
                if (cardImage) cardImage.classList.add('switching');
            }
        });

        setTimeout(() => {
            // Update main card content
            if (mainCardImage) mainCardImage.src = destination.image;
            
            const titleElement = mainCard.querySelector('.main-card-title');
            const locationElement = mainCard.querySelector('.main-card-location');
            const descriptionElement = mainCard.querySelector('.main-card-description');
            
            if (titleElement) titleElement.textContent = destination.title;
            if (locationElement) locationElement.textContent = destination.location;
            if (descriptionElement) descriptionElement.textContent = destination.description;

            // Update side cards
            sideCards.forEach((card, cardIndex) => {
                if (card && destination.sideImages[cardIndex]) {
                    const cardImage = card.querySelector('.side-card-image');
                    const cardTitle = card.querySelector('.side-card-title');
                    const cardLocation = card.querySelector('.side-card-location');

                    if (cardImage) cardImage.src = destination.sideImages[cardIndex].image;
                    if (cardTitle) cardTitle.textContent = destination.sideImages[cardIndex].title;
                    if (cardLocation) cardLocation.textContent = destination.sideImages[cardIndex].location;
                }
            });

            // Remove switching classes setelah update
            setTimeout(() => {
                if (mainCard) mainCard.classList.remove('switching');
                if (mainCardImage) mainCardImage.classList.remove('switching');
                if (mainCardContent) mainCardContent.classList.remove('switching');

                sideCards.forEach(card => {
                    if (card) {
                        card.classList.remove('switching');
                        const cardImage = card.querySelector('.side-card-image');
                        if (cardImage) cardImage.classList.remove('switching');
                    }
                });

                isTransitioning = false;
            }, 100);
        }, 300); // Delay untuk animasi fade out
    }

    // Dot navigation - with null check
    dots.forEach((dot, index) => {
        if (dot) {
            dot.addEventListener("click", () => {
                if (isTransitioning || index === currentSlide) return;

                dots.forEach((d) => {
                    if (d) d.classList.remove("active");
                });
                dot.classList.add("active");
                currentSlide = index;
                updateContent(currentSlide);
            });
        }
    });

    // Navigation arrow click - with null check
    if (navArrow) {
        navArrow.addEventListener("click", () => {
            if (isTransitioning) return;

            const nextIndex = (currentSlide + 1) % dots.length;
            dots.forEach((d) => {
                if (d) d.classList.remove("active");
            });
            if (dots[nextIndex]) dots[nextIndex].classList.add("active");
            currentSlide = nextIndex;
            updateContent(currentSlide);
        });
    }

    // Card hover effects (tidak berubah saat transition)
    if (mainCard) {
        mainCard.addEventListener("mouseenter", () => {
            if (!isTransitioning) {
                mainCard.style.transform = "translateX(-10px) scale(1.02)";
            }
        });

        mainCard.addEventListener("mouseleave", () => {
            if (!isTransitioning) {
                mainCard.style.transform = "translateX(0) scale(1)";
            }
        });
    }

    sideCards.forEach((card) => {
        if (card) {
            card.addEventListener("mouseenter", () => {
                if (!isTransitioning) {
                    card.style.transform = "translateX(-8px) scale(1.05)";
                }
            });

            card.addEventListener("mouseleave", () => {
                if (!isTransitioning) {
                    card.style.transform = "translateX(0) scale(1)";
                }
            });
        }
    });

    // CTA Button animation - with null check
    const ctaButton = document.querySelector(".cta-button");
    if (ctaButton) {
        ctaButton.addEventListener("click", (e) => {
            e.preventDefault();
            ctaButton.style.transform = "translateY(-3px) scale(0.95)";
            setTimeout(() => {
                ctaButton.style.transform = "translateY(-3px) scale(1)";
            }, 150);
        });
    }

    // Auto-play functionality - only if navArrow exists
    let autoPlayInterval;
    
    if (navArrow) {
        autoPlayInterval = setInterval(() => {
            if (!isTransitioning) {
                navArrow.click();
            }
        }, 6000);

        // Pause auto-play on hover - with null check
        if (bannerContainer) {
            bannerContainer.addEventListener("mouseenter", () => {
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                }
            });

            bannerContainer.addEventListener("mouseleave", () => {
                if (navArrow) {
                    autoPlayInterval = setInterval(() => {
                        if (!isTransitioning) {
                            navArrow.click();
                        }
                    }, 6000);
                }
            });
        }
    }

    // Initialize first slide
    updateContent(0);
});