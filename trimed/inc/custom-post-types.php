<?php
defined('ABSPATH') || exit;

/* ═══════════════════════════════════════════════════════════════
   CPT: Produtos
   ═══════════════════════════════════════════════════════════════ */
function trimed_register_cpt_produto() {
    register_post_type('produto', [
        'labels' => [
            'name'                  => 'Produtos',
            'singular_name'         => 'Produto',
            'menu_name'             => 'Produtos',
            'add_new'               => 'Adicionar Produto',
            'add_new_item'          => 'Adicionar Novo Produto',
            'edit_item'             => 'Editar Produto',
            'view_item'             => 'Ver Produto',
            'search_items'          => 'Buscar Produtos',
            'not_found'             => 'Nenhum produto encontrado.',
            'not_found_in_trash'    => 'Nenhum produto na lixeira.',
            'featured_image'        => 'Foto do Produto',
            'set_featured_image'    => 'Definir foto do produto',
            'remove_featured_image' => 'Remover foto',
            'use_featured_image'    => 'Usar como foto do produto',
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'produto', 'with_front' => false],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => ['title', 'thumbnail', 'excerpt'],
    ]);
}
add_action('init', 'trimed_register_cpt_produto');

/* ═══════════════════════════════════════════════════════════════
   Taxonomia: Categoria do Produto
   ═══════════════════════════════════════════════════════════════ */
function trimed_register_taxonomy_categoria() {
    register_taxonomy('categoria_produto', ['produto'], [
        'labels' => [
            'name'          => 'Categorias',
            'singular_name' => 'Categoria',
            'menu_name'     => 'Categorias',
            'add_new_item'  => 'Adicionar Categoria',
            'new_item_name' => 'Nova Categoria',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'categoria-produto'],
    ]);
}
add_action('init', 'trimed_register_taxonomy_categoria');

/* ═══════════════════════════════════════════════════════════════
   Metaboxes
   ═══════════════════════════════════════════════════════════════ */
function trimed_add_produto_metaboxes() {
    add_meta_box('trimed_produto_desc', 'Descrição do Produto', 'trimed_produto_desc_html', 'produto', 'normal', 'high');
    add_meta_box('trimed_produto_info', 'Categoria & Fabricação', 'trimed_produto_metabox_html', 'produto', 'side', 'default');
}
add_action('add_meta_boxes', 'trimed_add_produto_metaboxes');

function trimed_produto_desc_html($post) {
    wp_nonce_field('trimed_produto_desc_nonce', 'trimed_desc_nonce');
    $desc = get_post_meta($post->ID, '_trimed_descricao', true);
    if (empty($desc)) $desc = $post->post_excerpt;
    ?>
    <textarea name="trimed_descricao" rows="5"
        style="width:100%;font-size:14px;padding:8px;border:1px solid #ddd;border-radius:4px;resize:vertical"
        placeholder="Descreva o produto..."><?php echo esc_textarea($desc); ?></textarea>
    <?php
}

function trimed_produto_metabox_html($post) {
    wp_nonce_field('trimed_produto_metabox', 'trimed_produto_nonce');
    $fab = get_post_meta($post->ID, '_trimed_fabricacao_propria', true);
    $cat = get_post_meta($post->ID, '_trimed_categoria_badge', true);
    ?>
    <p>
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600">
            <input type="checkbox" name="trimed_fabricacao_propria" value="1" <?php checked($fab, '1'); ?>>
            Fabricação Própria
        </label>
    </p>
    <p style="margin-top:12px">
        <label for="trimed_cat" style="display:block;font-weight:600;margin-bottom:4px">Categoria</label>
        <select id="trimed_cat" name="trimed_categoria_badge" style="width:100%">
            <option value="">Selecione...</option>
            <?php foreach (['Cirurgia','Higiene','EPIs','Descartáveis','Diagnóstico'] as $opt): ?>
                <option value="<?php echo esc_attr($opt); ?>" <?php selected($cat, $opt); ?>><?php echo esc_html($opt); ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php
}

function trimed_save_produto_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'produto') return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['trimed_desc_nonce']) && wp_verify_nonce($_POST['trimed_desc_nonce'], 'trimed_produto_desc_nonce')) {
        update_post_meta($post_id, '_trimed_descricao', sanitize_textarea_field($_POST['trimed_descricao'] ?? ''));
    }

    if (isset($_POST['trimed_produto_nonce']) && wp_verify_nonce($_POST['trimed_produto_nonce'], 'trimed_produto_metabox')) {
        update_post_meta($post_id, '_trimed_fabricacao_propria', isset($_POST['trimed_fabricacao_propria']) ? '1' : '0');
        update_post_meta($post_id, '_trimed_categoria_badge', sanitize_text_field($_POST['trimed_categoria_badge'] ?? ''));
    }
}
add_action('save_post', 'trimed_save_produto_meta');
