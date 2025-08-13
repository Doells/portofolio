import './bootstrap';
import 'flowbite';
import ScrollReveal from 'scrollreveal';
import AOS from 'aos';

import "flatpickr/dist/flatpickr.min.css";
import "../../resources/css/satoshi.css";
import "../../resources/css/app.css";

import Alpine from "alpinejs";
import 'preline';
import persist from "@alpinejs/persist";

// Import flatpickr
import flatpickr from 'flatpickr';
import { Indonesian } from "flatpickr/dist/l10n/id.js"

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.css'

Alpine.plugin(persist);
window.Alpine = Alpine;
Alpine.start();

// ScrollReveal
const sr = ScrollReveal();

// Tentukan konfigurasi animasi
const animateConfig = {
    origin: 'bottom',
    distance: '20px',
    duration: 1000,
    delay: 200,
    scale: 1,
    easing: 'ease-in-out',
  };

// Terapkan animasi pada elemen
sr.reveal('.animate__fadeInUp', animateConfig);


// AOS
import 'aos/dist/aos.css'; // You can also use <link> for styles

AOS.init();

document.addEventListener("DOMContentLoaded", () => {

  // Flatpickr
  flatpickr('.datepicker-range', {
    mode: 'range',
    locale: Indonesian,
    monthSelectorType: 'static',
    dateFormat: 'j F Y',
    defaultDate: [new Date(), new Date().setDate(new Date().getDate() + 6)],
    prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    /* disable: [
      function(date) {
        // Mengambil tanggal hari ini tanpa waktu
        var today = new Date();
        today.setHours(0, 0, 0, 0);
        // Mengembalikan true untuk menonaktifkan tanggal yang sudah terlewati
        return date < today;
      }
    ] */
  });

  flatpickr('.datepicker-range-now', {
    mode: 'range',
    locale: Indonesian,
    monthSelectorType: 'static',
    dateFormat: 'j F Y',
    defaultDate: [new Date(), new Date().setDate(new Date().getDate() + 6)],
    prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    disable: [
      function(date) {
        // Mengambil tanggal hari ini tanpa waktu
        var today = new Date();
        today.setHours(0, 0, 0, 0);
        // Mengembalikan true untuk menonaktifkan tanggal yang sudah terlewati
        return date < today;
      }
    ]
  });

  flatpickr('.datepicker', {
    mode: 'single',
    locale: Indonesian,
    monthSelectorType: 'static',
    dateFormat: 'd F Y',
    defaultDate: [new Date().setDate(new Date()), new Date()],
    prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
  });
  flatpickr('.timepicker', {
    noCalendar: true,
    enableTime: true,
    dateFormat: 'H:i',
    time_24hr: true,
    onReady: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
      const customClass = instance.element.getAttribute('data-class');
      instance.calendarContainer.classList.add(customClass);
    },
    onChange: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
    },
  });
});