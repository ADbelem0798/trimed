<?php get_header(); ?>

<?php
global $post;
$fab   = get_post_meta(get_the_ID(), '_trimed_fabricacao_propria', true);
$cat   = get_post_meta(get_the_ID(), '_trimed_categoria_badge', true);
$specs = get_post_meta(get_the_ID(), '_trimed_especificacoes', true);
$spec_lines = array_filter(explode("\n", trim($specs)));
$wa_link = trimed_produto_whatsapp(get_the_title());
$wa_gen  = trimed_whatsapp_url('Olá! Gostaria de solicitar um orçamento.');
?>

<main id="main" role="main">

<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" style="padding-top:88px;padding-bottom:0;background:var(--clr-bg)">
  <div class="container">
    <ol style="display:flex;align-items:center;gap:8px;list-style:none;padding:16px 0;font-size:var(--text-sm);color:var(--clr-text-dim)">
      <li><a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--clr-text-muted);text-decoration:none;transition:color .2s" onmouseover="this.style.color='var(--clr-primary)'" onmouseout="this.style.color='var(--clr-text-muted)'">Home</a></li>
      <li aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg></li>
      <li><a href="<?php echo esc_url(home_url('/produtos')); ?>" style="color:var(--clr-text-muted);text-decoration:none;transition:color .2s" onmouseover="this.style.color='var(--clr-primary)'" onmouseout="this.style.color='var(--clr-text-muted)'">Produtos</a></li>
      <li aria-hidden="true"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg></li>
      <li aria-current="page" style="color:var(--clr-text)"><?php the_title(); ?></li>
    </ol>
  </div>
</nav>

<!-- Product detail -->
<section class="section--sm" aria-labelledby="produto-title">
  <div class="container">
    <div class="product-single__inner">

      <!-- Image -->
      <div class="product-single__image fade-up">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('produto-hero', ['loading' => 'eager', 'alt' => esc_attr(get_the_title())]); ?>
        <?php else : ?>
          <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;width:100%;height:100%;background:linear-gradient(135deg,var(--clr-surface) 0%,var(--clr-surface-2) 100%)" aria-hidden="true">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--clr-primary)" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity:.5">
              <path d="M12 2v20M2 12h20"/>
            </svg>
            <span style="font-size:var(--text-sm);color:var(--clr-text-dim);font-weight:500;letter-spacing:.08em;text-transform:uppercase"><?php echo esc_html($cat ?: 'Hospitalar'); ?></span>
          </div>
        <?php endif; ?>
      </div>

      <!-- Content -->
      <div class="product-single__content fade-up fade-up-d1">

        <div class="product-single__badges">
          <?php if ($fab === '1') : ?>
            <span class="product-card__badge product-card__badge--fab" style="position:static">Fabricação Própria</span>
          <?php endif; ?>
          <?php if ($cat) : ?>
            <span class="product-card__badge product-card__badge--dist" style="position:static"><?php echo esc_html($cat); ?></span>
          <?php endif; ?>
        </div>

        <h1 class="product-single__title" id="produto-title"><?php the_title(); ?></h1>

        <?php
        $s_desc = get_post_meta(get_the_ID(), '_trimed_descricao', true);
        if (empty($s_desc)) $s_desc = get_post_field('post_excerpt', get_the_ID());
        if ($s_desc) : ?>
        <div class="product-single__desc"><?php echo wp_kses_post(wpautop(esc_html($s_desc))); ?></div>
        <?php endif; ?>

        <!-- Specs table -->
        <?php if (!empty($spec_lines)) : ?>
          <div>
            <h2 style="font-size:var(--text-base);font-weight:700;color:var(--clr-text-2);letter-spacing:.06em;text-transform:uppercase;margin-bottom:12px">Especificações Técnicas</h2>
            <div class="specs-table" role="table" aria-label="Especificações técnicas">
              <?php foreach ($spec_lines as $line) :
                $parts = explode(':', $line, 2);
                $key = isset($parts[0]) ? trim($parts[0]) : '';
                $val = isset($parts[1]) ? trim($parts[1]) : trim($line);
              ?>
                <div class="spec-row" role="row">
                  <span class="spec-row__key" role="rowheader"><?php echo esc_html($key); ?></span>
                  <span class="spec-row__val" role="cell"><?php echo esc_html($val); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- CTAs -->
        <div class="product-single__ctas">
          <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--lg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
            </svg>
            Solicitar Orçamento
          </a>
          <a href="<?php echo esc_url(home_url('/orcamento')); ?>" class="btn btn--outline btn--lg">
            Formulário completo
          </a>
        </div>

        <!-- Back to products -->
        <a href="<?php echo esc_url(home_url('/produtos')); ?>" style="display:inline-flex;align-items:center;gap:6px;font-size:var(--text-sm);color:var(--clr-text-muted);text-decoration:none;transition:color .2s;margin-top:4px" onmouseover="this.style.color='var(--clr-primary)'" onmouseout="this.style.color='var(--clr-text-muted)'">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
          Ver todos os produtos
        </a>

      </div>
    </div>
  </div>
</section>

<!-- Related products -->
<?php
$related = new WP_Query([
  'post_type'      => 'produto',
  'posts_per_page' => 3,
  'post__not_in'   => [get_the_ID()],
  'orderby'        => 'rand',
]);
if ($related->have_posts()) :
?>
<section class="section" style="background:var(--clr-bg-alt);border-top:1px solid var(--clr-border-subtle)" aria-labelledby="related-heading">
  <div class="container">
    <div class="section-header fade-up" style="margin-bottom:40px">
      <span class="eyebrow">Linha Trimed</span>
      <h2 class="section-title" id="related-heading">Outros <strong>Produtos</strong></h2>
    </div>
    <div class="products-grid">
      <?php
      $d = 1;
      while ($related->have_posts()) : $related->the_post();
        $r_fab = get_post_meta(get_the_ID(), '_trimed_fabricacao_propria', true);
        $r_cat = get_post_meta(get_the_ID(), '_trimed_categoria_badge', true);
        $r_wa  = trimed_produto_whatsapp(get_the_title());
      ?>
        <article class="product-card fade-up fade-up-d<?php echo $d; ?>">
          <div class="product-card__image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('produto-thumb', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
            <?php else : ?>
              <div class="product-card__image-placeholder" aria-hidden="true">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/></svg>
                <span><?php echo esc_html($r_cat ?: 'Hospitalar'); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($r_fab === '1') : ?>
              <span class="product-card__badge product-card__badge--fab">Fabricação Própria</span>
            <?php endif; ?>
          </div>
          <div class="product-card__body">
            <?php if ($r_cat) : ?>
              <span class="product-card__cat"><?php echo esc_html($r_cat); ?></span>
            <?php endif; ?>
            <h3 class="product-card__title"><?php the_title(); ?></h3>
            <?php $r_desc = get_post_meta(get_the_ID(), '_trimed_descricao', true) ?: get_post_field('post_excerpt', get_the_ID()); ?>
            <p class="product-card__desc"><?php echo esc_html(wp_trim_words($r_desc, 16, '...')); ?></p>
            <div class="product-card__footer">
              <a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm">Ver detalhes</a>
              <a href="<?php echo esc_url($r_wa); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--sm">Orçamento</a>
            </div>
          </div>
        </article>
      <?php
        $d++;
        endwhile;
        wp_reset_postdata();
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

</main>
<?php get_footer(); ?>
