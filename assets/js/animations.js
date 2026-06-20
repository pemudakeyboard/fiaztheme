/**
 * GSAP animations — smooth scroll & counter system.
 */
(function () {
  'use strict';

  function boot() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
      console.warn('[fiaztheme] GSAP not loaded — animations skipped.');
      return;
    }

    gsap.registerPlugin(ScrollTrigger);

    initHeroEntrance();
    initScrollAnimations();
    initStatsSection();

    window.addEventListener('load', function () {
      ScrollTrigger.refresh();
    });
  }

  function initHeroEntrance() {
    var hero = document.querySelector('.section--hero');
    if (!hero) return;

    var lines = hero.querySelectorAll('.hero__title .line');
    if (lines.length) {
      gsap.set(lines, { y: 72, opacity: 0 });
      gsap.to(lines, {
        y: 0,
        opacity: 1,
        duration: 1.15,
        stagger: 0.14,
        ease: 'power3.out',
        delay: 0.35,
      });
    }

    var animated = hero.querySelectorAll('[data-hero-animate]:not(.hero__title)');
    if (animated.length) {
      gsap.set(animated, { y: 36, opacity: 0 });
      gsap.to(animated, {
        y: 0,
        opacity: 1,
        duration: 1,
        stagger: 0.12,
        ease: 'power3.out',
        delay: 0.75,
      });
    }
  }

  function initScrollAnimations() {
    var fadeEls = gsap.utils.toArray('.fade-up').filter(function (el) {
      return !el.closest('.section--hero');
    });

    if (fadeEls.length) {
      gsap.set(fadeEls, { y: 36, opacity: 0 });

      ScrollTrigger.batch(fadeEls, {
        start: 'top 92%',
        once: true,
        onEnter: function (batch) {
          gsap.to(batch, {
            y: 0,
            opacity: 1,
            duration: 0.9,
            stagger: 0.07,
            ease: 'power3.out',
            overwrite: 'auto',
          });
        },
      });
    }

    document.querySelectorAll('.reveal-text').forEach(function (el) {
      if (el.closest('.section--hero')) return;

      var lines = el.querySelectorAll('.line');
      if (!lines.length) return;

      gsap.set(lines, { y: 48, opacity: 0 });
      gsap.to(lines, {
        y: 0,
        opacity: 1,
        duration: 0.95,
        stagger: 0.1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: el,
          start: 'top 85%',
          once: true,
        },
      });
    });
  }

  function parseCount(raw) {
    if (!raw) return 0;
    var n = parseFloat(String(raw).replace(/[^\d.]/g, ''));
    return isNaN(n) ? 0 : n;
  }

  function initStatsSection() {
    document.querySelectorAll('[data-stats-section]').forEach(function (section) {
      var items = section.querySelectorAll('[data-stat-item]');
      if (!items.length) return;

      ScrollTrigger.create({
        trigger: section,
        start: 'top 75%',
        once: true,
        onEnter: function () {
          items.forEach(function (item, index) {
            item.classList.add('is-visible');

            var numberEl = item.querySelector('[data-count-to]');
            var valueEl = item.querySelector('.stat-item__value');
            var barEl = item.querySelector('[data-stat-bar]');
            var target = parseCount(numberEl ? numberEl.getAttribute('data-count-to') : '0');

            if (valueEl && target > 0) {
              var counter = { val: 0 };
              gsap.to(counter, {
                val: target,
                duration: 2.2,
                delay: index * 0.12,
                ease: 'power2.out',
                onUpdate: function () {
                  valueEl.textContent = Math.round(counter.val);
                },
                onComplete: function () {
                  valueEl.textContent = Math.round(target);
                },
              });
            }

            if (barEl) {
              gsap.fromTo(
                barEl,
                { width: '0%' },
                {
                  width: '100%',
                  duration: 1.6,
                  delay: index * 0.12 + 0.2,
                  ease: 'power2.out',
                }
              );
            }

            gsap.from(item, {
              y: 28,
              opacity: 0,
              duration: 0.85,
              delay: index * 0.1,
              ease: 'power3.out',
            });
          });
        },
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
