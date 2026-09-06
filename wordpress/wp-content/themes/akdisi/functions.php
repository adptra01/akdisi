<?php
/**
 * Theme Functions - AKDISI
 *
 * @package AKDISI
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function akdisi_setup(): void
{
    // Translation
    load_theme_textdomain('akdisi', get_template_directory() . '/languages');

    // Title tag
    add_theme_support('title-tag');

    // Post thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(600, 400, true);
    add_image_size('akdisi-portfolio', 800, 600, true);
    add_image_size('akdisi-hero', 1200, 600, true);

    // Menus
    register_nav_menus([
        'primary'   => __('Primary Menu', 'akdisi'),
        'footer'    => __('Footer Menu', 'akdisi'),
    ]);

    // HTML5 support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Custom logo
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Disable custom colors in block editor (brand consistency)
    add_theme_support('disable-custom-colors');

    // Disable custom font sizes
    add_theme_support('disable-custom-font-sizes');

    // Align wide
    add_theme_support('align-wide');

    // Responsive embeds
    add_theme_support('responsive-embeds');

    // Block styles
    add_theme_support('wp-block-styles');

    // Editor styles
    add_editor_style(['style.css']);
}

add_action('after_setup_theme', 'akdisi_setup');

/**
 * Enqueue Scripts & Styles
 */
function akdisi_enqueue_assets(): void
{
    // Fonts v2.0: Satoshi (display, Fontshare) + Outfit (body) + Space Grotesk (accent) + JetBrains Mono (mono)
    wp_enqueue_style(
        'akdisi-fonts-display',
        'https://api.fontshare.com/v2/css?f[]=satoshi@300,400,500,700,900&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'akdisi-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
        ['akdisi-fonts-display'],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'akdisi-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme()->get('Version')
    );

    // GSAP + ScrollTrigger (v1.3.0 motion) — deferred, CDN
    wp_enqueue_script(
        'gsap-core',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
        [],
        '3.12.5',
        true
    );
    wp_enqueue_script(
        'gsap-st',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
        ['gsap-core'],
        '3.12.5',
        true
    );

    // Main JavaScript (deferred, after GSAP)
    wp_enqueue_script(
        'akdisi-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['gsap-core', 'gsap-st'],
        '2.0.0',
        true
    );

    // Localize script for AJAX
    wp_localize_script('akdisi-main', 'akdisiData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('akdisi_nonce'),
        'siteUrl' => home_url(),
        'ga4Id'   => get_theme_mod('akdisi_ga4_id', ''),
        'sending' => __('Mengirim...', 'akdisi'),
        'loading' => __('Memuat...', 'akdisi'),
        'submitText' => __('Kirim Pesan', 'akdisi'),
    ]);
}

add_action('wp_enqueue_scripts', 'akdisi_enqueue_assets');

/**
 * Body class: dark header on hero pages, light header elsewhere.
 */
function akdisi_body_class_dark_header( array $classes ): array
{
    $is_dark_header = is_front_page() || is_page_template( 'template-booth.php' ) || is_404();
    if ( ! $is_dark_header ) {
        $classes[] = 'header-light';
    }
    return $classes;
}
add_filter( 'body_class', 'akdisi_body_class_dark_header' );

/**
 * Register Widget Areas
 */
