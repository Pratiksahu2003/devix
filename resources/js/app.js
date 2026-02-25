import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)
window.Alpine = Alpine;

Alpine.start();

// Scroll reveal animations
(function () {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) return;

    // Select elements that explicitly have animation classes
    const animatedElements = document.querySelectorAll('.reveal-up, .scale-in, .fade-in');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        },
        { 
            rootMargin: '0px 0px -10% 0px', // Trigger when element is 10% from bottom
            threshold: 0.1 
        }
    );

    animatedElements.forEach((el) => observer.observe(el));
})();

// Lightweight tilt/parallax on hover for figures with data-tilt
(function () {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced || window.innerWidth < 768) return; // Disable on mobile
    
    const els = Array.from(document.querySelectorAll('.tilt-card'));
    
    els.forEach((el) => {
        const max = 4; // Max rotation degrees
        let raf = 0;

        function onMove(e) {
            const rect = el.getBoundingClientRect();
            // Calculate mouse position relative to center of element
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            
            // Invert Y for correct tilt direction
            const rx = y * -max * 2; 
            const ry = x * max * 2;

            cancelAnimationFrame(raf);
            raf = requestAnimationFrame(() => {
                el.style.transform = `perspective(1000px) rotateX(${rx.toFixed(2)}deg) rotateY(${ry.toFixed(2)}deg) scale3d(1.02, 1.02, 1.02)`;
            });
        }

        function onLeave() {
            cancelAnimationFrame(raf);
            el.style.transform = '';
        }

        el.addEventListener('mousemove', onMove);
        el.addEventListener('mouseleave', onLeave);
    });
})();