/**
 * Mojo Bootstrap - Main Custom Scripts & Smooth Micro-Interactions
 * 
 * @package Mojo_Bootstrap
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // 1. Initialize all Bootstrap 5 tooltips if present
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // 2. Initialize all Bootstrap 5 popovers if present
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // 3. Auto-close responsive mobile navbar when a link is clicked
    const navbarCollapse = document.getElementById('primaryNavbar');
    if (navbarCollapse) {
        const navLinks = navbarCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });
    }

    // 4. Smooth Scroll Reveal Animation (Intersection Observer)
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const revealSelectors = [
        '.clean-program-card',
        '.clean-job-card',
        '.clean-step-card',
        '.clean-news-card',
        '.stats-clean-strip',
        '.reveal',
        '.reveal-up',
        '.reveal-fade',
        '.reveal-scale',
        '.reveal-left',
        '.reveal-right'
    ];

    const revealElements = document.querySelectorAll(revealSelectors.join(', '));

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        // Fallback: immediately make all visible without animation
        revealElements.forEach(el => el.classList.add('is-visible'));
    } else {
        // Auto-assign staggered delays to grouped cards in rows
        document.querySelectorAll('.row').forEach(row => {
            const cards = row.querySelectorAll('.clean-program-card, .clean-job-card, .clean-step-card, .clean-news-card');
            if (cards.length > 1) {
                cards.forEach((card, idx) => {
                    if (!card.style.transitionDelay) {
                        card.style.transitionDelay = (idx * 0.12) + 's';
                    }
                    if (!card.classList.contains('reveal') && !card.classList.contains('reveal-left') && !card.classList.contains('reveal-right') && !card.classList.contains('reveal-scale') && !card.classList.contains('reveal-fade')) {
                        card.classList.add('reveal');
                    }
                });
            }
        });

        // Bidirectional Scroll Reveal: re-animates elements whenever scrolled into view (up or down)
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    // Check if element has genuinely moved out of the viewport
                    entry.target.classList.remove('is-visible');
                }
            });
        }, {
            root: null,
            rootMargin: '0px 0px -40px 0px',
            threshold: 0.1
        });

        revealElements.forEach(el => revealObserver.observe(el));
    }

    // 5. Smooth Counter Animation for Stats Numbers (Bidirectional)
    const counterElements = document.querySelectorAll('.stat-clean-number');
    if (counterElements.length > 0 && ('IntersectionObserver' in window) && !prefersReducedMotion) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const el = entry.target;
                if (!el.dataset.originalHtml) {
                    el.dataset.originalHtml = el.innerHTML;
                    el.dataset.originalText = el.textContent.trim();
                }

                if (entry.isIntersecting) {
                    if (el.dataset.isAnimating === 'true') return;
                    el.dataset.isAnimating = 'true';

                    const text = el.dataset.originalText;
                    const match = text.match(/([\d,\.]+)/);

                    if (match) {
                        const targetNum = parseFloat(match[1].replace(/,/g, ''));
                        const hasComma = text.includes(',');
                        const isDecimal = match[1].includes('.');
                        const prefix = text.slice(0, match.index);
                        const suffix = text.slice(match.index + match[1].length);

                        const duration = 1400;
                        const startTime = performance.now();

                        function updateCounter(now) {
                            const elapsed = now - startTime;
                            const progress = Math.min(elapsed / duration, 1);
                            // Ease out quartic
                            const easeOut = 1 - Math.pow(1 - progress, 4);
                            const current = targetNum * easeOut;

                            let formatted = isDecimal ? current.toFixed(1) : Math.floor(current).toString();
                            if (hasComma && !isDecimal) {
                                formatted = Number(formatted).toLocaleString('en-US');
                            }

                            el.innerHTML = prefix + formatted + (suffix ? `<span class="text-danger">${suffix}</span>` : '');

                            if (progress < 1) {
                                requestAnimationFrame(updateCounter);
                            } else {
                                el.innerHTML = el.dataset.originalHtml;
                                el.dataset.isAnimating = 'false';
                            }
                        }
                        requestAnimationFrame(updateCounter);
                    }
                } else {
                    // Reset on leave so it counts again when scrolled back
                    el.dataset.isAnimating = 'false';
                    if (el.dataset.originalHtml) {
                        el.innerHTML = el.dataset.originalHtml;
                    }
                }
            });
        }, { threshold: 0.3 });

        counterElements.forEach(el => counterObserver.observe(el));
    }

    // 6. Extreme Hero Slider Object Entrance & Exit Animations + Scroll-Back Re-trigger
    const heroCarousel = document.getElementById('heroHomeCarousel');
    if (heroCarousel) {
        // Function to trigger active slide entrance
        const activateSlide = (slideEl) => {
            if (!slideEl) return;
            slideEl.classList.remove('hero-slide-out', 'hero-slide-active');
            void slideEl.offsetWidth; // Force reflow
            slideEl.classList.add('hero-slide-active');
        };

        // When slide transition starts (Exit old slide, prep next slide)
        heroCarousel.addEventListener('slide.bs.carousel', (e) => {
            const allItems = heroCarousel.querySelectorAll('.carousel-item');
            const leavingItem = (typeof e.from === 'number' && allItems[e.from]) ? allItems[e.from] : heroCarousel.querySelector('.carousel-item.active');
            const enteringItem = e.relatedTarget;

            if (leavingItem) {
                leavingItem.classList.remove('hero-slide-active');
                leavingItem.classList.add('hero-slide-out');
            }

            if (enteringItem) {
                enteringItem.classList.remove('hero-slide-out');
            }
        });

        // When slide transition finishes (Activate new slide animations)
        heroCarousel.addEventListener('slid.bs.carousel', (e) => {
            const allItems = heroCarousel.querySelectorAll('.carousel-item');
            allItems.forEach((item) => {
                if (item !== e.relatedTarget) {
                    item.classList.remove('hero-slide-out', 'hero-slide-active');
                }
            });
            if (e.relatedTarget) {
                activateSlide(e.relatedTarget);
            }
        });

        // Initial active slide setup on page load
        const initialActive = heroCarousel.querySelector('.carousel-item.active');
        if (initialActive) {
            activateSlide(initialActive);
        }

        // 7. Hero Scroll-Back Re-Trigger:
        // Whenever the user scrolls down away from the hero and then scrolls back up,
        // re-trigger the extreme entrance animations fresh!
        const heroSection = document.querySelector('.hero-slider-section') || heroCarousel;
        let heroWasOutOfView = false;

        if (heroSection && 'IntersectionObserver' in window) {
            const heroScrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (heroWasOutOfView) {
                            // User scrolled back into hero! Re-trigger animations!
                            const curActive = heroCarousel.querySelector('.carousel-item.active');
                            if (curActive) {
                                activateSlide(curActive);
                            }
                        }
                        heroWasOutOfView = false;
                    } else {
                        // User scrolled down away from hero
                        heroWasOutOfView = true;
                        const curActive = heroCarousel.querySelector('.carousel-item.active');
                        if (curActive) {
                            curActive.classList.remove('hero-slide-active');
                        }
                    }
                });
            }, {
                root: null,
                threshold: 0.15
            });

            heroScrollObserver.observe(heroSection);
        }

        // Secondary safety listener for quick scroll-to-top
        window.addEventListener('scroll', () => {
            if (window.scrollY < 40 && heroWasOutOfView) {
                heroWasOutOfView = false;
                const curActive = heroCarousel.querySelector('.carousel-item.active');
                if (curActive && !curActive.classList.contains('hero-slide-active')) {
                    activateSlide(curActive);
                }
            }
        }, { passive: true });
    }
});