function akdisi_widgets_init(): void
{
    register_sidebar([
        'name'          => __('Sidebar', 'akdisi'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar widget area', 'akdisi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Column 1', 'akdisi'),
        'id'            => 'footer-1',
        'description'   => __('First footer column', 'akdisi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Footer Column 2', 'akdisi'),
        'id'            => 'footer-2',
        'description'   => __('Second footer column', 'akdisi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Footer Column 3', 'akdisi'),
        'id'            => 'footer-3',
        'description'   => __('Third footer column', 'akdisi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ]);
}

add_action('widgets_init', 'akdisi_widgets_init');

/**
 * Custom Excerpt Length
 */
function akdisi_excerpt_length(int $length): int
{
    return 25;
}

add_filter('excerpt_length', 'akdisi_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function akdisi_excerpt_more(string $more): string
{
    return '&hellip;';
}

add_filter('excerpt_more', 'akdisi_excerpt_more');

/**
 * Add schema markup to pages
 */
function akdisi_add_schema_markup(): void
{
    if (is_front_page()) {
        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => 'AKAR Digital Solusi',
            'url'      => home_url('/'),
            'description' => 'Custom application development partner — membangun aplikasi dan sistem digital untuk bisnis dan organisasi di berbagai sektor.',
            'address'  => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Jambi',
                'addressRegion'   => 'Jambi',
                'addressCountry'  => 'ID',
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}

add_action('wp_head', 'akdisi_add_schema_markup');

/**
 * On-page SEO: meta description (PRD: unique title, meta description, H1, canonical, URL)
 * Fallback chain: custom field -> excerpt -> site description.
 */
function akdisi_meta_description(): void
{
    if (is_admin()) {
        return;
    }

    $description = '';

    if (is_front_page()) {
        $description = get_theme_mod('akdisi_meta_description', '');
        if ('' === $description) {
            $description = get_bloginfo('description');
        }
    } elseif (is_singular()) {
        $custom = get_post_meta(get_the_ID(), '_akdisi_meta_description', true);
        if ($custom) {
            $description = $custom;
        } else {
            $post       = get_post();
            $excerpt    = $post && $post->post_excerpt ? $post->post_excerpt : wp_trim_words(wp_strip_all_tags((string) ($post->post_content ?? '')), 30);
            $description = $excerpt;
        }
    } elseif (is_category() || is_tax()) {
        $description = term_description();
    }

    if ($description) {
        $description = trim(preg_replace('/\s+/', ' ', strip_tags((string) $description)));
        echo '<meta name="description" content="' . esc_attr(mb_substr($description, 0, 160)) . '">' . "\n";
    }
}

add_action('wp_head', 'akdisi_meta_description', 3);

/**
 * On-page SEO: Open Graph tags (PRD: Open Graph)
 */
function akdisi_open_graph_tags(): void
{
    if (is_admin()) {
        return;
    }

    $og_type = is_front_page() ? 'website' : 'article';

    if (is_singular()) {
        $og_url = get_permalink();
    } elseif (is_front_page()) {
        $og_url = home_url('/');
    } else {
        $og_url = home_url($GLOBALS['wp']->request ?? '');
    }
    $og_title = wp_get_document_title();

    echo "\n<!-- Open Graph -->\n";
    echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">' . "\n";

    if (is_singular() && has_post_thumbnail()) {
        echo '<meta property="og:image" content="' . esc_url((string) get_the_post_thumbnail_url(null, 'akdisi-hero')) . '">' . "\n";
    }

    echo "<!-- /Open Graph -->\n";
}

add_action('wp_head', 'akdisi_open_graph_tags', 4);

/**
 * GA4 Analytics (PRD §91-92) — render only when theme mod akdisi_ga4_id is set.
 */
function akdisi_google_analytics(): void
{
    $ga4_id = get_theme_mod('akdisi_ga4_id', '');
    if ('' === $ga4_id || is_admin()) {
        return;
    }
    ?>
<!-- Google Analytics (GA4) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga4_id); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo esc_js($ga4_id); ?>');
</script>
<!-- /Google Analytics (GA4) -->
    <?php
}

add_action('wp_head', 'akdisi_google_analytics', 5);

/**
 * Security: Remove WordPress version
 */
function akdisi_remove_version(): string
{
    return '';
}

add_filter('the_generator', 'akdisi_remove_version');

/**
 * Security: Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Security: Remove RSD link
 */
remove_action('wp_head', 'rsd_link');

/**
 * Security: Remove WLW manifest
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Security: Remove emoji detection
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Security: Remove REST API link for non-authenticated users
 */
function akdisi_restrict_rest_api(): void
{
    if (!is_user_logged_in()) {
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('template_redirect', 'rest_output_link_header', 11);
    }
}

add_action('init', 'akdisi_restrict_rest_api');

/**
 * Disable file editing in admin
 */
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

/**
 * Disable search engines for staging/dev
 * Remove or comment this line when going live
 */
// add_filter('blog_public', '__return_zero');

/**
 * Custom post type: Portfolio
 */
function akdisi_register_portfolio_post_type(): void
{
    $labels = [
        'name'                  => _x('Portfolio', 'Post type general name', 'akdisi'),
        'singular_name'         => _x('Project', 'Post type singular name', 'akdisi'),
        'menu_name'             => _x('Portfolio', 'Admin Menu text', 'akdisi'),
        'name_admin_bar'        => _x('Project', 'Add New on Toolbar', 'akdisi'),
        'add_new'               => __('Add New', 'akdisi'),
        'add_new_item'          => __('Add New Project', 'akdisi'),
        'new_item'              => __('New Project', 'akdisi'),
        'edit_item'             => __('Edit Project', 'akdisi'),
        'view_item'             => __('View Project', 'akdisi'),
        'all_items'             => __('All Projects', 'akdisi'),
        'search_items'          => __('Search Projects', 'akdisi'),
        'not_found'             => __('No projects found.', 'akdisi'),
        'not_found_in_trash'    => __('No projects found in Trash.', 'akdisi'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'portfolio'],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
        'menu_position'      => 20,
    ];

    register_post_type('akdisi_portfolio', $args);
}

add_action('init', 'akdisi_register_portfolio_post_type');

/**
 * Custom taxonomy: Portfolio Category
 */
function akdisi_register_portfolio_taxonomy(): void
{
    $labels = [
        'name'              => _x('Portfolio Categories', 'taxonomy general name', 'akdisi'),
        'singular_name'     => _x('Portfolio Category', 'taxonomy singular name', 'akdisi'),
        'search_items'      => __('Search Categories', 'akdisi'),
        'all_items'         => __('All Categories', 'akdisi'),
        'parent_item'       => __('Parent Category', 'akdisi'),
        'parent_item_colon' => __('Parent Category:', 'akdisi'),
        'edit_item'         => __('Edit Category', 'akdisi'),
        'update_item'       => __('Update Category', 'akdisi'),
        'add_new_item'      => __('Add New Category', 'akdisi'),
        'new_item_name'     => __('New Category Name', 'akdisi'),
        'menu_name'         => __('Categories', 'akdisi'),
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'portfolio-category'],
    ];

    register_taxonomy('portfolio_category', ['akdisi_portfolio'], $args);
}

add_action('init', 'akdisi_register_portfolio_taxonomy');

/**
 * Register portfolio meta fields (PRD §47/§86)
 */
function akdisi_register_portfolio_meta(): void
{
    $fields = [
        '_akdisi_problem'            => 'string',
        '_akdisi_solution'           => 'string',
        '_akdisi_features'           => 'array',
        '_akdisi_outcome'            => 'string',
        '_akdisi_related_service'    => 'integer',
        '_akdisi_related_solution'   => 'string',
        '_akdisi_gallery'            => 'array',
    ];

    foreach ($fields as $key => $type) {
        $args = [
            'type'              => $type,
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => $type === 'array'
                ? 'akdisi_sanitize_meta_array'
                : ($type === 'integer' ? 'absint' : 'sanitize_text_field'),
        ];
        if ($type === 'array') {
            $args['show_in_rest'] = [
                'schema' => [
                    'type'  => 'array',
                    'items' => ['type' => 'string'],
                ],
            ];
        }
        register_post_meta('akdisi_portfolio', $key, $args);
    }
}

function akdisi_sanitize_meta_array($value)
{
    if (!is_array($value)) {
        return [];
    }
    return array_values(array_filter(array_map('sanitize_text_field', $value)));
}

add_action('init', 'akdisi_register_portfolio_meta');

/**
 * Portfolio detail metabox (Problem/Solution/Features/Outcome/Related)
 */
function akdisi_portfolio_metabox(): void
{
    add_meta_box(
        'akdisi_portfolio_details',
        __('Detail Proyek (Problem · Solution · Hasil)', 'akdisi'),
        'akdisi_render_portfolio_metabox',
        'akdisi_portfolio',
        'normal',
        'high'
    );
}

function akdisi_render_portfolio_metabox($post): void
{
    wp_nonce_field('akdisi_portfolio_metabox', 'akdisi_portfolio_metabox_nonce');
    $fields = [
        '_akdisi_problem'          => __('Problem / Latar Belakang', 'akdisi'),
        '_akdisi_solution'         => __('Solusi yang Diberikan', 'akdisi'),
        '_akdisi_outcome'          => __('Hasil / Dampak yang Diharapkan', 'akdisi'),
        '_akdisi_related_service'  => __('ID Halaman Layanan Terkait', 'akdisi'),
        '_akdisi_related_solution' => __('Slug Solusi Terkait (mis. housing)', 'akdisi'),
    ];

    echo '<div style="padding:0.5rem 0;">';
    foreach ($fields as $key => $label) {
        $value = get_post_meta($post->ID, $key, true);
        $is_textarea = in_array($key, ['_akdisi_problem', '_akdisi_solution', '_akdisi_outcome'], true);
        printf(
            '<p><label for="%1$s" style="font-weight:600;display:block;margin-bottom:4px;">%2$s</label>',
            esc_attr($key),
            esc_html($label)
        );
        if ($is_textarea) {
            printf(
                '<textarea id="%1$s" name="%1$s" rows="4" style="width:100%%;">%2$s</textarea></p>',
                esc_attr($key),
                esc_textarea($value)
            );
        } else {
            printf(
                '<input type="text" id="%1$s" name="%1$s" value="%2$s" style="width:100%%;"/></p>',
                esc_attr($key),
                esc_attr($value)
            );
        }
    }

    $features = (array) get_post_meta($post->ID, '_akdisi_features', true);
    echo '<p><label style="font-weight:600;display:block;margin-bottom:4px;">'
        . esc_html__('Fitur Utama (satu per baris)', 'akdisi')
        . '</label><textarea id="_akdisi_features" name="_akdisi_features" rows="5" style="width:100%;">'
        . esc_textarea(implode("\n", $features))
        . '</textarea></p>';
    echo '</div>';
}

function akdisi_save_portfolio_metabox($post_id): void
{
    if (!isset($_POST['akdisi_portfolio_metabox_nonce'])
        || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['akdisi_portfolio_metabox_nonce'])), 'akdisi_portfolio_metabox')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $text_fields = ['_akdisi_problem', '_akdisi_solution', '_akdisi_outcome', '_akdisi_related_solution'];
    foreach ($text_fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field(wp_unslash($_POST[$key])));
        }
    }
    if (isset($_POST['_akdisi_related_service'])) {
        update_post_meta($post_id, '_akdisi_related_service', absint($_POST['_akdisi_related_service']));
    }
    if (isset($_POST['_akdisi_features'])) {
        $lines = preg_split('/\r\n|\r|\n/', sanitize_textarea_field(wp_unslash($_POST['_akdisi_features'])));
        update_post_meta($post_id, '_akdisi_features', array_values(array_filter(array_map('trim', $lines))));
    }
}

