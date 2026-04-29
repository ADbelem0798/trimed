<?php
defined('ABSPATH') || exit;

// ── Includes ──────────────────────────────────────────────────────────────────
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/form-handler.php';
require_once get_template_directory() . '/inc/admin-settings.php';
// require_once get_template_directory() . '/inc/site-lock.php';

// ── Theme setup ───────────────────────────────────────────────────────────────
function trimed_setup() {
    load_theme_textdomain('trimed', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus([
        'primary' => 'Menu Principal',
        'footer'  => 'Menu Footer',
    ]);

    add_image_size('produto-thumb', 600, 450, true);
    add_image_size('produto-hero', 1200, 800, true);
}
add_action('after_setup_theme', 'trimed_setup');

// ── Enqueue assets ────────────────────────────────────────────────────────────
function trimed_enqueue_assets() {
    $v = wp_get_theme()->get('Version');

    wp_enqueue_style('trimed-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('trimed-main', get_template_directory_uri() . '/assets/css/main.css', ['trimed-fonts'], $v);

    wp_enqueue_script('trimed-main', get_template_directory_uri() . '/assets/js/main.js', [], $v, true);

    wp_localize_script('trimed-main', 'trimedAjax', [
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('trimed_form_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'trimed_enqueue_assets');

// ── SEO / Head meta ───────────────────────────────────────────────────────────
function trimed_head_meta() {
    global $post;

    $title       = get_bloginfo('name') . ' — Produtos Hospitalares';
    $description = 'Distribuidora e fabricante de produtos hospitalares desde 2001. Capas cirúrgicas, cobertores óbito, mantas SMS e muito mais. Atendemos hospitais e clínicas no Norte do Brasil.';
    $url         = home_url('/');
    $image       = get_template_directory_uri() . '/assets/img/og-image.jpg';

    if (is_singular('produto') && $post) {
        $title       = get_the_title($post) . ' — Trimed Produtos Hospitalares';
        $description = wp_trim_words(get_the_excerpt($post), 30, '...');
        $url         = get_permalink($post);
        if (has_post_thumbnail($post)) {
            $image = get_the_post_thumbnail_url($post, 'large');
        }
    } elseif (is_page() && $post) {
        $page_desc = [
            'sobre'    => 'Conheça a história da Trimed — 25 anos fornecendo produtos hospitalares de qualidade para o Norte do Brasil.',
            'produtos' => 'Linha completa de produtos hospitalares com fabricação própria. Capas cirúrgicas, cobertores e muito mais.',
            'contato'  => 'Entre em contato com a Trimed. WhatsApp, telefone e formulário disponíveis.',
            'orcamento'=> 'Solicite um orçamento personalizado para sua instituição de saúde. Resposta em até 24 horas.',
        ];
        $slug = $post->post_name;
        if (isset($page_desc[$slug])) {
            $description = $page_desc[$slug];
        }
        $title = get_the_title($post) . ' — Trimed';
        $url   = get_permalink($post);
    }
    ?>
    <meta name="description" content="<?php echo esc_attr($description); ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($description); ?>">
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta property="og:image" content="<?php echo esc_url($image); ?>">
    <meta property="og:locale" content="pt_BR">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($image); ?>">
    <?php
}
add_action('wp_head', 'trimed_head_meta');

// ── Schema markup ─────────────────────────────────────────────────────────────
function trimed_schema_markup() {
    if (!is_front_page()) return;
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness',
        'name'     => 'Trimed Ltda',
        'url'      => 'https://trimedpa.com.br',
        'logo'     => get_template_directory_uri() . '/assets/img/logo.png',
        'foundingDate' => '2001',
        'description'  => 'Distribuidora e fabricante de produtos hospitalares desde 2001.',
        'address' => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Tv. José do Patrocínio (Conj. A. Queirós), 4',
            'addressLocality' => 'Ananindeua',
            'addressRegion'   => 'PA',
            'addressCountry'  => 'BR',
        ],
        'telephone'  => '+55 91 3014-7418',
        'sameAs'     => ['https://www.instagram.com/trimedpa/'],
        'openingHoursSpecification' => [[
            '@type'    => 'OpeningHoursSpecification',
            'dayOfWeek'=> ['Monday','Tuesday','Wednesday','Thursday','Friday'],
            'opens'    => '08:00',
            'closes'   => '18:00',
        ]],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
}
add_action('wp_head', 'trimed_schema_markup');

// ── Body classes ──────────────────────────────────────────────────────────────
function trimed_body_classes($classes) {
    if (!is_singular()) $classes[] = 'is-archive';
    return $classes;
}
add_filter('body_class', 'trimed_body_classes');

// ── Remove WordPress emoji / bloat ────────────────────────────────────────────
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// ── Nav walker — add active class ─────────────────────────────────────────────
function trimed_nav_walker_args($args, $handle) {
    $args['walker'] = new Trimed_Nav_Walker();
    return $args;
}
add_filter('wp_nav_menu_args', function($args) {
    if (isset($args['theme_location']) && $args['theme_location'] === 'primary') {
        return $args;
    }
    return $args;
});

// ── Custom color overrides ────────────────────────────────────────────────────
function trimed_output_color_vars() {
    $primary      = get_option('trimed_color_primary',      '#00B573');
    $primary_dark = get_option('trimed_color_primary_dark', '#1A3D2B');
    $bg           = get_option('trimed_color_bg',           '#F8FAF9');
    $bg_alt       = get_option('trimed_color_bg_alt',       '#EEF5F1');
    $text         = get_option('trimed_color_text',         '#0D1F17');
    $btn_text     = get_option('trimed_color_btn_text',     '#ffffff');

    // Only output if at least one differs from default
    $defaults = ['#00B573','#1A3D2B','#F8FAF9','#EEF5F1','#0D1F17','#ffffff'];
    $values   = [$primary, $primary_dark, $bg, $bg_alt, $text, $btn_text];
    if ($values === $defaults) return;

    echo "<style id=\"trimed-color-vars\">:root{\n";
    echo "  --clr-primary:"      . esc_attr($primary)      . ";\n";
    echo "  --clr-primary-dark:" . esc_attr($primary_dark) . ";\n";
    echo "  --clr-bg:"           . esc_attr($bg)           . ";\n";
    echo "  --clr-bg-alt:"       . esc_attr($bg_alt)       . ";\n";
    echo "  --clr-text:"         . esc_attr($text)         . ";\n";
    echo "  --clr-white:"        . esc_attr($btn_text)     . ";\n";
    echo "}</style>\n";
}
add_action('wp_head', 'trimed_output_color_vars', 99);

// ── Helpers ───────────────────────────────────────────────────────────────────
function trimed_whatsapp_url($msg = '') {
    $number = get_option('trimed_whatsapp_number', '5591988144786');
    $number = preg_replace('/\D/', '', $number);
    $base   = 'https://wa.me/' . $number;
    if (!empty($msg)) {
        $base .= '?text=' . rawurlencode($msg);
    }
    return $base;
}

function trimed_produto_whatsapp($nome = '') {
    $msg = 'Olá! Tenho interesse no produto: ' . $nome . '. Gostaria de solicitar um orçamento.';
    return trimed_whatsapp_url($msg);
}

// ── Default products seed (only runs once) ────────────────────────────────────
function trimed_seed_produtos() {
    if (get_option('trimed_produtos_seeded')) return;

    $produtos = [
        [
            'title'  => 'Capa Cirúrgica (Avental)',
            'desc'   => 'Avental cirúrgico em TNT SMS com costura reforçada e fechamento posterior. Proteção máxima para profissionais em procedimentos cirúrgicos e de alto risco.',
            'fab'    => '1',
            'cat'    => 'Cirurgia',
            'specs'  => "Material: TNT SMS\nGramatura: 40 g/m²\nFechamento: Tiras de amarração\nCores: Azul, Verde, Branco\nTamanhos: M, G, GG, XGG\nUso: Único (descartável)",
        ],
        [
            'title'  => 'Cobertor Óbito',
            'desc'   => 'Desenvolvido com material resistente e tratado para uso em serviços funerários hospitalares. Design digno e funcional, com alta resistência a fluidos.',
            'fab'    => '1',
            'cat'    => 'Higiene',
            'specs'  => "Material: TNT Spunbond reforçado\nGramatura: 50 g/m²\nDimensões: 120 x 200 cm\nCor: Branco\nResistência: Alta impermeabilidade",
        ],
        [
            'title'  => 'Manta SMS',
            'desc'   => 'Manta hospitalar em SMS de alta gramatura. Combina conforto, higiene e resistência para uso em macas, leitos e procedimentos ambulatoriais.',
            'fab'    => '1',
            'cat'    => 'Higiene',
            'specs'  => "Material: TNT SMS (Spunbond + Meltblown + Spunbond)\nGramatura: 50 g/m²\nDimensões: 80 x 180 cm\nCores: Azul, Verde\nPropiedades: Antialérgica, impermeável",
        ],
        [
            'title'  => 'Touca Cirúrgica',
            'desc'   => 'Touca descartável em TNT com elástico ajustável. Ideal para cirurgias, procedimentos estéreis e ambientes de controle de infecção.',
            'fab'    => '1',
            'cat'    => 'Cirurgia',
            'specs'  => "Material: TNT Spunbond\nGramatura: 20 g/m²\nFechamento: Elástico\nCores: Azul, Verde, Branco\nUso: Único (descartável)",
        ],
        [
            'title'  => 'Propé Descartável',
            'desc'   => 'Protetor de calçado em TNT para ambientes hospitalares e laboratoriais. Antiderrapante, confortável e de fácil colocação.',
            'fab'    => '1',
            'cat'    => 'EPIs',
            'specs'  => "Material: TNT Spunbond\nGramatura: 20 g/m²\nFechamento: Elástico\nCores: Azul, Branco\nTamanho: Único",
        ],
        [
            'title'  => 'Lençol Descartável',
            'desc'   => 'Lençol hospitalar descartável em TNT para uso em macas e leitos. Higiene garantida em cada atendimento.',
            'fab'    => '1',
            'cat'    => 'Higiene',
            'specs'  => "Material: TNT Spunbond\nGramatura: 30 g/m²\nDimensões: 70 x 200 cm\nCores: Branco, Azul\nUso: Único (descartável)",
        ],
        [
            'title'  => 'Campo Cirúrgico',
            'desc'   => 'Campo estéril para delimitação de área cirúrgica. Alta barreira contra contaminação e resistência a fluidos.',
            'fab'    => '1',
            'cat'    => 'Cirurgia',
            'specs'  => "Material: TNT SMS\nGramatura: 45 g/m²\nDimensões: Diversas (sob consulta)\nCor: Azul\nCaracterística: Estéril",
        ],
        [
            'title'  => 'Máscara Cirúrgica',
            'desc'   => 'Máscara tripla camada com elástico ajustável e clipe nasal. Proteção eficaz para profissionais de saúde em ambientes clínicos.',
            'fab'    => '1',
            'cat'    => 'EPIs',
            'specs'  => "Camadas: 3 (TNT + Meltblown + TNT)\nFiltração: ≥95% (BFE)\nFechamento: Elástico auricular\nCor: Azul, Branco, Verde\nUso: Único (descartável)",
        ],
        [
            'title'  => 'Kit Cirúrgico Completo',
            'desc'   => 'Kit completo para procedimentos cirúrgicos contendo avental, campo, touca, máscara e propé. Embalado individualmente de forma estéril.',
            'fab'    => '1',
            'cat'    => 'Cirurgia',
            'specs'  => "Conteúdo: Avental + Campo + Touca + Máscara + Propé\nEmbalagem: Pacote estéril selado\nDisponibilidade: Sob consulta\nPersonalização: Disponível",
        ],
    ];

    foreach ($produtos as $p) {
        $post_id = wp_insert_post([
            'post_title'   => $p['title'],
            'post_content' => $p['desc'],
            'post_excerpt' => $p['desc'],
            'post_status'  => 'publish',
            'post_type'    => 'produto',
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_trimed_fabricacao_propria', $p['fab']);
            update_post_meta($post_id, '_trimed_categoria_badge', $p['cat']);
            update_post_meta($post_id, '_trimed_especificacoes', $p['specs']);
        }
    }

    update_option('trimed_produtos_seeded', true);
}
add_action('after_switch_theme', 'trimed_seed_produtos');

// ── Auto-create required pages ────────────────────────────────────────────────
function trimed_setup_pages() {
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
            if ($id && !is_wp_error($id) && $p['template']) {
                update_post_meta($id, '_wp_page_template', $p['template']);
            }
        } elseif ($p['template']) {
            update_post_meta($exists->ID, '_wp_page_template', $p['template']);
        }
    }

    $front = get_page_by_path('home');
    if ($front) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front->ID);
    }

    flush_rewrite_rules(true);
}
add_action('after_switch_theme', 'trimed_setup_pages');

// ── Run setup on every admin_init until all pages exist ──────────────────────
function trimed_auto_setup() {
    $slugs = ['home', 'sobre', 'produtos', 'contato', 'orcamento'];
    $missing = false;
    foreach ($slugs as $slug) {
        if (!get_page_by_path($slug)) {
            $missing = true;
            break;
        }
    }
    if ($missing) {
        trimed_setup_pages();
    }

    // Garante .htaccess com regras corretas
    $htaccess = ABSPATH . '.htaccess';
    if (!file_exists($htaccess) || strpos(file_get_contents($htaccess), 'RewriteEngine On') === false) {
        $rules  = "# BEGIN WordPress\n";
        $rules .= "<IfModule mod_rewrite.c>\n";
        $rules .= "RewriteEngine On\n";
        $rules .= "RewriteBase /\n";
        $rules .= "RewriteRule ^index\\.php$ - [L]\n";
        $rules .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
        $rules .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
        $rules .= "RewriteRule . /index.php [L]\n";
        $rules .= "</IfModule>\n";
        $rules .= "# END WordPress\n";
        @file_put_contents($htaccess, $rules);
        flush_rewrite_rules(true);
    }
}
add_action('admin_init', 'trimed_auto_setup');
