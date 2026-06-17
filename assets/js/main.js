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

  function initBottomNav() {
    var bar = document.querySelector('.mobile-bottom-nav');
    if (!bar) return;

    var lastScrollY = window.scrollY;
    var ticking = false;
    var mobileMax = 768;
    var threshold = 8;

    function updateBar() {
      ticking = false;

      if (window.innerWidth > mobileMax) {
        bar.classList.remove('is-hidden');
        return;
      }

      var currentY = window.scrollY;

      if (currentY <= 0) {
        bar.classList.remove('is-hidden');
      } else if (currentY > lastScrollY + threshold) {
        bar.classList.add('is-hidden');
      } else if (currentY < lastScrollY - threshold) {
        bar.classList.remove('is-hidden');
      }

      lastScrollY = currentY;
    }

    window.addEventListener(
      'scroll',
      function () {
        if (!ticking) {
          ticking = true;
          window.requestAnimationFrame(updateBar);
        }
      },
      { passive: true }
    );

    window.addEventListener('resize', function () {
      lastScrollY = window.scrollY;
      updateBar();
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
    initBottomNav();
    initHeroSwiper();
    initHeroVideo();
    initProjectsSwiper();
  });
})();
