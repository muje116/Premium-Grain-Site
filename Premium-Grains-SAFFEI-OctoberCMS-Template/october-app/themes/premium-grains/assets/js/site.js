const header = document.querySelector('[data-header]');
const toggle = document.querySelector('.menu-toggle');
const mobile = document.querySelector('.mobile-nav');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const onScroll = () => header?.classList.toggle('scrolled', window.scrollY > 24);
onScroll();
window.addEventListener('scroll', onScroll, { passive: true });

toggle?.addEventListener('click', () => {
  const open = toggle.getAttribute('aria-expanded') === 'true';
  toggle.setAttribute('aria-expanded', String(!open));
  mobile?.classList.toggle('open', !open);
  document.body.classList.toggle('menu-open', !open);
});

mobile?.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
  toggle?.setAttribute('aria-expanded', 'false');
  mobile.classList.remove('open');
  document.body.classList.remove('menu-open');
}));

document.querySelectorAll('[data-year]').forEach((el) => {
  el.textContent = new Date().getFullYear();
});

const revealSelector = [
  '[data-reveal]',
  'main > .section',
  '.page-banner-copy',
  '.page-banner-mark',
  '.project-banner-content > div',
  '.project-card',
  '.team-card',
  '.team-empty',
  '.hub-card',
  '.principle-grid article',
  '.model-track article',
  '.partner-points article',
  '.project-focus-grid article',
  '.contact-details > div',
  '.contact-form-card',
].join(',');

const revealItems = Array.from(document.querySelectorAll(revealSelector));
revealItems.forEach((element, index) => {
  element.setAttribute('data-reveal', element.getAttribute('data-reveal') || 'up');
  element.style.setProperty('--reveal-delay', `${Math.min(index % 6, 5) * 70}ms`);
});

if (reducedMotion || !('IntersectionObserver' in window)) {
  revealItems.forEach((element) => element.classList.add('is-visible'));
} else {
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => entry.target.classList.toggle('is-visible', entry.isIntersecting));
  }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });

  revealItems.forEach((element) => revealObserver.observe(element));
}

const parallaxImage = document.querySelector('.bottom-image-cta-image');
if (parallaxImage && !reducedMotion) {
  let parallaxTick = false;
  const updateParallax = () => {
    if (parallaxTick) return;
    parallaxTick = true;
    window.requestAnimationFrame(() => {
      const section = parallaxImage.closest('.bottom-image-cta');
      const bounds = section?.getBoundingClientRect();
      if (bounds) {
        const progress = (window.innerHeight - bounds.top) / (window.innerHeight + bounds.height);
        const offset = (progress - 0.5) * -30;
        parallaxImage.style.transform = `scale(1.08) translate3d(0, ${offset}px, 0)`;
      }
      parallaxTick = false;
    });
  };

  updateParallax();
  window.addEventListener('scroll', updateParallax, { passive: true });
  window.addEventListener('resize', updateParallax, { passive: true });
}
