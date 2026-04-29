<?php
/**
 * Trimed Setup Script
 * Acesse via navegador: seusite.com/wp-content/themes/trimed/setup.php
 * Apague este arquivo após rodar.
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/../../../../');
    require ABSPATH . 'wp-load.php';
}

if (!current_user_can('manage_options') && !defined('WP_CLI')) {
    wp_die('Acesso negado. Faça login como administrador primeiro.');
}

$log = [];

// ── Criar páginas ──────────────────────────────────────────────────────────────
$pages = [
    ['title' => 'Home',      'slug' => 'home',      'template' => ''],
    ['title' => 'Sobre',     'slug' => 'sobre',     'template' => 'page-sobre.php'],
    ['title' => 'Produtos',  'slug' => 'produtos',  'template' => 'page-produtos.php'],
    ['title' => 'Contato',   'slug' => 'contato',   'template' => 'page-contato.php'],
    ['title' => 'Orçamento', 'slug' => 'orcamento', 'template' => 'page-orcamento.php'],
];

foreach ($pages as $p) {
    $exists = get_page_by_path($p['slug']);
    if (!$exists) {
        $id = wp_insert_post([
            'post_title'  => $p['title'],
            'post_name'   => $p['slug'],
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]);
        if ($id && !is_wp_error($id)) {
            if ($p['template']) {
                update_post_meta($id, '_wp_page_template', $p['template']);
            }
            $log[] = "✅ Página criada: {$p['title']} (ID: $id)";
        } else {
            $log[] = "❌ Erro ao criar: {$p['title']}";
        }
    } else {
        if ($p['template']) {
            update_post_meta($exists->ID, '_wp_page_template', $p['template']);
        }
        $log[] = "ℹ️ Já existe: {$p['title']} (ID: {$exists->ID})";
    }
}

// ── Configurar página inicial ──────────────────────────────────────────────────
$front = get_page_by_path('home');
if ($front) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front->ID);
    $log[] = "✅ Página inicial definida: Home (ID: {$front->ID})";
}

// ── Regenerar regras de reescrita ──────────────────────────────────────────────
flush_rewrite_rules(true);
$log[] = "✅ Regras de permalink regeneradas";

// ── Limpar flag de seed para recriar produtos se necessário ───────────────────
// delete_option('trimed_produtos_seeded'); // descomente se quiser recriar produtos

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Trimed Setup</title>
<style>
  body { font-family: -apple-system, sans-serif; background: #0d1117; color: #e6edf3; padding: 40px; }
  h1   { color: #00B573; font-size: 24px; margin-bottom: 24px; }
  ul   { list-style: none; padding: 0; }
  li   { padding: 10px 16px; margin: 6px 0; background: #161b22; border: 1px solid #21262d; border-radius: 8px; font-size: 15px; }
  .warn{ background: #1c1800; border-color: #f0ad00; color: #f0ad00; font-weight: 700; margin-top: 24px; padding: 16px; border-radius: 8px; }
  a    { color: #00B573; }
</style>
</head>
<body>
<h1>Trimed — Setup</h1>
<ul>
  <?php foreach ($log as $line) echo "<li>$line</li>"; ?>
</ul>
<div class="warn">
  ⚠️ Apague este arquivo agora: <code>wp-content/themes/trimed/setup.php</code><br>
  Depois acesse: <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_url(home_url('/')); ?></a>
</div>
</body>
</html>
