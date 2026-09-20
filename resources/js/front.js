import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const clamp = (value, min = 0, max = 1) => Math.min(max, Math.max(min, value));

/* Scroll reveal */
const revealItems = document.querySelectorAll('[data-reveal]');

if ('IntersectionObserver' in window && !reduceMotion) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12 }
    );

    revealItems.forEach((item) => observer.observe(item));
} else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
}

/* Scroll-driven effects (Apple-style): pinned scenes, parallax, word scrub, horizontal scroll */
const scrubScenes = [...document.querySelectorAll('[data-scrub]')];
const parallaxItems = [...document.querySelectorAll('[data-parallax]')];
const wordBlocks = [...document.querySelectorAll('[data-words]')];
const hscrolls = [...document.querySelectorAll('[data-hscroll]')];
const speedItems = [...document.querySelectorAll('[data-speed]')];
let ringDrag = 0;
const desktop = window.matchMedia('(min-width: 768px)');

wordBlocks.forEach((block) => {
    const words = block.textContent.trim().split(/\s+/);
    block.setAttribute('aria-label', words.join(' '));
    block.innerHTML = words.map((word) => `<span class="word" aria-hidden="true">${word}</span>`).join(' ');
    block._words = block.querySelectorAll('.word');
});

function setupHscroll() {
    hscrolls.forEach((section) => {
        const track = section.querySelector('[data-hscroll-track]');
        const active = desktop.matches && !reduceMotion;

        section._active = active;
        section.style.height = '';
        track.style.transform = '';
        section.querySelectorAll('[data-cover]').forEach((card) => {
            card.style.transform = '';
        });

        if (active) {
            section._distance = Math.max(0, track.scrollWidth - window.innerWidth + 64);
            section.style.height = `${section._distance + window.innerHeight}px`;
        }
    });
}

function update() {
    const vh = window.innerHeight;
    const doc = document.documentElement;

    doc.style.setProperty('--scroll', clamp(window.scrollY / (doc.scrollHeight - vh || 1)).toFixed(4));

    scrubScenes.forEach((scene) => {
        const rect = scene.getBoundingClientRect();

        if (rect.bottom < -vh || rect.top > vh * 2) {
            return;
        }

        const progress = clamp(-rect.top / (rect.height - vh || 1));

        scene.style.setProperty('--p', progress.toFixed(4));
        if (scene._ring === undefined) {
            scene._ring = scene.querySelector('.ring') ? [...scene.querySelectorAll('.ring-item')] : null;
        }

        if (scene._ring) {
            const rotation = -progress * 360 + ringDrag;

            scene._ring.forEach((item, index) => {
                const facing = (Math.cos(((index * 30 + rotation) * Math.PI) / 180) + 1) / 2;

                item.style.opacity = (0.3 + facing * 0.7).toFixed(2);
                item.style.filter = `brightness(${(0.45 + facing * 0.75).toFixed(2)})`;
            });
        }

        scene.querySelectorAll('[data-step]').forEach((step) => {
            step.classList.toggle('is-on', progress >= parseFloat(step.dataset.step));
        });
    });

    parallaxItems.forEach((item) => {
        const rect = item.parentElement.getBoundingClientRect();

        if (rect.bottom < 0 || rect.top > vh) {
            return;
        }

        const t = clamp((rect.top + rect.height / 2 - vh / 2) / (vh / 2 + rect.height / 2), -1, 1);
        const offset = t * rect.height * parseFloat(item.dataset.parallax);

        item.style.translate = `0 ${(-offset).toFixed(1)}px`;
    });

    speedItems.forEach((item) => {
        const rect = item.parentElement.getBoundingClientRect();

        if (rect.bottom < -vh || rect.top > vh * 2) {
            return;
        }

        item.style.translate = `0 ${(-(rect.top + rect.height / 2 - vh / 2) * parseFloat(item.dataset.speed)).toFixed(1)}px`;
    });

    wordBlocks.forEach((block) => {
        const rect = block.getBoundingClientRect();
        const progress = clamp((vh * 0.85 - rect.top) / (vh * 0.85 - vh * 0.35 + rect.height));
        const lit = Math.round(progress * block._words.length);

        block._words.forEach((word, index) => word.classList.toggle('on', index < lit));
    });

    hscrolls.forEach((section) => {
        if (!section._active) {
            return;
        }

        const rect = section.getBoundingClientRect();
        const progress = clamp(-rect.top / (rect.height - vh || 1));

        section.querySelector('[data-hscroll-track]').style.transform = `translate3d(${(-progress * section._distance).toFixed(1)}px,0,0)`;

        section.querySelectorAll('[data-cover]').forEach((card) => {
            const box = card.getBoundingClientRect();
            const d = clamp((box.left + box.width / 2 - window.innerWidth / 2) / (window.innerWidth / 2), -1.2, 1.2);

            card.style.transform = `perspective(1100px) rotateY(${(-d * 24).toFixed(2)}deg) scale(${(1 - Math.abs(d) * 0.07).toFixed(3)})`;
        });
    });
}

