<?php
defined('ABSPATH') || exit;

// ── Register settings page ────────────────────────────────────────────────────
function trimed_admin_menu() {
    add_menu_page(
        'Configurações Trimed',
        'Trimed Config',
        'manage_options',
        'trimed-settings',
        'trimed_settings_page',
        'dashicons-heart',
        3
    );
}
add_action('admin_menu', 'trimed_admin_menu');

// ── Enqueue media uploader + color picker on our page ────────────────────────
function trimed_admin_enqueue($hook) {
    if ($hook !== 'toplevel_page_trimed-settings') return;
    wp_enqueue_media();
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('trimed-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', ['jquery', 'wp-color-picker'], '1.0', true);
}
add_action('admin_enqueue_scripts', 'trimed_admin_enqueue');

// ── Register settings ─────────────────────────────────────────────────────────
function trimed_register_settings() {
    $fields = [
        'trimed_logo_id',
        'trimed_logo_mode',
        'trimed_hero_banner_id',
        'trimed_hero_card_logo_id',
        'trimed_sobre_image_id',
        'trimed_sobre_image2_id',
        'trimed_whatsapp_number',
        'trimed_contact_email',
        // Cores
        'trimed_color_primary',
        'trimed_color_primary_dark',
        'trimed_color_bg',
        'trimed_color_bg_alt',
        'trimed_color_text',
        'trimed_color_btn_text',
    ];
    foreach ($fields as $field) {
        register_setting('trimed_options', $field, ['sanitize_callback' => 'trimed_sanitize_option']);
    }
}
add_action('admin_init', 'trimed_register_settings');

function trimed_sanitize_option($value) {
    // Numbers (WA) stay numeric; emails get sanitized; IDs are integers; rest is text
    if (is_email($value)) return sanitize_email($value);
    if (ctype_digit($value)) return absint($value);
    return sanitize_text_field($value);
}