add_action('add_meta_boxes', 'akdisi_portfolio_metabox');
add_action('save_post_akdisi_portfolio', 'akdisi_save_portfolio_metabox');

/**
 * Custom post type: Insight (Blog)
 */
function akdisi_register_insight_post_type(): void
{
    $labels = [
        'name'                  => _x('Insights', 'Post type general name', 'akdisi'),
        'singular_name'         => _x('Insight', 'Post type singular name', 'akdisi'),
        'menu_name'             => _x('Insights', 'Admin Menu text', 'akdisi'),
        'name_admin_bar'        => _x('Insight', 'Add New on Toolbar', 'akdisi'),
        'add_new_item'          => __('Add New Insight', 'akdisi'),
        'new_item'              => __('New Insight', 'akdisi'),
        'edit_item'             => __('Edit Insight', 'akdisi'),
        'view_item'             => __('View Insight', 'akdisi'),
        'all_items'             => __('All Insights', 'akdisi'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'insight'],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'comments'],
        'taxonomies'         => ['category'],
        'menu_icon'          => 'dashicons-format-status',
        'show_in_rest'       => true,
        'menu_position'      => 25,
    ];

    register_post_type('akdisi_insight', $args);
}

add_action('init', 'akdisi_register_insight_post_type');

/**
 * Custom post type: FAQ
 */
