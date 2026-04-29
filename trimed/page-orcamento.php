<?php get_header(); ?>

<?php $wa = trimed_whatsapp_url('Olá! Gostaria de solicitar um orçamento dos produtos Trimed.'); ?>

<main id="main" role="main">

<!-- HERO -->
<section class="page-hero" aria-label="Solicitação de Orçamento">
  <div class="page-hero__bg" aria-hidden="true"></div>
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow">Orçamento</span>
      <h1 class="page-hero__title">Solicite seu Orçamento</h1>
      <p class="page-hero__sub">Preencha o formulário e nossa equipe retorna com proposta personalizada em até 24 horas.</p>
    </div>
  </div>
</section>

<!-- FORMULÁRIO + GARANTIAS -->
<section class="section" aria-labelledby="orcamento-heading">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 380px;gap:60px;align-items:start">

      <!-- Form -->
      <div class="fade-up">
        <h2 class="sr-only" id="orcamento-heading">Formulário de orçamento</h2>
        <form class="trimed-form" id="form-orcamento" novalidate aria-label="Formulário de solicitação de orçamento">
          <?php wp_nonce_field('trimed_form_nonce', 'nonce_field', false); ?>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="orc-nome">Nome completo <span class="req" aria-label="obrigatório">*</span></label>
              <input type="text" id="orc-nome" name="nome" class="form-input" placeholder="Seu nome completo" required autocomplete="name">
            </div>
            <div class="form-group">
              <label class="form-label" for="orc-cargo">Cargo</label>
              <select id="orc-cargo" name="cargo" class="form-select">
                <option value="">Selecione...</option>
                <option>Comprador</option>
                <option>Gerente / Diretor</option>
                <option>Médico</option>
                <option>Enfermeiro</option>
                <option>Administrador</option>
                <option>Outro</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="orc-empresa">Hospital / Clínica / Empresa <span class="req" aria-label="obrigatório">*</span></label>
              <input type="text" id="orc-empresa" name="empresa" class="form-input" placeholder="Nome da instituição" required autocomplete="organization">
            </div>
            <div class="form-group">
              <label class="form-label" for="orc-cnpj">CNPJ <span style="font-weight:400;color:var(--clr-text-dim)">(opcional)</span></label>
              <input type="text" id="orc-cnpj" name="cnpj" class="form-input" placeholder="00.000.000/0000-00" autocomplete="off">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="orc-telefone">Telefone / WhatsApp <span class="req" aria-label="obrigatório">*</span></label>
              <input type="tel" id="orc-telefone" name="telefone" class="form-input" placeholder="(91) 99999-9999" required autocomplete="tel">
            </div>
            <div class="form-group">
              <label class="form-label" for="orc-email">E-mail <span class="req" aria-label="obrigatório">*</span></label>
              <input type="email" id="orc-email" name="email" class="form-input" placeholder="seu@email.com" required autocomplete="email">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="orc-cidade">Estado e Cidade <span class="req" aria-label="obrigatório">*</span></label>
            <input type="text" id="orc-cidade" name="cidade" class="form-input" placeholder="Ex: Belém — PA" required>
          </div>

          <div class="form-group">
            <label class="form-label">Produtos de interesse</label>
            <div class="form-checkboxes" role="group" aria-label="Selecione os produtos">
              <?php
              $produtos_lista = [
                'Capa Cirúrgica (Avental)',
                'Cobertor Óbito',
                'Manta SMS',
                'Touca Cirúrgica',
                'Propé Descartável',
                'Lençol Descartável',
                'Campo Cirúrgico',
                'Máscara Cirúrgica',
                'Kit Cirúrgico Completo',
              ];
              foreach ($produtos_lista as $idx => $prod) :
                $id = 'prod-' . $idx;
              ?>
                <label class="form-checkbox" for="<?php echo esc_attr($id); ?>">
                  <input type="checkbox" id="<?php echo esc_attr($id); ?>" name="produtos[]" value="<?php echo esc_attr($prod); ?>">
                  <span><?php echo esc_html($prod); ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="orc-quantidade">Quantidade estimada</label>
              <input type="text" id="orc-quantidade" name="quantidade" class="form-input" placeholder="Ex: 500 unidades/mês">
            </div>
            <div class="form-group">
              <label class="form-label" for="orc-frequencia">Frequência de compra</label>
              <select id="orc-frequencia" name="frequencia" class="form-select">
                <option value="">Selecione...</option>
                <option>Mensal</option>
                <option>Bimestral</option>
                <option>Trimestral</option>
                <option>Semestral</option>
                <option>Pontual</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="orc-obs">Observações</label>
            <textarea id="orc-obs" name="observacoes" class="form-textarea" placeholder="Especificações adicionais, prazos, condições especiais..."></textarea>
          </div>

          <div class="form-msg" role="alert" aria-live="polite"></div>

          <div class="form-submit">
            <button type="submit" class="btn btn--primary btn--lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m22 2-7 20-4-9-9-4 20-7z"/>
              </svg>
              Solicitar Orçamento
            </button>
          </div>
        </form>
      </div>

      <!-- Sidebar: guarantees + contact -->
      <div style="display:flex;flex-direction:column;gap:24px;position:sticky;top:96px" class="fade-up fade-up-d2">

        <div style="background:var(--clr-card);border:1px solid var(--clr-border-subtle);border-radius:var(--radius-xl);padding:28px">
          <h3 style="font-size:var(--text-base);font-weight:700;color:var(--clr-text);margin-bottom:20px">Por que solicitar pela Trimed?</h3>
          <div class="quote-guarantees">
            <div class="quote-guarantee">
              <div class="quote-guarantee__icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <span class="quote-guarantee__text">Resposta em até 24 horas úteis</span>
            </div>
            <div class="quote-guarantee">
              <div class="quote-guarantee__icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <span class="quote-guarantee__text">Sem compromisso de compra</span>
            </div>
            <div class="quote-guarantee">
              <div class="quote-guarantee__icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <span class="quote-guarantee__text">Atendimento personalizado</span>
            </div>
            <div class="quote-guarantee">
              <div class="quote-guarantee__icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <span class="quote-guarantee__text">25 anos de confiança no setor</span>
            </div>
            <div class="quote-guarantee">
              <div class="quote-guarantee__icon" aria-hidden="true">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              </div>
              <span class="quote-guarantee__text">Entrega regional no Norte/PA</span>
            </div>
          </div>
        </div>

        <div style="background:var(--clr-surface);border:1px solid var(--clr-border);border-radius:var(--radius-xl);padding:28px;text-align:center">
          <p style="font-size:var(--text-sm);color:var(--clr-text-muted);margin-bottom:16px;line-height:1.6">Prefere falar direto com nossa equipe?</p>
          <a href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary" style="width:100%;justify-content:center">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
            </svg>
            WhatsApp agora
          </a>
          <p style="font-size:var(--text-xs);color:var(--clr-text-dim);margin-top:12px">(91) 98814-4786</p>
        </div>

      </div>
    </div>
  </div>
</section>

</main>

<style>
  .sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap}
  @media(max-width:768px){
    #main .container > div[style*="grid-template-columns:1fr 380px"] {
      grid-template-columns: 1fr !important;
    }
    #main .container > div > div:last-child[style*="sticky"] {
      position: static !important;
    }
  }
</style>

<?php get_footer(); ?>