// ── Settings page HTML ────────────────────────────────────────────────────────
function trimed_settings_page() {
    if (!current_user_can('manage_options')) return;

    $logo_id           = (int) get_option('trimed_logo_id', 0);
    $logo_mode         = get_option('trimed_logo_mode', 'original');
    $hero_banner_id    = (int) get_option('trimed_hero_banner_id', 0);
    $hero_card_logo_id = (int) get_option('trimed_hero_card_logo_id', 0);
    $sobre_image_id    = (int) get_option('trimed_sobre_image_id', 0);
    $sobre_image2_id   = (int) get_option('trimed_sobre_image2_id', 0);
    $wa_number         = get_option('trimed_whatsapp_number', '5591988144786');
    $contact_email     = get_option('trimed_contact_email', get_option('admin_email'));

    $clr_primary      = get_option('trimed_color_primary',      '#00B573');
    $clr_primary_dark = get_option('trimed_color_primary_dark', '#1A3D2B');
    $clr_bg           = get_option('trimed_color_bg',           '#F8FAF9');
    $clr_bg_alt       = get_option('trimed_color_bg_alt',       '#EEF5F1');
    $clr_text         = get_option('trimed_color_text',         '#0D1F17');
    $clr_btn_text     = get_option('trimed_color_btn_text',     '#ffffff');

    $logo_url           = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
    $hero_banner_url    = $hero_banner_id ? wp_get_attachment_image_url($hero_banner_id, 'medium') : '';
    $hero_card_logo_url = $hero_card_logo_id ? wp_get_attachment_image_url($hero_card_logo_id, 'medium') : '';
    $sobre_image_url    = $sobre_image_id  ? wp_get_attachment_image_url($sobre_image_id,  'medium') : '';
    $sobre_image2_url   = $sobre_image2_id ? wp_get_attachment_image_url($sobre_image2_id, 'medium') : '';
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:12px">
            <span style="display:inline-flex;width:32px;height:32px;background:#00B573;border-radius:6px;align-items:center;justify-content:center">
                <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.9 0 1.6-.7 1.6-1.7 0-.4-.2-.8-.4-1.1-.3-.3-.4-.7-.4-1.1 0-.9.7-1.7 1.7-1.7H17c3 0 5.5-2.5 5.5-5.5C22.5 6.3 17.8 2 12 2z"/></svg>
            </span>
            Configurações Trimed
        </h1>
        <p style="color:#666;margin-top:4px">Controle central: logo, imagens, WhatsApp e e-mail de contato.</p>

        <?php settings_errors('trimed_options'); ?>

        <form method="post" action="options.php" id="trimed-settings-form">
            <?php settings_fields('trimed_options'); ?>

            <!-- ── Logo ─────────────────────────────────────────────── -->
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:24px;margin-top:24px">
                <h2 style="margin-top:0;font-size:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">Logo do Site</h2>
                <table class="form-table" style="margin-top:0">
                    <tr>
                        <th style="width:200px">Logo Principal</th>
                        <td>
                            <div class="trimed-image-upload" data-field="trimed_logo_id">
                                <input type="hidden" name="trimed_logo_id" id="trimed_logo_id" value="<?php echo esc_attr($logo_id); ?>">
                                <div class="trimed-preview" style="margin-bottom:8px">
                                    <?php if ($logo_url): ?>
                                        <img src="<?php echo esc_url($logo_url); ?>" style="max-height:60px;max-width:200px;object-fit:contain;border:1px solid #e2e8f0;border-radius:4px;padding:4px;background:#f8f8f8">
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="button trimed-upload-btn" data-target="trimed_logo_id" data-preview="logo_preview">
                                    <?php echo $logo_id ? 'Trocar Logo' : 'Selecionar Logo'; ?>
                                </button>
                                <?php if ($logo_id): ?>
                                    <button type="button" class="button trimed-remove-btn" data-target="trimed_logo_id" style="margin-left:4px;color:#dc2626;border-color:#dc2626">Remover</button>
                                <?php endif; ?>
                                <p class="description">Usada no cabeçalho do site. Recomendado: PNG com fundo transparente.</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Cor da Logo no Header</th>
                        <td>
                            <label style="margin-right:20px">
                                <input type="radio" name="trimed_logo_mode" value="original" <?php checked($logo_mode, 'original'); ?>>
                                Usar cor original
                            </label>
                            <label>
                                <input type="radio" name="trimed_logo_mode" value="invert" <?php checked($logo_mode, 'invert'); ?>>
                                Inverter para branco (fundo escuro)
                            </label>
                            <p class="description">Escolha "Inverter" se a logo tiver texto escuro e o cabeçalho for escuro.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── Imagens ───────────────────────────────────────────── -->
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:24px;margin-top:16px">
                <h2 style="margin-top:0;font-size:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">Imagens das Seções</h2>
                <table class="form-table" style="margin-top:0">

                    <tr>
                        <th>Banner Full-Width (Home)</th>
                        <td>
                            <?php trimed_image_field('trimed_hero_banner_id', $hero_banner_id, $hero_banner_url, 'Imagem que aparece antes do hero na página inicial. Tamanho recomendado: 1920×600px.'); ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Logo na Caixa Hero (Home)</th>
                        <td>
                            <?php trimed_image_field('trimed_hero_card_logo_id', $hero_card_logo_id, $hero_card_logo_url, 'Logo exibida dentro da caixa lateral do hero. Recomendado: PNG transparente, altura ~88px.'); ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Imagem — Página Sobre</th>
                        <td>
                            <?php trimed_image_field('trimed_sobre_image_id', $sobre_image_id, $sobre_image_url, 'Foto ao lado do texto "25 anos de trajetória". Recomendado: 800×600px.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Segunda Imagem — Página Sobre</th>
                        <td>
                            <?php trimed_image_field('trimed_sobre_image2_id', $sobre_image2_id, $sobre_image2_url, 'Foto abaixo do texto da história. Recomendado: 800×500px.'); ?>
                        </td>
                    </tr>

                </table>
            </div>

            <!-- ── Contato ───────────────────────────────────────────── -->
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:24px;margin-top:16px">
                <h2 style="margin-top:0;font-size:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">WhatsApp &amp; E-mail</h2>
                <table class="form-table" style="margin-top:0">
                    <tr>
                        <th style="width:200px">Número WhatsApp</th>
                        <td>
                            <input type="text" name="trimed_whatsapp_number" value="<?php echo esc_attr($wa_number); ?>" class="regular-text" placeholder="5591988144786">
                            <p class="description">Número com código do país, sem +, espaços ou hífen. Ex: <code>5591988144786</code></p>
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail de Destino dos Formulários</th>
                        <td>
                            <input type="email" name="trimed_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text" placeholder="contato@trimedpa.com.br">
                            <p class="description">Todos os formulários de contato e orçamento serão enviados para este e-mail.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── Cores ─────────────────────────────────────────────── -->
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:24px;margin-top:16px">
                <h2 style="margin-top:0;font-size:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px">
                    Cores do Site
                    <span style="font-size:12px;font-weight:400;color:#94a3b8;margin-left:8px">Altere e clique em Salvar — o site atualiza automaticamente</span>
                </h2>
                <table class="form-table" style="margin-top:0">
                    <tr>
                        <th style="width:220px">Cor Principal (botões, links)</th>
                        <td>
                            <input type="text" name="trimed_color_primary" class="trimed-color-picker" value="<?php echo esc_attr($clr_primary); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#00B573" data-target="trimed_color_primary" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Cor Escura (gradientes, hover)</th>
                        <td>
                            <input type="text" name="trimed_color_primary_dark" class="trimed-color-picker" value="<?php echo esc_attr($clr_primary_dark); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#1A3D2B" data-target="trimed_color_primary_dark" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Fundo do Site</th>
                        <td>
                            <input type="text" name="trimed_color_bg" class="trimed-color-picker" value="<?php echo esc_attr($clr_bg); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#F8FAF9" data-target="trimed_color_bg" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Fundo Alternativo (seções)</th>
                        <td>
                            <input type="text" name="trimed_color_bg_alt" class="trimed-color-picker" value="<?php echo esc_attr($clr_bg_alt); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#EEF5F1" data-target="trimed_color_bg_alt" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Cor do Texto Principal</th>
                        <td>
                            <input type="text" name="trimed_color_text" class="trimed-color-picker" value="<?php echo esc_attr($clr_text); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#0D1F17" data-target="trimed_color_text" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Texto dos Botões</th>
                        <td>
                            <input type="text" name="trimed_color_btn_text" class="trimed-color-picker" value="<?php echo esc_attr($clr_btn_text); ?>">
                            <button type="button" class="button button-small trimed-reset-color" data-default="#ffffff" data-target="trimed_color_btn_text" style="margin-left:8px">Reset</button>
                        </td>
                    </tr>
                </table>
                <p style="margin:12px 0 0;padding:12px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:6px;font-size:13px;color:#166534">
                    Clique em <strong>Reset</strong> ao lado de qualquer cor para voltar ao padrão original da Trimed.
                </p>
            </div>

            <p style="margin-top:20px"><?php submit_button('Salvar Configurações', 'primary', 'submit', false); ?></p>
        </form>
    </div>

    <style>
    .trimed-upload-preview img { display:block; }
    .wp-picker-container { display:inline-flex; align-items:center; gap:6px; }
    </style>
    <script>
    jQuery(function($){
        $('.trimed-color-picker').wpColorPicker();
        $('.trimed-reset-color').on('click', function(){
            var def    = $(this).data('default');
            var target = $(this).data('target');
            var $input = $('input[name="' + target + '"]');
            $input.val(def).trigger('change');
            $input.wpColorPicker('color', def);
        });
    });
    </script>
    <?php
}

// ── Helper: reusable image upload field ──────────────────────────────────────
function trimed_image_field($field_name, $attachment_id, $preview_url, $description = '') {
    ?>
    <div class="trimed-image-upload" data-field="<?php echo esc_attr($field_name); ?>">
        <input type="hidden" name="<?php echo esc_attr($field_name); ?>" id="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr($attachment_id); ?>">
        <div class="trimed-upload-preview" style="margin-bottom:8px">
            <?php if ($preview_url): ?>
                <img src="<?php echo esc_url($preview_url); ?>" style="max-height:80px;max-width:240px;object-fit:contain;border:1px solid #e2e8f0;border-radius:4px;padding:4px;background:#f8f8f8">
            <?php else: ?>
                <span style="display:inline-block;padding:12px 16px;background:#f8faff;border:1px dashed #d0d5dd;border-radius:4px;color:#94a3b8;font-size:13px">Nenhuma imagem selecionada</span>
            <?php endif; ?>
        </div>
        <button type="button" class="button trimed-upload-btn" data-target="<?php echo esc_attr($field_name); ?>">
            <?php echo $attachment_id ? 'Trocar imagem' : 'Selecionar imagem'; ?>
        </button>
        <?php if ($attachment_id): ?>
            <button type="button" class="button trimed-remove-btn" data-target="<?php echo esc_attr($field_name); ?>" style="margin-left:4px;color:#dc2626;border-color:#dc2626">Remover</button>
        <?php endif; ?>
        <?php if ($description): ?>
            <p class="description" style="margin-top:4px"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
    </div>
    <?php
}
