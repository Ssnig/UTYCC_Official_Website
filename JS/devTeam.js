document.addEventListener('DOMContentLoaded', () => {
    const cards = Array.from(document.querySelectorAll('.team-card'));

    const closeAllCards = (exception) => {
        cards.forEach((card) => {
            if (card === exception) {
                return;
            }
            toggleCardState(card, false);
        });
    };

    const toggleCardState = (card, shouldOpen) => {
        const toggleButton = card.querySelector('.card-toggle');
        const detail = card.querySelector('.card-detail');
        if (!toggleButton || !detail) {
            return;
        }

        const isOpen = typeof shouldOpen === 'boolean' ? shouldOpen : !card.classList.contains('is-open');
        if (isOpen) {
            card.classList.add('is-open');
        } else {
            card.classList.remove('is-open');
        }

        toggleButton.setAttribute('aria-expanded', String(isOpen));
        detail.setAttribute('aria-hidden', String(!isOpen));
    };

    cards.forEach((card) => {
        const toggleButton = card.querySelector('.card-toggle');
        const detail = card.querySelector('.card-detail');
        if (!toggleButton || !detail) {
            return;
        }

        toggleButton.setAttribute('aria-expanded', 'false');
        detail.setAttribute('aria-hidden', 'true');

        toggleButton.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            const shouldOpen = !card.classList.contains('is-open');
            closeAllCards(card);
            toggleCardState(card, shouldOpen);
        });

        card.addEventListener('mouseenter', () => {
            closeAllCards(card);
        });

        card.addEventListener('focusin', () => {
            closeAllCards(card);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAllCards();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.team-card')) {
            closeAllCards();
        }
    });

    const aboutHeading = document.querySelector('.about-section .about-heading');
    const aboutParagraph = document.querySelector('.about-section .about-description');
    let aboutWords = [];

    if (aboutParagraph && aboutParagraph.textContent.trim().length) {
        const wordFragments = aboutParagraph.textContent.trim().split(/\s+/);
        const fragmentCount = wordFragments.length;
        const fragmentNodes = document.createDocumentFragment();

        wordFragments.forEach((word, index) => {
            const wordSpan = document.createElement('span');
            wordSpan.className = 'about-word';
            wordSpan.textContent = word;
            fragmentNodes.appendChild(wordSpan);

            if (index < fragmentCount - 1) {
                fragmentNodes.appendChild(document.createTextNode(' '));
            }
        });

        aboutParagraph.textContent = '';
        aboutParagraph.appendChild(fragmentNodes);
        aboutWords = Array.from(aboutParagraph.querySelectorAll('.about-word'));
    }

    const aboutElements = [
        ...(aboutHeading ? [aboutHeading] : []),
        ...(aboutWords.length ? aboutWords : aboutParagraph ? [aboutParagraph] : [])
    ];

    const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    const animationTarget = {
        scale: 1.08,
        y: -12
    };

    const syncAnimationTarget = (matches) => {
        animationTarget.scale = matches ? 1.03 : 1.08;
        animationTarget.y = matches ? -4 : -12;
    };

    syncAnimationTarget(motionQuery.matches);

    if (window.gsap && aboutElements.length) {
        document.body.classList.add('has-gsap-about');

        if (typeof motionQuery.addEventListener === 'function') {
            motionQuery.addEventListener('change', (event) => syncAnimationTarget(event.matches));
        } else if (typeof motionQuery.addListener === 'function') {
            motionQuery.addListener((event) => syncAnimationTarget(event.matches));
        }

        aboutElements.forEach((element) => {
            gsap.set(element, {
                transformOrigin: 'center center',
                willChange: 'transform'
            });

            const liftUp = () => {
                gsap.killTweensOf(element);
                gsap.to(element, {
                    duration: 0.35,
                    scale: animationTarget.scale,
                    y: animationTarget.y,
                    ease: 'back.out(1.6)',
                    overwrite: 'auto'
                });
            };

            const reset = () => {
                gsap.killTweensOf(element);
                gsap.to(element, {
                    duration: 0.4,
                    scale: 1,
                    y: 0,
                    ease: 'power3.out',
                    overwrite: 'auto'
                });
            };

            element.addEventListener('mouseenter', liftUp);
            element.addEventListener('mouseleave', reset);
            element.addEventListener('focus', liftUp);
            element.addEventListener('blur', reset);
        });
    } else if (aboutElements.length) {
        document.body.classList.remove('has-gsap-about');
    }

    const timelineItems = Array.from(document.querySelectorAll('.timeline-item'));
    if (window.gsap && timelineItems.length) {
        timelineItems.forEach((item) => {
            const content = item.querySelector('.timeline-content');
            if (content) {
                gsap.set(content, { autoAlpha: 0, y: 28 });
            }
        });
    }

    if (timelineItems.length) {
        const timelineObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const item = entry.target;
                if (window.gsap) {
                    gsap.fromTo(item.querySelector('.timeline-content'), { autoAlpha: 0, y: 28 }, {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.75,
                        ease: 'power2.out'
                    });
                } else {
                    item.classList.add('is-visible');
                }

                observer.unobserve(item);
            });
        }, {
            threshold: 0.3
        });

        timelineItems.forEach((item) => {
            timelineObserver.observe(item);
        });
    }

    const voiceSlider = document.querySelector('.voice-slider');
    const voiceSlides = Array.from(document.querySelectorAll('.voice-slide'));

    if (voiceSlider && voiceSlides.length) {
        const prevButton = voiceSlider.querySelector('.voice-control--prev');
        const nextButton = voiceSlider.querySelector('.voice-control--next');
        const dots = Array.from(voiceSlider.querySelectorAll('.voice-dot'));
        let activeIndex = 0;
        let autoPlayId = null;

        const setActiveVoice = (index) => {
            activeIndex = (index + voiceSlides.length) % voiceSlides.length;

            voiceSlides.forEach((slide, slideIndex) => {
                const isActive = slideIndex === activeIndex;
                slide.classList.toggle('is-active', isActive);
                slide.setAttribute('aria-hidden', String(!isActive));
            });

            dots.forEach((dot, dotIndex) => {
                const isActive = dotIndex === activeIndex;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-selected', String(isActive));
            });
        };

        const goToPrevious = () => {
            setActiveVoice(activeIndex - 1);
        };

        const goToNext = () => {
            setActiveVoice(activeIndex + 1);
        };

        const stopAutoPlay = () => {
            if (autoPlayId) {
                clearInterval(autoPlayId);
                autoPlayId = null;
            }
        };

        const startAutoPlay = () => {
            stopAutoPlay();
            autoPlayId = window.setInterval(goToNext, 8000);
        };

        if (prevButton) {
            prevButton.addEventListener('click', () => {
                goToPrevious();
                startAutoPlay();
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', () => {
                goToNext();
                startAutoPlay();
            });
        }

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const target = Number(dot.dataset.target);
                if (Number.isFinite(target)) {
                    setActiveVoice(target);
                    startAutoPlay();
                }
            });
        });

        voiceSlider.addEventListener('mouseenter', stopAutoPlay);
        voiceSlider.addEventListener('mouseleave', startAutoPlay);
        voiceSlider.addEventListener('focusin', stopAutoPlay);
        voiceSlider.addEventListener('focusout', (event) => {
            if (!voiceSlider.contains(event.relatedTarget)) {
                startAutoPlay();
            }
        });

        setActiveVoice(activeIndex);
        startAutoPlay();
    }
});