if (!reduceMotion) {
    let ticking = false;
    const schedule = () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(() => {
                update();
                ticking = false;
            });
        }
    };

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', () => {
        setupHscroll();
        schedule();
    });
    window.addEventListener('load', () => {
        setupHscroll();
        update();
    });
    setupHscroll();
    update();

    /* Drag to spin the 3D ring */
    document.querySelectorAll('.ring-scene').forEach((ringScene) => {
        const section = ringScene.closest('[data-scrub]');
        let startX = null;
        let base = 0;

        ringScene.addEventListener('pointerdown', (event) => {
            startX = event.clientX;
            base = ringDrag;
            ringScene.setPointerCapture(event.pointerId);
        });
        ringScene.addEventListener('pointermove', (event) => {
            if (startX === null) {
                return;
            }

            ringDrag = base + (event.clientX - startX) * 0.35;
            section.style.setProperty('--drag', `${ringDrag.toFixed(1)}deg`);
            schedule();
        });
        ['pointerup', 'pointercancel'].forEach((type) => ringScene.addEventListener(type, () => {
            startX = null;
        }));
    });

    /* Pointer-driven depth layers + glass spotlight */
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        const layers = [...document.querySelectorAll('[data-mouse]')];
        const tiltScenes = [...document.querySelectorAll('[data-mouse-tilt]')];

        window.addEventListener('pointermove', (event) => {
            const nx = event.clientX / window.innerWidth - 0.5;
            const ny = event.clientY / window.innerHeight - 0.5;

            layers.forEach((layer) => {
                const depth = parseFloat(layer.dataset.mouse);

                layer.style.transform = `translate3d(${(nx * depth).toFixed(1)}px, ${(ny * depth).toFixed(1)}px, 0)`;
            });

            tiltScenes.forEach((scene) => {
                scene.style.setProperty('--ry', `${(nx * 6).toFixed(2)}deg`);
                scene.style.setProperty('--rx', `${(-ny * 4).toFixed(2)}deg`);
            });

            const glass = event.target.closest?.('.glass');

            if (glass) {
                const rect = glass.getBoundingClientRect();

                glass.style.setProperty('--mx', `${event.clientX - rect.left}px`);
                glass.style.setProperty('--my', `${event.clientY - rect.top}px`);
            }
        }, { passive: true });
    }

    /* 3D tilt on hover-capable pointers */
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        document.querySelectorAll('[data-tilt]').forEach((card) => {
            card.addEventListener('pointermove', (event) => {
                const rect = card.getBoundingClientRect();
                const x = (event.clientX - rect.left) / rect.width - 0.5;
                const y = (event.clientY - rect.top) / rect.height - 0.5;

                card.style.transform = `perspective(900px) rotateX(${(-y * 6).toFixed(2)}deg) rotateY(${(x * 6).toFixed(2)}deg) scale(1.02)`;
            });
            card.addEventListener('pointerleave', () => {
                card.style.transform = '';
            });
        });
    }
} else {
    document.querySelectorAll('[data-step]').forEach((step) => step.classList.add('is-on'));
    wordBlocks.forEach((block) => block._words.forEach((word) => word.classList.add('on')));
}
