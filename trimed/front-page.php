<?php get_header(); ?>

<?php
$wa_orcamento = trimed_whatsapp_url('Olá! Gostaria de solicitar um orçamento.');
$wa_contato   = trimed_whatsapp_url('Olá! Gostaria de mais informações sobre os produtos Trimed.');
?>

<!-- ═══════════════════════════════════════════════════════════════
     BANNER FULL-WIDTH (acima do hero)
     ═══════════════════════════════════════════════════════════════ -->
<main id="main" role="main">
<?php
$hero_banner_id = (int) get_option('trimed_hero_banner_id', 0);
if ($hero_banner_id):
    $hero_banner_url = wp_get_attachment_image_url($hero_banner_id, 'full');
    $hero_banner_alt = get_post_meta($hero_banner_id, '_wp_attachment_image_alt', true);
?>
<div class="hero-banner-fullwidth" role="img" aria-label="<?php echo esc_attr($hero_banner_alt ?: 'Trimed — Produtos Hospitalares'); ?>">
  <img
    src="<?php echo esc_url($hero_banner_url); ?>"
    alt="<?php echo esc_attr($hero_banner_alt ?: 'Trimed — Produtos Hospitalares'); ?>"
    loading="eager"
  >
</div>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════════
     SOBRE PREVIEW
     ═══════════════════════════════════════════════════════════════ -->
<section class="about-preview section" aria-labelledby="about-heading">
  <div class="container">
    <div class="about-preview__inner">
      <div class="about-preview__content fade-up">
        <span class="eyebrow">Nossa História</span>
        <h2 class="section-title" id="about-heading">Uma trajetória construída<br>com <strong>propósito</strong></h2>
        <p class="about-preview__text">
          A TRIMED foi fundada em 11 de Janeiro de 2001, iniciando suas atividades na comercialização de produtos hospitalares. Sua primeira representação no Estado do Pará foi a BRASUTURE Indústria e Comércio de Fios Cirúrgicos. A empresa atuou no desenvolvimento da marca por meio de visitas a clínicas e hospitais, apresentando e consolidando o produto junto a enfermeiros(as) e médicos(as) em toda a região Norte.
        </p>
        <p class="about-preview__text">
          Hoje, 25 anos depois, a Trimed é referência no setor hospitalar do Norte, atendendo centenas de clientes com pontualidade, qualidade e compromisso.
        </p>
        <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn btn--outline">
          Conheça nossa história
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
        </a>
      </div>

     <div class="about-preview__image fade-up fade-up-d2">
  <img src="http://trimed.local/wp-content/uploads/2026/04/Foto.jpg" alt="Trimed — Ananindeua, PA">
</div>
    <span>Trimed — Ananindeua, PA</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     HERO
     ═══════════════════════════════════════════════════════════════ -->
<section class="hero" aria-label="Apresentação Trimed">
  <div class="hero__bg" aria-hidden="true">
    <div class="hero__grid"></div>
    <div class="hero__glow-1"></div>
    <div class="hero__glow-2"></div>
  </div>

  <div class="container">
    <div class="hero__inner">

      <!-- Content -->
      <div class="hero__content">
        <div class="hero__badge" aria-label="Fundada em 2001, Ananindeua, PA">
          <span class="hero__badge-dot" aria-hidden="true"></span>
          Desde 2001 · Ananindeua, PA
        </div>

        <h1 class="hero__headline">
          25 Anos Fornecendo<br>
          o Que a <em>Saúde</em> Precisa
        </h1>

        <p class="hero__sub">
          Distribuidora e fabricante de produtos hospitalares com qualidade certificada.
          Atendemos hospitais, clínicas e profissionais de saúde em todo o Norte do Brasil.
        </p>

        <div class="hero__actions">
          <a href="<?php echo esc_url($wa_orcamento); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--lg">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
            </svg>
            Solicitar Orçamento
          </a>
          <a href="<?php echo esc_url(home_url('/produtos')); ?>" class="btn btn--ghost btn--lg">
            Conheça nossos produtos
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
          </a>
        </div>
      </div>

      <?php
      $hero_card_logo_id = (int) get_option('trimed_hero_card_logo_id', 0);
      if ($hero_card_logo_id) {
          $hero_card_logo_src = wp_get_attachment_image_url($hero_card_logo_id, 'medium');
          $hero_card_logo_alt = 'Trimed';
      } else {
          $hero_card_logo_src = get_template_directory_uri() . '/assets/img/logo-vertical.png';
          $hero_card_logo_alt = 'Trimed';
      }
      ?>
      <!-- Visual card -->
      <div class="hero__visual" aria-hidden="true">
        <div class="hero__card">
          <div class="hero__card-logo" style="background:transparent;padding:0;width:auto;height:auto">
            <img
              src="<?php echo esc_url($hero_card_logo_src); ?>"
              alt="<?php echo esc_attr($hero_card_logo_alt); ?>"
              style="height:88px;width:auto;object-fit:contain"
              width="150"
              height="88"
            >
          </div>
          <div class="hero__card-title" style="display:none">Trimed Ltda</div>
          <div class="hero__card-sub">Produtos hospitalares de qualidade para o Norte do Brasil</div>
          <div class="hero__stats-grid">
            <div class="hero__stat-item">
              <div class="hero__stat-number">25+</div>
              <div class="hero__stat-label">Anos no mercado</div>
            </div>
            <div class="hero__stat-item">
              <div class="hero__stat-number">200+</div>
              <div class="hero__stat-label">Clientes ativos</div>
            </div>
            <div class="hero__stat-item">
              <div class="hero__stat-number">9+</div>
              <div class="hero__stat-label">Produtos próprios</div>
            </div>
            <div class="hero__stat-item">
              <div class="hero__stat-number">PA</div>
              <div class="hero__stat-label">Norte do Brasil</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     NÚMEROS
     ═══════════════════════════════════════════════════════════════ -->
