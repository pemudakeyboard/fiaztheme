/**
 * Main theme interactions.
 */
(function () {
  'use strict';

  function initHeader() {
    var header = document.querySelector('.site-header');
    if (!header) return;

    window.addEventListener(
      'scroll',
      function () {
        header.classList.toggle('is-scrolled', window.scrollY > 40);
      },
      { passive: true }
    );
  }

  function initMobileNav() {
    var toggle = document.querySelector('.site-nav__toggle');
    var nav = document.querySelector('.site-nav__list');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  function initHeroSwiper() {
    if (typeof Swiper === 'undefined') return;

    var el = document.querySelector('.hero-swiper');
    if (!el) return;

    var slides = el.querySelectorAll('.swiper-slide');
    if (slides.length <= 1) return;

    new Swiper(el, {
      effect: 'fade',
      fadeEffect: { crossFade: true },
      speed: 1400,
      loop: true,
      autoplay: {
        delay: 5500,
        disableOnInteraction: false,
      },
      allowTouchMove: true,
      pagination: {
        el: el.querySelector('.hero-swiper-pagination'),
        clickable: true,
      },
    });
  }

  function initProjectsSwiper() {
    if (typeof Swiper === 'undefined') return;

    var el = document.querySelector('.projects-swiper');
    if (!el) return;

    new Swiper(el, {
      slidesPerView: 'auto',
      spaceBetween: 24,
      freeMode: true,
      grabCursor: true,
      breakpoints: {
        768: { spaceBetween: 32 },
      },
    });
  }

  function initHeroVideo() {
    var video = document.querySelector('.hero__video');
    if (!video) return;

    video.setAttribute('playsinline', '');
    video.muted = true;

    var playPromise = video.play();
    if (playPromise && typeof playPromise.catch === 'function') {
      playPromise.catch(function () {
        /* Autoplay blocked — poster/fallback still visible */
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    initHeader();
    initMobileNav();
    initHeroSwiper();
    initHeroVideo();
    initProjectsSwiper();
  });
})();
