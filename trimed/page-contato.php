<?php get_header(); ?>

<?php
$wa = trimed_whatsapp_url('Olá! Gostaria de entrar em contato com a Trimed.');
?>

<main id="main" role="main">

<!-- HERO -->
<section class="page-hero" aria-label="Contato">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow">Fale Conosco</span>
      <h1 class="page-hero__title">Entre em Contato</h1>
      <p class="page-hero__sub">Nossa equipe está pronta para atender você de segunda a sexta, das 8h às 18h.</p>
    </div>
  </div>
</section>

<!-- CANAIS DE CONTATO -->
<section class="section--sm" style="background:var(--clr-bg-alt);border-bottom:1px solid var(--clr-border-subtle)" aria-labelledby="channels-heading">
  <div class="container">
    <h2 class="sr-only" id="channels-heading">Canais de atendimento</h2>
    <div class="contact-channels">

      <!-- WhatsApp -->
      <a href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener noreferrer"
         class="contact-channel fade-up" aria-label="WhatsApp (91) 98814-4786">
        <div class="contact-channel__icon contact-channel__icon--wa" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
          </svg>
        </div>
        <div>
          <div class="contact-channel__label">WhatsApp</div>
          <div class="contact-channel__value">(91) 98814-4786</div>
        </div>
        <span class="btn btn--primary btn--sm" style="margin-top:auto;pointer-events:none">Chamar agora</span>
      </a>

      <!-- Telefone -->
      <a href="tel:+559130147418" class="contact-channel fade-up fade-up-d1" aria-label="Telefone (91) 3014-7418">
        <div class="contact-channel__icon contact-channel__icon--tel" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.9 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
        </div>
        <div>
          <div class="contact-channel__label">Telefone</div>
          <div class="contact-channel__value">(91) 3014-7418</div>
        </div>
        <span class="btn btn--outline btn--sm" style="margin-top:auto;pointer-events:none">Ligar agora</span>
      </a>

      <!-- Instagram -->
      <a href="https://www.instagram.com/trimedpa/" target="_blank" rel="noopener noreferrer"
         class="contact-channel fade-up fade-up-d2" aria-label="Instagram @trimedpa">
        <div class="contact-channel__icon contact-channel__icon--ig" aria-hidden="true">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
          </svg>
        </div>
        <div>
          <div class="contact-channel__label">Instagram</div>
          <div class="contact-channel__value">@trimedpa</div>
        </div>
        <span class="btn btn--ghost btn--sm" style="margin-top:auto;pointer-events:none">Seguir</span>
      </a>

    </div>
  </div>
</section>

<!-- FORMULÁRIO + MAPA -->
<section class="section" aria-labelledby="form-heading">
  <div class="container">
    <div class="form-section__inner">

      <!-- Form -->
      <div class="fade-up">
        <div class="section-header" style="margin-bottom:32px">
          <span class="eyebrow">Mensagem</span>
          <h2 class="section-title" id="form-heading">Envie uma<br><strong>mensagem</strong></h2>
          <p class="section-sub">Responderemos em até 24 horas ou pelo WhatsApp em minutos.</p>
        </div>

        <form class="trimed-form" id="form-contato" novalidate aria-label="Formulário de contato">
          <?php wp_nonce_field('trimed_form_nonce', 'nonce_field', false); ?>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="contact-nome">Nome completo <span class="req" aria-label="obrigatório">*</span></label>
              <input type="text" id="contact-nome" name="nome" class="form-input" placeholder="Seu nome" required autocomplete="name">
            </div>
            <div class="form-group">
              <label class="form-label" for="contact-empresa">Empresa / Hospital <span class="req" aria-label="obrigatório">*</span></label>
              <input type="text" id="contact-empresa" name="empresa" class="form-input" placeholder="Nome da instituição" required autocomplete="organization">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="contact-telefone">Telefone / WhatsApp <span class="req" aria-label="obrigatório">*</span></label>
              <input type="tel" id="contact-telefone" name="telefone" class="form-input" placeholder="(91) 99999-9999" required autocomplete="tel">
            </div>
            <div class="form-group">
              <label class="form-label" for="contact-email">E-mail</label>
              <input type="email" id="contact-email" name="email" class="form-input" placeholder="seu@email.com" autocomplete="email">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-produto">Produto de interesse</label>
            <select id="contact-produto" name="produto" class="form-select">
              <option value="">Selecione um produto...</option>
              <option>Capa Cirúrgica (Avental)</option>
              <option>Cobertor Óbito</option>
              <option>Manta SMS</option>
              <option>Touca Cirúrgica</option>
              <option>Propé Descartável</option>
              <option>Lençol Descartável</option>
              <option>Campo Cirúrgico</option>
              <option>Máscara Cirúrgica</option>
              <option>Kit Cirúrgico Completo</option>
              <option>Outros / Múltiplos produtos</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-mensagem">Mensagem</label>
            <textarea id="contact-mensagem" name="mensagem" class="form-textarea" placeholder="Como podemos ajudar sua instituição?"></textarea>
          </div>

          <div class="form-msg" role="alert" aria-live="polite"></div>

          <div class="form-submit">
            <button type="submit" class="btn btn--primary btn--lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m22 2-7 20-4-9-9-4 20-7z"/>
              </svg>
              Enviar mensagem
            </button>
          </div>
        </form>
      </div>

      <!-- Map + address -->
      <div class="fade-up fade-up-d2" style="display:flex;flex-direction:column;gap:24px">
        <div class="section-header">
          <span class="eyebrow">Localização</span>
          <h2 class="section-title" style="font-size:var(--text-3xl)">Onde<br><strong>ficamos</strong></h2>
        </div>

        <div class="map-wrapper" aria-label="Mapa da localização Trimed em Ananindeua">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d293.73619124514676!2d-48.41649803241139!3d-1.3438891505632238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a46060e109e629%3A0x349a29d9317fc286!2sTRIMED!5e0!3m2!1spt-BR!2sbr!4v1776759758345!5m2!1spt-BR!2sbr"
            width="600" height="450" style="border:0;"
            title="Mapa Trimed Ltda — Ananindeua, PA"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen>
          </iframe>
        </div>

        <address style="font-style:normal;display:flex;flex-direction:column;gap:12px">
          <div style="display:flex;gap:12px;align-items:flex-start">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--clr-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:2px" aria-hidden="true">
              <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <div>
              <p style="font-size:var(--text-sm);color:var(--clr-text-2);font-weight:600">Endereço</p>
              <p style="font-size:var(--text-sm);color:var(--clr-text-muted);line-height:1.6">Tv. José do Patrocínio (Conj. A. Queirós), 4<br>Quarenta Horas, Ananindeua — PA</p>
            </div>
          </div>
          <div style="display:flex;gap:12px;align-items:center">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--clr-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0" aria-hidden="true">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
            <div>
              <p style="font-size:var(--text-sm);color:var(--clr-text-2);font-weight:600">Horário de atendimento</p>
              <p style="font-size:var(--text-sm);color:var(--clr-text-muted)">Segunda a sexta · 08h00 às 18h00</p>
            </div>
          </div>
        </address>

      </div>
    </div>
  </div>
</section>

</main>

<style>.sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap}</style>

<?php get_footer(); ?>
