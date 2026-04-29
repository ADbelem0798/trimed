<?php get_header(); ?>

<?php $wa = trimed_whatsapp_url('Olá! Gostaria de mais informações sobre os produtos Trimed.'); ?>

<main id="main" role="main">

<!-- ═══════════════════════════════════════════════════════════════
     HERO
     ═══════════════════════════════════════════════════════════════ -->
<section class="page-hero" aria-label="Sobre a Trimed">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow">Quem Somos</span>
      <h1 class="page-hero__title">Sobre a Trimed</h1>
      <p class="page-hero__sub">Uma história construída com dedicação ao setor de saúde do Norte do Brasil — desde 2001.</p>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     NOSSA HISTÓRIA
     ═══════════════════════════════════════════════════════════════ -->
<section class="section" aria-labelledby="historia-heading">
  <div class="container">
    <div class="about-preview__inner sobre-grid">

      <div class="fade-up" style="display:flex;flex-direction:column;gap:24px">
        <span class="eyebrow">Nossa História</span>
        <h2 class="section-title" id="historia-heading">25 anos de <strong>trajetória</strong></h2>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
          A TRIMED foi criada em 11 de janeiro de 2001, iniciando suas atividades na comercialização de produtos hospitalares. A primeira representação no Estado do Pará foi a BRASUTURE Indústria e Comércio de Fios Cirúrgicos, onde desenvolvemos a marca com visitas a clínicas e hospitais, implantando o conceito junto a enfermeiros(as) e médicos(as) de toda a região Norte.
        </p>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
          Em 2008, após estudo de mercado, escolhemos trabalhar exclusivamente com materiais de consumo hospitalares de uso contínuo — atendendo uma demanda que não estava sendo suprida por outras empresas do ramo. Em 2012, dedicamos atenção integral à TRIMED, buscando grandes marcas e consolidando nossa posição como distribuidor referência no Estado do Pará.
        </p>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
          Em 2020, durante a pandemia, ampliamos nossa atuação para toda a região Norte — Amapá, Amazonas, Roraima, Pará, Maranhão e Piauí — reforçando nosso compromisso com o setor da saúde mesmo diante dos maiores desafios. Hoje, 25 anos depois, a Trimed é referência no setor hospitalar do Norte, atendendo centenas de clientes com pontualidade, qualidade e compromisso inabalável.
        </p>
      </div>

      <?php
      $sobre_img_id  = (int) get_option('trimed_sobre_image_id', 0);
      $sobre_img_src = $sobre_img_id ? wp_get_attachment_image_url($sobre_img_id, 'large') : '';
      $sobre_img_alt = $sobre_img_id ? (get_post_meta($sobre_img_id, '_wp_attachment_image_alt', true) ?: 'Trimed — Ananindeua, PA') : '';
      ?>
      <div class="about-preview__image fade-up fade-up-d2">
        <?php if ($sobre_img_src): ?>
          <img src="<?php echo esc_url($sobre_img_src); ?>" alt="<?php echo esc_attr($sobre_img_alt); ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover">
        <?php else: ?>
          <div class="about-preview__image-placeholder" style="border-radius:var(--radius-xl);border:1px dashed var(--clr-border);padding:32px;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px" aria-hidden="true">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/>
            </svg>
            <span>Adicione em Trimed Config → Imagem — Sobre</span>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     LINHA DO TEMPO
     ═══════════════════════════════════════════════════════════════ -->
<section class="section" style="background:var(--clr-bg-alt)" aria-labelledby="timeline-heading">
  <div class="container">
    <div class="sobre-grid sobre-grid--timeline">

      <div class="fade-up" style="display:flex;flex-direction:column;gap:16px">
        <span class="eyebrow">Trajetória</span>
        <h2 class="section-title" id="timeline-heading"><strong>25 anos</strong> de<br>crescimento</h2>
        <p class="section-sub" style="max-width:400px">Uma história de dedicação, evolução e compromisso com a excelência no fornecimento de produtos hospitalares.</p>
      </div>

      <div class="timeline fade-up fade-up-d1" role="list">
        <?php
        $events = [
          ['2001', 'Fundação da Trimed',            'Início das operações em Ananindeua, PA. Primeira representação: BRASUTURE Indústria e Comércio de Fios Cirúrgicos.'],
          ['2005', 'Transição estratégica',          'Com a entrada de produtos chineses no mercado, a Brasuture mudou de estratégia e a Trimed migrou de representação para comércio e distribuição.'],
          ['2008', 'Foco em consumo hospitalar',     'Após estudo de mercado, a Trimed passou a trabalhar exclusivamente com materiais de consumo hospitalar de uso contínuo — um segmento ainda pouco atendido na região.'],
          ['2012', 'Dedicação integral à Trimed',    'A empresa se consolidou como distribuidora referência no Pará, ampliando a estrutura operacional, logística e o portfólio com grandes marcas do setor.'],
          ['2020', 'Expansão para o Norte do Brasil','Durante a pandemia, a Trimed ampliou sua atuação para Amapá, Amazonas, Roraima, Maranhão e Piauí, garantindo o fornecimento contínuo em toda a região.'],
          ['2026', '25 anos de história',            'Um quarto de século fornecendo qualidade para a saúde do Norte. O legado continua crescendo com propósito e responsabilidade.'],
        ];
        foreach ($events as $event) :
        ?>
          <div class="timeline-item" role="listitem">
            <div class="timeline-item__dot" aria-hidden="true">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v20M2 12h20"/>
              </svg>
            </div>
            <div class="timeline-item__content">
              <div class="timeline-item__year"><?php echo esc_html($event[0]); ?></div>
              <div class="timeline-item__title"><?php echo esc_html($event[1]); ?></div>
              <div class="timeline-item__desc"><?php echo esc_html($event[2]); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>
