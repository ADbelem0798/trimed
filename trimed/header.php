<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header" role="banner">
  <div class="container">
    <nav class="nav" role="navigation" aria-label="Navegação principal">

      <?php
      $nav_logo_id   = (int) get_option('trimed_logo_id', 0);
      $nav_logo_mode = get_option('trimed_logo_mode', 'original');
      $nav_logo_filter = ($nav_logo_mode === 'invert') ? 'filter:brightness(0) invert(1)' : '';
      if ($nav_logo_id) {
          $nav_logo_src = wp_get_attachment_image_url($nav_logo_id, 'medium');
          $nav_logo_alt = get_bloginfo('name');
      } else {
          $nav_logo_src = get_template_directory_uri() . '/assets/img/logo-mark.png';
          $nav_logo_alt = '';
      }
      ?>
      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav__logo" aria-label="Trimed — Página inicial">
        <?php if ($nav_logo_id): ?>
          <img
            src="<?php echo esc_url($nav_logo_src); ?>"
            alt="<?php echo esc_attr($nav_logo_alt); ?>"
            class="nav__logo-custom-img"
            style="height:52px;width:auto;object-fit:contain;<?php echo esc_attr($nav_logo_filter); ?>"
          >
        <?php else: ?>
          <img
            src="<?php echo esc_url($nav_logo_src); ?>"
            alt=""
            class="nav__logo-mark-img"
            width="56"
            height="56"
            aria-hidden="true"
          >
          <div>
            <span class="nav__logo-text">TRIMED</span>
            <span class="nav__logo-sub">Produtos Hospitalares</span>
          </div>
        <?php endif; ?>
      </a>

      <!-- Desktop menu -->
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class'     => 'nav__menu',
        'container'      => false,
        'fallback_cb'    => function() { ?>
          <ul class="nav__menu">
            <li <?php if(is_front_page()) echo 'class="current_page_item"'; ?>>
              <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            </li>
            <li <?php if(is_page('sobre')) echo 'class="current_page_item"'; ?>>
              <a href="<?php echo esc_url(home_url('/sobre')); ?>">Sobre</a>
            </li>
            <li <?php if(is_page('produtos') || is_singular('produto')) echo 'class="current_page_item"'; ?>>
              <a href="<?php echo esc_url(home_url('/produtos')); ?>">Produtos</a>
            </li>
            <li <?php if(is_page('contato')) echo 'class="current_page_item"'; ?>>
              <a href="<?php echo esc_url(home_url('/contato')); ?>">Contato</a>
            </li>
          </ul>
        <?php },
      ]); ?>

      <!-- Actions -->
      <div class="nav__actions">
        <a href="<?php echo esc_url(home_url('/orcamento')); ?>" class="btn btn--primary btn--sm">
          Solicitar Orçamento
        </a>
        <button class="nav__hamburger" id="nav-hamburger" aria-label="Abrir menu" aria-expanded="false" aria-controls="nav-mobile">
          <span></span><span></span><span></span>
        </button>
      </div>

    </nav>
  </div>

  <!-- Mobile nav -->
  <div class="nav__mobile" id="nav-mobile" aria-hidden="true" role="dialog" aria-label="Menu mobile">
    <div style="display:flex;align-items:center;gap:10px;padding-bottom:16px;border-bottom:1px solid var(--clr-border-subtle);margin-bottom:8px">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo-mark.png" alt="" width="32" height="32" aria-hidden="true">
      <span style="font-size:var(--text-lg);font-weight:800;color:var(--clr-white);letter-spacing:-.01em">TRIMED</span>
    </div>
    <nav class="nav__mobile-menu" role="navigation">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <a href="<?php echo esc_url(home_url('/sobre')); ?>">Sobre</a>
      <a href="<?php echo esc_url(home_url('/produtos')); ?>">Produtos</a>
      <a href="<?php echo esc_url(home_url('/contato')); ?>">Contato</a>
    </nav>
    <a href="<?php echo esc_url(home_url('/orcamento')); ?>" class="btn btn--primary" style="width:100%;justify-content:center">
      Solicitar Orçamento
    </a>
  </div>
</header>