<section class="stats section--sm" aria-label="Números da Trimed">
  <div class="container">
    <div class="stats__grid">
      <div class="stat-card fade-up">
        <div class="stat-card__number-wrap">
          <span class="stat-card__number" data-count="25">25</span>
          <span class="stat-card__suffix">+</span>
        </div>
        <span class="stat-card__label">Anos de mercado</span>
      </div>
      <div class="stat-card fade-up fade-up-d1">
        <div class="stat-card__number-wrap">
          <span class="stat-card__number" data-count="200">200</span>
          <span class="stat-card__suffix">+</span>
        </div>
        <span class="stat-card__label">Clientes atendidos</span>
      </div>
      <div class="stat-card fade-up fade-up-d2">
        <div class="stat-card__number-wrap">
          <span class="stat-card__number" data-count="9">9</span>
          <span class="stat-card__suffix">+</span>
        </div>
        <span class="stat-card__label">Produtos próprios</span>
      </div>
      <div class="stat-card fade-up fade-up-d3">
        <div class="stat-card__number-wrap">
          <span class="stat-card__number" data-count="100">100</span>
          <span class="stat-card__suffix">%</span>
        </div>
        <span class="stat-card__label">Fabricação nacional</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     PRODUTOS EM DESTAQUE
     ═══════════════════════════════════════════════════════════════ -->
<section class="section" id="produtos" aria-labelledby="products-heading">
  <div class="container">
    <div class="section-header fade-up">
      <span class="eyebrow">Fabricação Própria</span>
      <h2 class="section-title" id="products-heading">Nossa Linha de<br><strong>Produtos Próprios</strong></h2>
      <p class="section-sub">Desenvolvidos e fabricados com rigoroso controle de qualidade, prontos para suprir as demandas de hospitais e clínicas do Norte do Brasil.</p>
    </div>

    <div class="products-grid" id="home-products-grid">
      <?php
      $featured_products = new WP_Query([
        'post_type'      => 'produto',
        'posts_per_page' => 3,
        'meta_key'       => '_trimed_fabricacao_propria',
        'meta_value'     => '1',
        'orderby'        => 'date',
        'order'          => 'ASC',
      ]);

      if ($featured_products->have_posts()) :
        $delay = 1;
        while ($featured_products->have_posts()) : $featured_products->the_post();
          $fab   = get_post_meta(get_the_ID(), '_trimed_fabricacao_propria', true);
          $cat   = get_post_meta(get_the_ID(), '_trimed_categoria_badge', true);
          $specs = get_post_meta(get_the_ID(), '_trimed_especificacoes', true);
          $wa_link = trimed_produto_whatsapp(get_the_title());
          $spec_lines = array_slice(array_filter(explode("\n", $specs)), 0, 2);
      ?>
        <article class="product-card fade-up fade-up-d<?php echo $delay; ?>" data-category="<?php echo esc_attr($cat); ?>" data-fab="<?php echo $fab ? 'propria' : 'dist'; ?>">
          <div class="product-card__image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('produto-thumb', ['loading' => 'lazy', 'alt' => get_the_title()]); ?>
            <?php else : ?>
              <div class="product-card__image-placeholder" aria-hidden="true">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 2v20M2 12h20"/>
                </svg>
                <span><?php echo esc_html($cat ?: 'Produto'); ?></span>
              </div>
            <?php endif; ?>
            <?php if ($fab === '1') : ?>
              <span class="product-card__badge product-card__badge--fab" aria-label="Fabricação própria">Fabricação Própria</span>
            <?php endif; ?>
          </div>

          <div class="product-card__body">
            <?php if ($cat) : ?>
              <span class="product-card__cat"><?php echo esc_html($cat); ?></span>
            <?php endif; ?>
            <h3 class="product-card__title"><?php the_title(); ?></h3>
            <?php $desc = get_post_meta(get_the_ID(), '_trimed_descricao', true) ?: get_the_excerpt(); ?>
            <p class="product-card__desc"><?php echo esc_html(wp_trim_words($desc, 18, '...')); ?></p>
            <?php if (!empty($spec_lines)) : ?>
              <div class="product-specs" aria-label="Especificações">
                <?php foreach ($spec_lines as $line) : ?>
                  <span class="product-spec"><?php echo esc_html(trim($line)); ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <div class="product-card__footer">
              <a href="<?php the_permalink(); ?>" class="btn btn--ghost btn--sm">Ver detalhes</a>
              <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary btn--sm">Orçamento</a>
            </div>
          </div>
        </article>
      <?php
          $delay = min($delay + 1, 4);
        endwhile;
        wp_reset_postdata();
      else :
        // Fallback se não há produtos cadastrados
        $fallback = [
          ['Capas Cirúrgicas', 'Avental cirúrgico em TNT SMS com costura reforçada. Proteção máxima para profissionais de saúde.', 'Cirurgia'],
          ['Cobertores Óbito',  'Material resistente e tratado para serviços funerários hospitalares. Dignidade em cada detalhe.', 'Higiene'],
          ['Mantas SMS',        'Manta hospitalar em SMS de alta gramatura. Conforto e higiene para pacientes em leitos e macas.', 'Higiene'],
        ];
        foreach ($fallback as $i => $p) :
          $delay = $i + 1;
          $wa_fb = trimed_produto_whatsapp($p[0]);
      ?>
        <article class="product-card fade-up fade-up-d<?php echo $delay; ?>">
          <div class="product-card__image">
            <div class="product-card__image-placeholder" aria-hidden="true">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v20M2 12h20"/>
              </svg>
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
      <?php endforeach; endif; ?>
    </div>

    <div style="text-align:center;margin-top:40px" class="fade-up">
      <a href="<?php echo esc_url(home_url('/produtos')); ?>" class="btn btn--outline btn--lg">
        Ver todos os produtos
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     DIFERENCIAIS
     ═══════════════════════════════════════════════════════════════ -->