<!-- ═══════════════════════════════════════════════════════════════
     NOSSOS VALORES
     ═══════════════════════════════════════════════════════════════ -->
<section class="section" aria-labelledby="historia-heading">
  <div class="container">
    <div class="about-preview__inner sobre-grid">

      <div class="fade-up" style="display:flex;flex-direction:column;gap:24px">
        <span class="eyebrow">Nossos Valores</span>
        <h2 class="section-title" id="historia-heading">Antes, <strong>Durante</strong> e depois.</h2>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
        <strong>Antes: </strong> Trabalhamos com produtos que tenham em sua marca confiança, qualidade e credibilidade. Todos os materiais em nossa linha de vendas passaram por pesquisa de apresentação, análise dos controles de qualidade emitidos pelos órgãos competentes e confiabilidade nos conceitos hospitalares de grandes hospitais e clínicas. Distribuímos aquilo que acreditamos ser o melhor para os profissionais e clientes finais. </p>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
        <strong>Durante: </strong> Nosso trabalho é fornecer produtos e serviços em nossa região de forma rápida e precisa para salvar vidas. As pessoas que usam os materiais hospitalares — profissionais e pacientes — acreditam que a vida é um dom de Deus e querem viver.</p>
        <p style="font-size:var(--text-base);color:var(--clr-text-muted);line-height:1.85">
        <strong>Depois: </strong> A saúde é um bem precioso que queremos lembrar com alegria e satisfação. Por isso queremos ser lembrados como uma empresa que oferece produtos e serviços que trazem resultados satisfatórios. Presente em todas as etapas e momentos de sua vida.</p>
      </div>

      <?php
      $sobre_img_id  = (int) get_option('trimed_sobre_image2_id', 0);
      $sobre_img_src = $sobre_img_id ? wp_get_attachment_image_url($sobre_img_id, 'large') : '';
      $sobre_img_alt = $sobre_img_id ? (get_post_meta($sobre_img_id, '_wp_attachment_image_alt', true) ?: 'Trimed — Ananindeua, PA') : '';
      ?>
      <div class="about-preview__image fade-up fade-up-d2">
        <?php if ($sobre_img_src): ?>
          <img src="<?php echo esc_url($sobre_img_src); ?>" alt="<?php echo esc_attr($sobre_img_alt); ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover">
        <?php else: ?>
          <div class="about-preview__image-placeholder" style="border-radius:var(--radius-xl);border:1px dashed var(--clr-border);padding:32px;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px" aria-hidden="true">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/>
            </svg>
            <span>Adicione em Trimed Config → Imagem — Valores</span>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     IDENTIDADE — MOSAICO (Valores, Missão, Visão, Responsabilidades)
     ═══════════════════════════════════════════════════════════════ -->
<section
        <!-- 2 — MISSÃO -->
        <div class="mosaic-card brick-reveal" data-delay="1">
          <div class="mosaic-card__tag">Missão</div>
          <h3 class="mosaic-card__title">Nosso Propósito</h3>
          <p class="mosaic-card__lead">Distribuir materiais hospitalares descartáveis para clínicas e hospitais, públicos e privados, com compromisso e responsabilidade.</p>
          <p class="mosaic-card__text">Buscamos promover a recuperação dos pacientes ao fornecer produtos de saúde de alta qualidade, contribuindo dignamente para o bem-estar da sociedade brasileira.</p>
        </div>

        <!-- 4 — VISÃO -->
        <div class="mosaic-card brick-reveal" data-delay="2">
          <div class="mosaic-card__tag">VISÃO</div>
          <h3 class="mosaic-card__title">VISÃO</h3>
          <p class="mosaic-card__text">Acreditamos que podemos gerar riqueza e distribuir renda nas regiões onde atuamos. Por isso, priorizamos a contratação de pessoas que vivem próximas à TRIMED, mesmo sem experiência prévia, oferecendo treinamento para que possam prestar um serviço de qualidade aos nossos clientes e parceiros.</p>
          <p class="mosaic-card__text">Dessa forma, contribuímos para o desenvolvimento econômico local e promovemos oportunidades de crescimento profissional para nossos colaboradores.</p>
        </div>
         <!-- 2 — RESPONSABILIDADE SOCIAL -->
        <div class="mosaic-card brick-reveal" data-delay="1">
          <div class="mosaic-card__tag">Servir</div>
          <h3 class="mosaic-card__title">RESPONSABILIDADE SOCIAL</h3>
          <p class="mosaic-card__lead">Distribuir materiais hospitalares descartáveis para clínicas e hospitais, públicos e privados, com compromisso e responsabilidade.</p>
          <p class="mosaic-card__text">Buscamos promover a recuperação dos pacientes ao fornecer produtos de saúde de alta qualidade, contribuindo dignamente para o bem-estar da sociedade brasileira.</p>
        </div>

        <!-- 4 — RESPONSABILIDADE CORPORATIVA -->
        <div class="mosaic-card brick-reveal" data-delay="2">
          <div class="mosaic-card__tag">Responsabilidade Corporativa</div>
          <h3 class="mosaic-card__title">Geração de Riqueza Local</h3>
          <p class="mosaic-card__text">Acreditamos que podemos gerar riqueza e distribuir renda nas regiões onde atuamos. Por isso, priorizamos a contratação de pessoas que vivem próximas à TRIMED, mesmo sem experiência prévia, oferecendo treinamento para que possam prestar um serviço de qualidade aos nossos clientes e parceiros.</p>
          <p class="mosaic-card__text">Dessa forma, contribuímos para o desenvolvimento econômico local e promovemos oportunidades de crescimento profissional para nossos colaboradores.</p>
        </div>
    </div><!-- /.mosaic -->
  </div>
