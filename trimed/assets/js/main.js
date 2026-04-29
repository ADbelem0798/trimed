(function () {
  'use strict';

  // ── Sticky header ──────────────────────────────────────────────
  const header = document.getElementById('site-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ── Mobile nav ─────────────────────────────────────────────────
  const hamburger = document.getElementById('nav-hamburger');
  const mobileNav = document.getElementById('nav-mobile');

  if (hamburger && mobileNav) {
    hamburger.addEventListener('click', () => {
      const open = hamburger.classList.toggle('is-open');
      mobileNav.classList.toggle('is-open', open);
      hamburger.setAttribute('aria-expanded', String(open));
      mobileNav.setAttribute('aria-hidden', String(!open));
      document.body.style.overflow = open ? 'hidden' : '';
    });

    // Close on link click
    mobileNav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        hamburger.classList.remove('is-open');
        mobileNav.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
        mobileNav.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      });
    });

    // Close on outside click
    document.addEventListener('click', e => {
      if (!header.contains(e.target) && mobileNav.classList.contains('is-open')) {
        hamburger.classList.remove('is-open');
        mobileNav.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
        mobileNav.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }
    });
  }

  // ── Scroll animations (IntersectionObserver) ───────────────────
  const fadeObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.08, rootMargin: '0px 0px -40px 0px' }
  );

  document.querySelectorAll('.fade-up').forEach(el => fadeObserver.observe(el));

  // ── Counter animation ──────────────────────────────────────────
  function animateCounter(el) {
    const target = parseInt(el.dataset.count, 10);
    if (isNaN(target)) return;
    const duration = 1600;
    const start = performance.now();

    const update = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
      el.textContent = Math.round(eased * target);
      if (progress < 1) requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
  }

  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 }
  );

  document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));

  // ── Product filter ─────────────────────────────────────────────
  const filterBtns = document.querySelectorAll('.filter-btn');
  const productCards = document.querySelectorAll('.product-card[data-category]');

  if (filterBtns.length && productCards.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');

        const filter = btn.dataset.filter;
        productCards.forEach(card => {
          const show = filter === 'all' || card.dataset.category === filter || card.dataset.fab === filter;
          card.style.display = show ? '' : 'none';
        });
      });
    });
  }

  // ── Form handler (AJAX + WhatsApp) ───────────────────────────
  function initForm(formId, action) {
    const form = document.getElementById(formId);
    if (!form) return;

    const msgEl    = form.querySelector('.form-msg');
    const submitBtn = form.querySelector('[type="submit"]');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (!window.trimedAjax) return;

      const originalHTML = submitBtn.innerHTML;
      submitBtn.classList.add('is-loading');
      submitBtn.disabled = true;
      submitBtn.textContent = '';

      if (msgEl) msgEl.className = 'form-msg';

      const data = new FormData(form);
      data.append('action', action);
      data.append('nonce', trimedAjax.nonce);

      try {
        const res  = await fetch(trimedAjax.url, { method: 'POST', body: data });
        const json = await res.json();

        if (json.success) {
          form.reset();

          if (msgEl) {
            msgEl.innerHTML = '✅ ' + (json.data?.message || 'Enviado!') +
              (json.data?.wa_url
                ? ' <a href="' + json.data.wa_url + '" target="_blank" rel="noopener" style="color:var(--clr-primary);font-weight:700;text-decoration:underline">Abrir no WhatsApp →</a>'
                : '');
            msgEl.className = 'form-msg success';
          }

          // Auto-open WhatsApp after short delay so user sees the message first
          if (json.data?.wa_url) {
            setTimeout(() => window.open(json.data.wa_url, '_blank', 'noopener'), 800);
          }

          setTimeout(() => { if (msgEl) msgEl.className = 'form-msg'; }, 10000);

        } else {
          if (msgEl) {
            msgEl.textContent = json.data?.message || 'Erro ao enviar. Verifique os campos obrigatórios.';
            msgEl.className = 'form-msg error';
          }
        }
      } catch {
        if (msgEl) {
          msgEl.textContent = 'Erro de conexão. Tente novamente ou fale pelo WhatsApp.';
          msgEl.className = 'form-msg error';
        }
      } finally {
        submitBtn.innerHTML = originalHTML;
        submitBtn.classList.remove('is-loading');
        submitBtn.disabled = false;
      }
    });
  }

  initForm('form-contato', 'trimed_contato');
  initForm('form-orcamento', 'trimed_orcamento');

  // ── Smooth scroll for anchor links ────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const id = anchor.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // ── Color palette panel ────────────────────────────────────────
  const paletteTrigger = document.getElementById('palette-trigger');
  const palettePanel   = document.getElementById('palette-panel');

  if (paletteTrigger && palettePanel) {
    paletteTrigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = palettePanel.classList.toggle('is-open');
      paletteTrigger.setAttribute('aria-expanded', String(open));
    });

    document.addEventListener('click', (e) => {
      if (!palettePanel.contains(e.target) && e.target !== paletteTrigger) {
        palettePanel.classList.remove('is-open');
        paletteTrigger.setAttribute('aria-expanded', 'false');
      }
    });

    palettePanel.querySelectorAll('.palette-swatch').forEach(swatch => {
      swatch.addEventListener('click', () => {
        const hex = swatch.dataset.hex;
        if (!hex) return;
        navigator.clipboard.writeText(hex).catch(() => {});
        swatch.classList.add('did-copy');
        setTimeout(() => swatch.classList.remove('did-copy'), 1400);
      });
    });
  }

  // ── Hero entrance animation ────────────────────────────────────
  window.addEventListener('load', () => {
    document.querySelectorAll('.hero__content > *').forEach((el, i) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = `opacity 0.7s ease ${i * 0.12}s, transform 0.7s ease ${i * 0.12}s`;
      requestAnimationFrame(() => {
        el.style.opacity = '1';
        el.style.transform = 'none';
      });
    });
  });

})();
