$(function () {
  console.log("Custom JS ready motion!!!");
});

document.addEventListener("DOMContentLoaded", () => {
  // Navbar fixed
  var navbar = document.querySelector(".navbar-fixed-top");
  if (navbar) {
    var sticky = navbar.offsetTop;

    window.addEventListener("scroll", function () {
      if (window.pageYOffset > sticky) {
        navbar.classList.add("is-scrolling");
      } else {
        navbar.classList.remove("is-scrolling");
      }
    });
  }
});

/* Swipper services */
const swiperContainerServices = document.querySelector(".swiper-services");

if (swiperContainerServices) {
  const swiperServices = new Swiper(".swiper-services", {
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 16,

    navigation: {
      nextEl: ".swiper-button-next-services",
      prevEl: ".swiper-button-prev-services",
    },
  });
}

/* Swipper services in services page template*/
const swiperContainerServicesPage = document.querySelector(
  ".swiper-services-page"
);

if (swiperContainerServicesPage) {
  const swiperServicesPage = new Swiper(".swiper-services-page", {
    loop: false,
    slidesPerView: 5,
    spaceBetween: 16,

    breakpoints: {
      768: {
        slidesPerView: 5,
      },
      0: {
        slidesPerView: "auto",
      },
    },

    navigation: {
      nextEl: ".swiper-button-next-services-page",
      prevEl: ".swiper-button-prev-services-page",
    },
  });
}

// swiper-talentos
const swiperContainer = document.querySelector(".swiper-talentos");

if (swiperContainer) {
  const slidesCount = swiperContainer.querySelectorAll(".swiper-slide").length;
  const navigationButtons = document.querySelectorAll(
    ".swiper-button-next-talentos, .swiper-button-prev-talentos"
  );

  const swiperTalentos = new Swiper(".swiper-talentos", {
    loop: true,
    slidesPerView: 4,
    spaceBetween: 16,

    breakpoints: {
      768: {
        slidesPerView: 4,
      },
      0: {
        slidesPerView: "auto",
      },
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-talentos",
      prevEl: ".swiper-button-prev-talentos",
    },
  });

  // Ocultar botones de navegación si hay 4 slides o menos
  if (slidesCount <= 4) {
    navigationButtons.forEach((button) => (button.style.display = "none"));
  }
}

/* Swipper services */
const swiperContainerAboutus = document.querySelector(".swiper-aboutus");

if (swiperContainerAboutus) {
  const swiperAboutus = new Swiper(".swiper-aboutus", {
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 28,
    centeredSlides: true,
    centerInsufficientSlides: true,

    breakpoints: {
      768: {
        spaceBetween: 28,
      },
      0: {
        spaceBetween: 16,
      },
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-aboutus",
      prevEl: ".swiper-button-prev-aboutus",
    },
  });
}

/* Swipper eligieron */
const swiperContainerEligieron = document.querySelector(".swiper-eligieron");

if (swiperContainerEligieron) {
  const swiper = new Swiper(".swiper-eligieron", {
    slidesPerView: "auto",
    centeredSlides: true,
    /* centerInsufficientSlides: true,
  spaceBetween: 0, */
    loop: true,
    effect: "coverflow",
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 260,
      modifier: 2,
      slideShadows: false,
    },
    navigation: {
      nextEl: ".swiper-button-next-eligieron",
      prevEl: ".swiper-button-prev-eligieron",
    },
  });
}

// swiper-cards-page
const swiperContainerCardsPage = document.querySelector(".swiper-cards-page");

if (swiperContainerCardsPage) {
  const slidesCount =
    swiperContainerCardsPage.querySelectorAll(".swiper-slide").length;
  const navigationButtons = document.querySelectorAll(
    ".swiper-button-next-cards-page, .swiper-button-prev-cards-page"
  );

  const swiperCardsPage = new Swiper(".swiper-cards-page", {
    loop: true,
    slidesPerView: 4,
    spaceBetween: 16,

    breakpoints: {
      768: {
        slidesPerView: 4,
      },
      0: {
        slidesPerView: "auto",
      },
    },

    // Navigation arrows
    navigation: {
      nextEl: ".swiper-button-next-cards-page",
      prevEl: ".swiper-button-prev-cards-page",
    },
  });

  // Ocultar botones de navegación si hay 4 slides o menos
  if (slidesCount <= 4) {
    navigationButtons.forEach((button) => (button.style.display = "none"));
  }
}

// Elementos que se verán afectados por el cambio del menú
const elementsToToggle = ["#navbarPrimary"];

// Configuración del observer
const observerConfig = {
  attributes: true, // Observar cambios en atributos
  attributeFilter: ["class"], // Solo observar cambios en el atributo class
};

// Función para manejar los cambios
const handleClassChange = (element) => {
  const hasShowClass = element.classList.contains("show");

  // Aplicar o remover la clase en todos los elementos objetivo
  elementsToToggle.forEach((elementId) => {
    const targetElement = document.querySelector(elementId);
    if (targetElement) {
      if (hasShowClass) {
        targetElement.classList.add("is-show-menu");
      } else {
        targetElement.classList.remove("is-show-menu");
      }
    }
  });
};

// Crear el observer
const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      handleClassChange(mutation.target);
    }
  });
});

// Inicializar el observer
document.addEventListener("DOMContentLoaded", () => {
  const navbarMenu = document.querySelector("#navbarMenu1");
  if (navbarMenu) {
    observer.observe(navbarMenu, observerConfig);
  } else {
    console.warn("El elemento #navbarMenu1 no fue encontrado");
  }
});

/* Motion */
const { animate, scroll, inView } = window.Motion;

document.querySelectorAll(".section-motion > div").forEach((item) => {
  scroll(animate(item, { opacity: [0, 1, 1, 0] }), {
    target: item,
    offset: ["start end", "end end", "start start", "end start"],
  });
});

inView(".title-motion", (element) => {
  animate(
    element,
    { opacity: 1, x: [-100, 0] },
    {
      duration: 0.9,
      easing: [0.17, 0.55, 0.55, 1],
    }
  );

  return () => animate(element, { opacity: 0, x: -100 });
});