</section>

<style>
/* ── Mosaico grid ───────────────────────────────────────────── */
.identidade-section { padding-bottom: 80px; }

.mosaic {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-top: 56px;
  align-items: start;
}

.mosaic__col {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.mosaic__col--right {
  margin-top: 48px;
}

/* ── Cards ──────────────────────────────────────────────────── */
.mosaic-card {
  background: var(--clr-card);
  border: 1px solid var(--clr-border);
  border-radius: var(--radius-xl);
  padding: 36px 40px;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.mosaic-card__tag {
  font-size: var(--text-xs);
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--clr-primary);
}

.mosaic-card__title {
  font-size: var(--text-xl);
  font-weight: 800;
  color: var(--clr-text);
  line-height: 1.25;
  margin: 0;
}

.mosaic-card__lead {
  font-size: var(--text-base);
  font-weight: 600;
  color: var(--clr-text-2);
  line-height: 1.7;
  margin: 0;
}

.mosaic-card__text {
  font-size: var(--text-base);
  color: var(--clr-text-muted);
  line-height: 1.85;
  margin: 0;
}

/* ── Pilares ────────────────────────────────────────────────── */
.mosaic-pillars {
  display: flex;
  flex-direction: column;
  gap: 18px;
  border-top: 1px solid var(--clr-border-subtle);
  padding-top: 18px;
  margin-top: 4px;
}

.mosaic-pillar {
  display: flex;
  gap: 14px;
  align-items: flex-start;
}

.mosaic-pillar__label {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 68px;
  padding: 3px 12px;
  border-radius: var(--radius-full);
  border: 1.5px solid var(--clr-primary);
  color: var(--clr-primary);
  font-size: var(--text-xs);
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  flex-shrink: 0;
  margin-top: 2px;
}

.mosaic-pillar p {
  font-size: var(--text-sm);
  color: var(--clr-text-muted);
  line-height: 1.8;
  margin: 0;
}

/* ── Scroll Reveal — sem escala ─────────────────────────────── */
.brick-reveal {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity .55s ease, transform .55s cubic-bezier(.22,1,.36,1);
}

.brick-reveal.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* ── Responsive ─────────────────────────────────────────────── */
@media (max-width: 768px) {
  .mosaic {
    grid-template-columns: 1fr;
  }
  .mosaic__col--right {
    margin-top: 0;
  }
  .mosaic-card {
    padding: 28px 24px;
  }
  .mosaic-pillar {
    flex-direction: column;
    gap: 6px;
  }
}
</style>

<script>
(function () {
  const cards = document.querySelectorAll('.brick-reveal');
  if (!cards.length) return;

  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = parseInt(entry.target.dataset.delay || 0) * 100;
        setTimeout(() => entry.target.classList.add('is-visible'), delay);
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  cards.forEach(c => obs.observe(c));
})();
</script>

<!-- ═══════════════════════════════════════════════════════════════
     CTA
     ═══════════════════════════════════════════════════════════════ -->
<section class="cta-banner" aria-labelledby="sobre-cta-heading">
  <div class="container">
    <div class="cta-banner__inner">
      <h2 class="cta-banner__title" id="sobre-cta-heading">
        Quer conhecer nossos produtos?
      </h2>
      <p class="cta-banner__sub">Fale com a nossa equipe e descubra como a Trimed pode atender as demandas da sua instituição de saúde.</p>
      <div class="cta-banner__actions">
        <a href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--white btn--lg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
          </svg>
          Falar no WhatsApp
        </a>
        <a href="<?php echo esc_url(home_url('/produtos')); ?>" class="btn btn--ghost-on-color btn--lg">
          Ver produtos
        </a>
      </div>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>