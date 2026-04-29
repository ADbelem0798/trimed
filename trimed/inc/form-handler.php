<?php
defined('ABSPATH') || exit;

// ── Helper: build WhatsApp URL ────────────────────────────────────────────────
function trimed_build_wa_url($text) {
    $number = preg_replace('/\D/', '', get_option('trimed_whatsapp_number', '5591988144786'));
    return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
}

// ── Contact form ──────────────────────────────────────────────────────────────

add_action('wp_ajax_trimed_contato', 'trimed_handle_contato');
add_action('wp_ajax_nopriv_trimed_contato', 'trimed_handle_contato');

function trimed_handle_contato() {
    check_ajax_referer('trimed_form_nonce', 'nonce');

    $nome     = sanitize_text_field($_POST['nome'] ?? '');
    $empresa  = sanitize_text_field($_POST['empresa'] ?? '');
    $telefone = sanitize_text_field($_POST['telefone'] ?? '');
    $email    = sanitize_email($_POST['email'] ?? '');
    $produto  = sanitize_text_field($_POST['produto'] ?? '');
    $mensagem = sanitize_textarea_field($_POST['mensagem'] ?? '');

    $errors = [];
    if (empty($nome))     $errors[] = 'Nome é obrigatório.';
    if (empty($empresa))  $errors[] = 'Empresa é obrigatória.';
    if (empty($telefone)) $errors[] = 'Telefone é obrigatório.';

    if (!empty($errors)) {
        wp_send_json_error(['message' => implode(' ', $errors)]);
    }

    // Build WhatsApp message
    $wa_text  = "*Novo contato via site — Trimed*\n\n";
    $wa_text .= "👤 *Nome:* {$nome}\n";
    $wa_text .= "🏥 *Empresa/Hospital:* {$empresa}\n";
    $wa_text .= "📱 *Telefone:* {$telefone}\n";
    if ($email)   $wa_text .= "📧 *E-mail:* {$email}\n";
    if ($produto) $wa_text .= "📦 *Produto de interesse:* {$produto}\n";
    if ($mensagem) $wa_text .= "\n💬 *Mensagem:*\n{$mensagem}\n";

    $wa_url = trimed_build_wa_url($wa_text);

    // Also try e-mail (won't work locally but works in production)
    $admin_email = get_option('trimed_contact_email') ?: get_option('admin_email');
    $headers     = ['Content-Type: text/plain; charset=UTF-8'];
    if ($email)  $headers[] = "Reply-To: {$nome} <{$email}>";
    wp_mail($admin_email, "Novo contato — {$nome}", strip_tags(str_replace('*', '', $wa_text)), $headers);

    wp_send_json_success([
        'message' => 'Dados recebidos! Abrindo WhatsApp para confirmar o envio...',
        'wa_url'  => $wa_url,
    ]);
}

// ── Quote (orçamento) form ────────────────────────────────────────────────────

add_action('wp_ajax_trimed_orcamento', 'trimed_handle_orcamento');
add_action('wp_ajax_nopriv_trimed_orcamento', 'trimed_handle_orcamento');

function trimed_handle_orcamento() {
    check_ajax_referer('trimed_form_nonce', 'nonce');

    $nome         = sanitize_text_field($_POST['nome'] ?? '');
    $cargo        = sanitize_text_field($_POST['cargo'] ?? '');
    $empresa      = sanitize_text_field($_POST['empresa'] ?? '');
    $cnpj         = sanitize_text_field($_POST['cnpj'] ?? '');
    $telefone     = sanitize_text_field($_POST['telefone'] ?? '');
    $email        = sanitize_email($_POST['email'] ?? '');
    $cidade       = sanitize_text_field($_POST['cidade'] ?? '');
    $produtos_arr = array_map('sanitize_text_field', (array)($_POST['produtos'] ?? []));
    $produtos     = implode(', ', $produtos_arr);
    $quantidade   = sanitize_text_field($_POST['quantidade'] ?? '');
    $frequencia   = sanitize_text_field($_POST['frequencia'] ?? '');
    $observacoes  = sanitize_textarea_field($_POST['observacoes'] ?? '');

    $errors = [];
    if (empty($nome))     $errors[] = 'Nome é obrigatório.';
    if (empty($empresa))  $errors[] = 'Empresa é obrigatória.';
    if (empty($telefone)) $errors[] = 'Telefone é obrigatório.';
    if (empty($email))    $errors[] = 'E-mail é obrigatório.';

    if (!empty($errors)) {
        wp_send_json_error(['message' => implode(' ', $errors)]);
    }

    // Build WhatsApp message
    $wa_text  = "*Solicitação de Orçamento — Trimed*\n\n";
    $wa_text .= "👤 *Nome:* {$nome}\n";
    if ($cargo)   $wa_text .= "💼 *Cargo:* {$cargo}\n";
    $wa_text .= "🏥 *Hospital/Empresa:* {$empresa}\n";
    if ($cnpj)    $wa_text .= "📋 *CNPJ:* {$cnpj}\n";
    $wa_text .= "📱 *Telefone:* {$telefone}\n";
    $wa_text .= "📧 *E-mail:* {$email}\n";
    if ($cidade)  $wa_text .= "📍 *Cidade/Estado:* {$cidade}\n";
    if ($produtos) $wa_text .= "\n📦 *Produtos de interesse:* {$produtos}\n";
    if ($quantidade) $wa_text .= "🔢 *Quantidade estimada:* {$quantidade}\n";
    if ($frequencia) $wa_text .= "🔄 *Frequência de compra:* {$frequencia}\n";
    if ($observacoes) $wa_text .= "\n📝 *Observações:*\n{$observacoes}\n";

    $wa_url = trimed_build_wa_url($wa_text);

    // Also try e-mail
    $admin_email = get_option('trimed_contact_email') ?: get_option('admin_email');
    $headers     = ['Content-Type: text/plain; charset=UTF-8'];
    if ($email)  $headers[] = "Reply-To: {$nome} <{$email}>";
    wp_mail($admin_email, "Novo orçamento — {$empresa}", strip_tags(str_replace('*', '', $wa_text)), $headers);

    wp_send_json_success([
        'message' => 'Dados recebidos! Abrindo WhatsApp para confirmar o envio...',
        'wa_url'  => $wa_url,
    ]);
}