function akdisi_register_faq_post_type(): void
{
    $labels = [
        'name'               => _x('FAQ', 'Post type general name', 'akdisi'),
        'singular_name'      => _x('FAQ', 'Post type singular name', 'akdisi'),
        'menu_name'          => _x('FAQ', 'Admin Menu text', 'akdisi'),
        'add_new_item'       => __('Add New FAQ', 'akdisi'),
        'new_item'           => __('New FAQ', 'akdisi'),
        'edit_item'          => __('Edit FAQ', 'akdisi'),
        'view_item'          => __('View FAQ', 'akdisi'),
        'all_items'          => __('All FAQs', 'akdisi'),
        'not_found'          => __('No FAQs found.', 'akdisi'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'faq'],
        'supports'           => ['title', 'editor'],
        'menu_icon'          => 'dashicons-editor-help',
        'show_in_rest'       => true,
        'menu_position'      => 30,
    ];

    register_post_type('akdisi_faq', $args);
}

add_action('init', 'akdisi_register_faq_post_type');

/**
 * Custom rewrite endpoint for campaign tracking
 */
function akdisi_add_campaign_endpoint(): void
{
    add_rewrite_endpoint('campaign', EP_ROOT | EP_PAGES);
}

add_action('init', 'akdisi_add_campaign_endpoint');