<section class="section" style="background:var(--clr-bg-alt)" aria-labelledby="features-heading">
  <div class="container">
    <div class="section-header section-header--center fade-up">
      <span class="eyebrow">Nossos Diferenciais</span>
      <h2 class="section-title" id="features-heading">Por que escolher<br>a <strong>Trimed?</strong></h2>
      <p class="section-sub">Combinamos experiência de 25 anos, fabricação própria e atendimento regional para entregar o melhor para sua instituição de saúde.</p>
    </div>

    <div class="features-grid">
      <div class="feature-card fade-up">
        <div class="feature-card__icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0 1 12 2.944a11.955 11.955 0 0 1-8.618 3.04A12.02 12.02 0 0 0 3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="feature-card__title">Fabricação Própria</h3>
        <p class="feature-card__desc">Controlamos cada etapa da produção — da matéria-prima ao produto final — garantindo qualidade, rastreabilidade total e conformidade com normas ANVISA.</p>
      </div>

      <div class="feature-card fade-up fade-up-d1">
        <div class="feature-card__icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <h3 class="feature-card__title">25 Anos de Experiência</h3>
        <p class="feature-card__desc">Desde 2001 fornecendo para os principais hospitais, clínicas e laboratórios do Pará e de todo o Norte do Brasil. Tradição e confiança no setor de saúde.</p>
      </div>

      <div class="feature-card fade-up fade-up-d2">
        <div class="feature-card__icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <h3 class="feature-card__title">Atendimento Regional</h3>
        <p class="feature-card__desc">Equipe especializada em Belém e região metropolitana. Entrega ágil para todo o Norte, com suporte pós-venda e atendimento personalizado para cada cliente.</p>
      </div>

      <div class="feature-card fade-up fade-up-d3">
        <div class="feature-card__icon" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2v20M2 12h20"/>
          </svg>
        </div>
        <h3 class="feature-card__title">Qualidade Certificada</h3>
        <p class="feature-card__desc">Produtos desenvolvidos seguindo rigorosas normas técnicas da ANVISA e ABNT. Materiais de alta performance testados para uso em ambientes hospitalares críticos.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     CTA FINAL
     ═══════════════════════════════════════════════════════════════ -->
<section class="cta-banner" aria-labelledby="cta-heading">
  <div class="container">
    <div class="cta-banner__inner">
      <h2 class="cta-banner__title" id="cta-heading">
        Pronto para otimizar o estoque<br>do seu hospital ou clínica?
      </h2>
      <p class="cta-banner__sub">
        Fale com nossa equipe e receba um orçamento personalizado em até 24 horas. Sem compromisso.
      </p>
      <div class="cta-banner__actions">
        <a href="<?php echo esc_url($wa_orcamento); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--white btn--lg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
          </svg>
          Falar no WhatsApp agora
        </a>
        <a href="<?php echo esc_url(home_url('/orcamento')); ?>" class="btn btn--ghost-on-color btn--lg">
          Preencher formulário
        </a>
      </div>
    </div>
  </div>
</section>
</main>

<?php get_footer(); ?>
