// Carrossel de jogos em destaque da página inicial.
document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector(".jogos-destaque-carousel");
    if (!carousel) return;

    if (typeof Swiper === "undefined") {
        console.warn("Swiper não carregado — carrossel de jogos indisponível.");
        return;
    }

    const swiperElement = carousel.querySelector(".jogos-swiper");
    const nextButton = carousel.querySelector(".swiper-button-next");
    const prevButton = carousel.querySelector(".swiper-button-prev");
    const pagination = carousel.querySelector(".swiper-pagination");

    if (!swiperElement) return;

    new Swiper(swiperElement, {
        slidesPerView: 1,
        spaceBetween: 16,
        speed: 450,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        pagination: {
            el: pagination,
            clickable: true
        },
        navigation: {
            nextEl: nextButton,
            prevEl: prevButton
        },
        breakpoints: {
            576: { slidesPerView: 2, spaceBetween: 18 },
            900: { slidesPerView: 3, spaceBetween: 22 },
            1200: { slidesPerView: 3, spaceBetween: 24 }
        }
    });
});
