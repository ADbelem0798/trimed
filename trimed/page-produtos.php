<?php get_header(); ?>

<main id="main" role="main">

<section class="page-hero" aria-label="Produtos Trimed">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow">Linha Completa</span>
      <h1 class="page-hero__title">Nossos Produtos</h1>
      <p class="page-hero__sub">Fabricação própria e distribuição especializada para hospitais, clínicas e profissionais de saúde em todo o Norte do Brasil.</p>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="produtos-heading">
  <div class="container">

    <div class="filter-bar fade-up" role="group" aria-label="Filtrar produtos">
      <button class="filter-btn is-active" data-filter="all">Todos</button>
      <button class="filter-btn" data-filter="propria">Fabricação Própria</button>
      <button class="filter-btn" data-filter="Cirurgia">Cirurgia</button>
      <button class="filter-btn" data-filter="Higiene">Higiene</button>
      <button class="filter-btn" data-filter="EPIs">EPIs</button>
    </div>

    <h2 class="sr-only" id="produtos-heading">Lista de produtos</h2>

    <div class="products-grid" id="produtos-grid" style="margin-top:32px">
    <?php
    $args = [
        'post_type'      => 'produto',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        $i = 0;
        while ($query->have_posts()) : $query->the_post();
            $pid     = get_the_ID();
            $fab     = get_post_meta($pid, '_trimed_fabricacao_propria', true);
            $cat     = get_post_meta($pid, '_trimed_categoria_badge', true);
            $desc    = get_post_meta($pid, '_trimed_descricao', true);
            if (empty($desc)) $desc = get_post_field('post_excerpt', $pid);
            $wa_link = trimed_produto_whatsapp(get_the_title());
            $d       = min($i % 3 + 1, 4);
            $i++;
    ?>
        <article class="product-card fade-up fade-up-d<?php echo $d; ?>"
                 data-category="<?php echo esc_attr($cat); ?>"
                 data-fab="<?php echo $fab === '1' ? 'propria' : 'dist'; ?>">

          <div class="product-card__image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('produto-thumb', ['loading' => 'lazy', 'alt' => esc_attr(get_the_title())]); ?>
            <?php else : ?>
              <div class="product-card__image-placeholder" aria-hidden="true">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                <span><?php echo esc_html($cat ?: 'Hospitalar'); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($fab === '1') : ?>
              <span class="product-card__badge product-card__badge--fab">Fabricação Própria</span>
            <?php endif; ?>
          </div>

          <div class="product-card__body">
            <?php if ($cat) : ?>
              <span class="product-card__cat"><?php echo esc_html($cat); ?></span>
            <?php endif; ?>
            <h3 class="product-card__title"><?php the_title(); ?></h3>
            <?php if ($desc) : ?>
              <p class="product-card__desc"><?php echo esc_html(wp_trim_words($desc, 20, '...')); ?></p>
            <?php endif; ?>
            <div class="product-card__footer">
              <a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm">Ver detalhes</a>
              <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--sm">Orçamento</a>
            </div>
          </div>
        </article>
    <?php
        endwhile;
        wp_reset_postdata();

    else :
        $fallback = [
            ['Capa Cirúrgica (Avental)',  'Avental cirúrgico em TNT SMS com costura reforçada. Proteção máxima para profissionais de saúde.',       'Cirurgia'],
            ['Cobertor Óbito',            'Material resistente e tratado para serviços funerários hospitalares. Dignidade em cada detalhe.',        'Higiene'],
            ['Manta SMS',                 'Manta hospitalar em SMS de alta gramatura para uso em leitos e procedimentos ambulatoriais.',            'Higiene'],
            ['Touca Cirúrgica',           'Touca descartável com elástico ajustável para procedimentos cirúrgicos e ambientes estéreis.',          'Cirurgia'],
            ['Propé Descartável',         'Protetor de calçado antiderrapante para ambientes hospitalares e laboratoriais.',                        'EPIs'],
            ['Lençol Descartável',        'Lençol hospitalar descartável para macas e leitos. Higiene garantida em cada atendimento.',             'Higiene'],
            ['Campo Cirúrgico',           'Campo estéril para delimitação de área cirúrgica com alta barreira contra contaminação.',               'Cirurgia'],
            ['Máscara Cirúrgica',         'Máscara tripla camada com filtração ≥95% para profissionais de saúde.',                                'EPIs'],
            ['Kit Cirúrgico Completo',    'Kit completo com avental, campo, touca, máscara e propé. Embalagem estéril individual.',               'Cirurgia'],
        ];
        foreach ($fallback as $idx => $p) :
            $d = $idx % 3 + 1;
            $wa_fb = trimed_produto_whatsapp($p[0]);
        ?>
            <article class="product-card fade-up fade-up-d<?php echo $d; ?>" data-category="<?php echo esc_attr($p[2]); ?>" data-fab="propria">
              <div class="product-card__image">
                <div class="product-card__image-placeholder" aria-hidden="true">
                  <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                  <span><?php echo esc_html($p[2]); ?></span>
                </div>
                <span class="product-card__badge product-card__badge--fab">Fabricação Própria</span>
              </div>
              <div class="product-card__body">
                <span class="product-card__cat"><?php echo esc_html($p[2]); ?></span>
                <h3 class="product-card__title"><?php echo esc_html($p[0]); ?></h3>
                <p class="product-card__desc"><?php echo esc_html($p[1]); ?></p>
                <div class="product-card__footer">
                  <a href="<?php echo esc_url(home_url('/produtos')); ?>" class="btn btn--ghost btn--sm">Ver detalhes</a>
                  <a href="<?php echo esc_url($wa_fb); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--sm">Orçamento</a>
                </div>
              </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>

  </div>
</section>

<section class="cta-banner" style="background:var(--clr-surface);border-top:1px solid var(--clr-border-subtle);border-bottom:1px solid var(--clr-border-subtle)" aria-label="Qualidade Trimed">
  <div class="container">
    <div class="cta-banner__inner" style="padding-block:clamp(48px,6vw,72px)">
      <h2 style="font-size:clamp(var(--text-xl),3vw,var(--text-3xl));font-weight:800;color:var(--clr-text);letter-spacing:-.02em;margin:0;text-align:center">
        Todos os produtos passam por rigoroso controle de qualidade
      </h2>
      <p style="font-size:var(--text-base);color:var(--clr-text-muted);text-align:center;max-width:560px;line-height:1.7;margin-top:12px">
        Da matéria-prima à entrega, garantimos conformidade com normas ANVISA e ABNT em cada item da nossa linha.
      </p>
    </div>
  </div>
</section>

</main>

<style>.sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap}</style>

<?php get_footer(); ?>
