<?php get_header(); ?>

<main id="main" role="main">
  <section class="error-404" aria-label="Página não encontrada">
    <div class="error-404__inner">
      <div class="error-404__code" aria-hidden="true">404</div>
      <h1 class="error-404__title">Página não encontrada</h1>
      <p class="error-404__sub">A página que você procura não existe ou foi movida. Explore nossos produtos ou entre em contato.</p>
      <div class="error-404__actions">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary btn--lg">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Ir para Home
        </a>
        <a href="<?php echo esc_url(home_url('/produtos')); ?>" class="btn btn--ghost btn--lg">Ver produtos</a>
        <a href="<?php echo esc_url(trimed_whatsapp_url()); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--outline btn--lg">WhatsApp</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
