/**
 * Projects filter and view toggle.
 */
(function () {
  'use strict';

  function initFilters() {
    var container = document.querySelector('[data-projects]');
    if (!container) return;

    var cards = container.querySelectorAll('.project-card');
    var yearBtns = document.querySelectorAll('[data-filter-year]');
    var catBtns = document.querySelectorAll('[data-filter-category]');
    var activeYear = 'all';
    var activeCat = 'all';

    function applyFilters() {
      cards.forEach(function (card) {
        var year = card.getAttribute('data-year');
        var cat = card.getAttribute('data-category');
        var showYear = activeYear === 'all' || year === activeYear;
        var showCat = activeCat === 'all' || cat === activeCat;
        card.classList.toggle('is-hidden', !showYear || !showCat);
      });

      document.querySelectorAll('.timeline__group').forEach(function (group) {
        var visible = group.querySelectorAll('.project-card:not(.is-hidden)').length > 0;
        group.classList.toggle('is-hidden', !visible);
      });
    }

    yearBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        yearBtns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
        activeYear = btn.getAttribute('data-filter-year');
        applyFilters();
      });
    });

    catBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        catBtns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');
        activeCat = btn.getAttribute('data-filter-category');
        applyFilters();
      });
    });
  }

  function initViewToggle() {
    var grid = document.querySelector('.projects-grid');
    var timeline = document.querySelector('.projects-timeline');
    var btns = document.querySelectorAll('[data-view]');

    if (!grid || !timeline || !btns.length) return;

    btns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var view = btn.getAttribute('data-view');
        btns.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        grid.classList.toggle('is-hidden', view !== 'grid');
        timeline.classList.toggle('is-hidden', view !== 'timeline');
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initFilters();
    initViewToggle();
  });
})();
