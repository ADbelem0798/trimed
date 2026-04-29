<?php
defined('ABSPATH') || exit;

define('TRIMED_LOCK_USER', 'admin');
define('TRIMED_LOCK_PASS', 'Trimed@2026');
define('TRIMED_LOCK_COOKIE', 'trimed_preview_access');
define('TRIMED_LOCK_COOKIE_TTL', 60 * 10); // 10 minutos

function trimed_site_lock() {
    // Nunca bloquear o admin do WordPress
    if (is_admin()) return;
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/wp-login.php') !== false) return;
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/wp-cron.php') !== false) return;

    // Usuários logados no WordPress passam direto
    if (is_user_logged_in()) return;

    // Verificar cookie de acesso
    $cookie_val = $_COOKIE[TRIMED_LOCK_COOKIE] ?? '';
    if (hash_equals(trimed_lock_token(), $cookie_val)) return;

    // Processar envio do formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trimed_lock_submit'])) {
        $user = trim($_POST['trimed_lock_user'] ?? '');
        $pass = trim($_POST['trimed_lock_pass'] ?? '');

        if ($user === TRIMED_LOCK_USER && $pass === TRIMED_LOCK_PASS) {
            setcookie(
                TRIMED_LOCK_COOKIE,
                trimed_lock_token(),
                time() + TRIMED_LOCK_COOKIE_TTL,
                '/',
                '',
                false,
                true
            );
            wp_redirect($_SERVER['REQUEST_URI']);
            exit;
        }

        trimed_lock_render(true);
        exit;
    }

    trimed_lock_render(false);
    exit;
}
add_action('template_redirect', 'trimed_site_lock', 1);

function trimed_lock_token() {
    return hash_hmac('sha256', TRIMED_LOCK_USER . TRIMED_LOCK_PASS, wp_salt('auth'));
}

function trimed_lock_render($error = false) {
    $error_msg = $error ? 'Usuário ou senha incorretos.' : '';
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acesso Restrito — Trimed</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #0d1117;
      font-family: -apple-system, BlinkMacSystemFont, 'Inter', sans-serif;
      padding: 20px;
    }

    .lock-card {
      background: #161b22;
      border: 1px solid #21262d;
      border-radius: 16px;
      padding: 48px 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 24px 64px rgba(0,0,0,.6);
    }

    .lock-logo {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 14px;
      margin-bottom: 32px;
    }

    .lock-logo img {
      width: 140px;
      height: auto;
      object-fit: contain;
      border-radius: 12px;
    }

    .lock-logo__sub {
      font-size: 12px;
      color: #8b949e;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    .lock-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(0,181,115,.12);
      border: 1px solid rgba(0,181,115,.25);
      border-radius: 99px;
      padding: 4px 12px;
      font-size: 11px;
      font-weight: 600;
      color: #00B573;
      letter-spacing: .06em;
      text-transform: uppercase;
      margin-bottom: 28px;
    }

    .lock-badge::before {
      content: '';
      width: 6px;
      height: 6px;
      background: #00B573;
      border-radius: 50%;
    }

    label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #8b949e;
      margin-bottom: 6px;
      letter-spacing: .03em;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      background: #0d1117;
      border: 1px solid #30363d;
      border-radius: 8px;
      padding: 11px 14px;
      font-size: 14px;
      color: #f0f6fc;
      outline: none;
      transition: border-color .2s;
      margin-bottom: 16px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #00B573;
      box-shadow: 0 0 0 3px rgba(0,181,115,.15);
    }

    .lock-error {
      background: rgba(239,68,68,.1);
      border: 1px solid rgba(239,68,68,.3);
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 13px;
      color: #f87171;
      margin-bottom: 16px;
      text-align: center;
    }

    button[type="submit"] {
      width: 100%;
      background: #00B573;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: background .2s, transform .1s;
      margin-top: 4px;
    }

    button[type="submit"]:hover { background: #009960; }
    button[type="submit"]:active { transform: scale(.98); }

    .lock-footer {
      margin-top: 28px;
      text-align: center;
      font-size: 12px;
      color: #484f58;
    }
  </style>
</head>
<body>
  <div class="lock-card">
    <div class="lock-logo">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/motion-agencia.png" alt="Motion Agencia">
      <span class="lock-logo__sub">Prévia do projeto</span>
    </div>

    <div style="display:flex;justify-content:center">
      <span class="lock-badge">Acesso restrito</span>
    </div>

    <form method="post" autocomplete="off">
      <?php if ($error_msg): ?>
        <div class="lock-error"><?php echo esc_html($error_msg); ?></div>
      <?php endif; ?>

      <label for="trimed_lock_user">Usuário</label>
      <input type="text" id="trimed_lock_user" name="trimed_lock_user" placeholder="Digite seu usuário" autofocus>

      <label for="trimed_lock_pass">Senha</label>
      <input type="password" id="trimed_lock_pass" name="trimed_lock_pass" placeholder="••••••••">

      <input type="hidden" name="trimed_lock_submit" value="1">
      <button type="submit">Entrar</button>
    </form>

    <p class="lock-footer">Desenvolvido por Motion Agencia · <?php echo date('Y'); ?></p>
  </div>
</body>
</html>
    <?php
}

// Rota de logout: /wp-json/trimed/v1/lock-logout
function trimed_lock_logout() {
    setcookie(TRIMED_LOCK_COOKIE, '', time() - 3600, '/', '', false, true);
    wp_redirect(home_url('/'));
    exit;
}
add_action('wp_ajax_nopriv_trimed_lock_logout', 'trimed_lock_logout');
add_action('wp_ajax_trimed_lock_logout', 'trimed_lock_logout');