/**
 * Flush rewrite rules on theme activation
 */
function akdisi_activate_theme(): void
{
    akdisi_register_portfolio_post_type();
    akdisi_register_portfolio_taxonomy();
    akdisi_register_insight_post_type();
    akdisi_register_faq_post_type();
    akdisi_add_campaign_endpoint();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'akdisi_activate_theme');

/**
 * Flush rewrite rules on theme deactivation
 */
function akdisi_deactivate_theme(): void
{
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'akdisi_deactivate_theme');

/**
 * AJAX handler for contact form
 */
function akdisi_handle_contact_form(): void
{
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'akdisi_contact_nonce')) {
        wp_send_json_error(['message' => __('Security check failed.', 'akdisi')], 403);
        return;
    }

    // Sanitize inputs
    $name          = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $organization  = sanitize_text_field(wp_unslash($_POST['organization'] ?? ''));
    $position      = sanitize_text_field(wp_unslash($_POST['position'] ?? ''));
    $whatsapp      = sanitize_text_field(wp_unslash($_POST['whatsapp'] ?? ''));
    $email         = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $org_type      = sanitize_text_field(wp_unslash($_POST['org_type'] ?? ''));
    $need          = sanitize_text_field(wp_unslash($_POST['need'] ?? ''));
    $description   = sanitize_textarea_field(wp_unslash($_POST['description'] ?? ''));
    $campaign      = sanitize_text_field(wp_unslash($_POST['campaign'] ?? ''));

    // Validation (per-field errors, PRD §106)
    $errors = [];
    if (empty($name)) {
        $errors['name'] = __('Nama wajib diisi.', 'akdisi');
    }
    if (empty($whatsapp)) {
        $errors['whatsapp'] = __('Nomor WhatsApp wajib diisi.', 'akdisi');
    } elseif (preg_match('/[^0-9+\-()\s]/', $whatsapp)) {
        $errors['whatsapp'] = __('Format nomor WhatsApp tidak valid.', 'akdisi');
    }
    if ($email && !is_email($email)) {
        $errors['email'] = __('Format email tidak valid.', 'akdisi');
    }
    if (empty($org_type)) {
        $errors['org_type'] = __('Pilih jenis organisasi Anda.', 'akdisi');
    }
    if (empty($need)) {
        $errors['need'] = __('Kebutuhan wajib diisi.', 'akdisi');
    }
    if (empty($description)) {
        $errors['description'] = __('Deskripsikan kebutuhan Anda.', 'akdisi');
    }

    if (!empty($errors)) {
        wp_send_json_error(['errors' => $errors], 422);
        return;
    }

    // Create lead as custom post type or save to options
    $lead_data = [
        'name'          => $name,
        'organization'  => $organization,
        'position'      => $position,
        'whatsapp'      => $whatsapp,
        'email'         => $email,
        'org_type'      => $org_type,
        'need'          => $need,
        'description'   => $description,
        'campaign'      => $campaign,
        'date'          => current_time('mysql'),
    ];

    // Store in options (simple, no custom table needed for MVP)
    $leads = get_option('akdisi_leads', []);
    array_unshift($leads, $lead_data);
    update_option('akdisi_leads', array_slice($leads, 0, 500));

    // Trigger WordPress action for extensibility
    do_action('akdisi_lead_submitted', $lead_data);

    wp_send_json_success(['message' => __('Thank you! We will contact you soon.', 'akdisi')]);
}

add_action('wp_ajax_akdisi_contact', 'akdisi_handle_contact_form');
add_action('wp_ajax_nopriv_akdisi_contact', 'akdisi_handle_contact_form');

/**
 * AJAX handler for portfolio filter
 */
function akdisi_handle_portfolio_filter(): void
{
    $category = sanitize_text_field(wp_unslash($_POST['category'] ?? ''));
    $paged    = max(1, intval($_POST['paged'] ?? 1));

    $args = [
        'post_type'      => 'akdisi_portfolio',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = [
            [
                'taxonomy' => 'portfolio_category',
                'field'    => 'slug',
                'terms'    => $category,
            ],
        ];
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
            $cat_names  = $categories ? wp_list_pluck($categories, 'name') : [];
            $cat_slugs  = $categories ? wp_list_pluck($categories, 'slug') : [];
            ?>
            <a href="<?php the_permalink(); ?>" class="card folio-item" data-categories="<?php echo esc_attr(implode(',', $cat_slugs)); ?>" data-ga-track="cta_click" data-ga-content="portfolio_archive">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('akdisi-portfolio', ['loading' => 'lazy', 'class' => 'card-image']); ?>
                <?php else : ?>
                    <div class="card-image" style="background:var(--bg-surface);display:flex;align-items:center;justify-content:center;color:var(--text-muted);"><?php esc_html_e('No Image', 'akdisi'); ?></div>
                <?php endif; ?>
                <div class="card-body">
                    <?php if (!empty($cat_names)) : ?>
                        <span class="card-category"><?php echo esc_html(implode(', ', $cat_names)); ?></span>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 20)); ?></p>
                    <span class="text-link"><?php _e('Lihat Detail', 'akdisi'); ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p>' . esc_html__('No projects found.', 'akdisi') . '</p>';
    }

    $html = ob_get_clean();

    wp_send_json_success([
        'html'      => $html,
        'max_pages' => $query->max_num_pages,
        'current'   => $paged,
    ]);
}

add_action('wp_ajax_akdisi_portfolio_filter', 'akdisi_handle_portfolio_filter');
add_action('wp_ajax_nopriv_akdisi_portfolio_filter', 'akdisi_handle_portfolio_filter');

/**
 * Dashboard widget for lead count
 */
function akdisi_lead_dashboard_widget(): void
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $leads = get_option('akdisi_leads', []);
    $count = count($leads);

    echo '<div style="padding:10px;">';
    echo '<p style="font-size:24px;font-weight:700;margin:0;">' . esc_html($count) . '</p>';
    echo '<p style="margin:0;color:#6b7280;">' . esc_html__('Total Leads Received', 'akdisi') . '</p>';
    echo '</div>';
}

function akdisi_add_dashboard_widget(): void
{
    wp_add_dashboard_widget('akdisi_leads_widget', 'AKDISI Leads', 'akdisi_lead_dashboard_widget');
}

add_action('wp_dashboard_setup', 'akdisi_add_dashboard_widget');