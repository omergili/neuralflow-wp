<?php
/**
 * Plugin Name: NeuralFlow AI Act Badge
 * Plugin URI: https://neuralflow.mylurch.com
 * Description: AI transparency badge for EU AI Act Article 50 compliance. Adds a visible badge, JSON-LD metadata, and meta tags to your website. Zero cookies. Zero tracking. 4.8 KB.
 * Version: 1.1.0
 * Author: NeuralFlow (Olaf Mergili)
 * Author URI: https://mylurch.com
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: neuralflow-ai-act
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Tested up to: 6.7
 *
 * This plugin is built and operated by AI (Claude Opus 4.6).
 * Owner: Olaf Mergili. No human support.
 * Community support: https://github.com/omergili/neuralflow/discussions
 */

if (!defined('ABSPATH')) {
    exit;
}

define('NFAIACT_VERSION', '1.1.0');
define('NFAIACT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NFAIACT_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Register settings page
 */
function nfaiact_admin_menu() {
    add_options_page(
        __('AI Act Badge', 'neuralflow-ai-act'),
        __('AI Act Badge', 'neuralflow-ai-act'),
        'manage_options',
        'neuralflow-ai-act',
        'nfaiact_settings_page'
    );
}
add_action('admin_menu', 'nfaiact_admin_menu');

/**
 * Register settings
 */
function nfaiact_register_settings() {
    register_setting('nfaiact_settings', 'nfaiact_operator', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => get_bloginfo('name'),
    ]);
    register_setting('nfaiact_settings', 'nfaiact_ai_system', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ]);
    register_setting('nfaiact_settings', 'nfaiact_lang', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'de',
    ]);
    register_setting('nfaiact_settings', 'nfaiact_position', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'bottom-right',
    ]);
    register_setting('nfaiact_settings', 'nfaiact_enabled', [
        'type' => 'boolean',
        'sanitize_callback' => function ($value) {
            return (bool) $value;
        },
        'default' => true,
    ]);
}
add_action('admin_init', 'nfaiact_register_settings');

/**
 * Settings page HTML
 */
function nfaiact_settings_page() {
    $operator = get_option('nfaiact_operator', get_bloginfo('name'));
    $ai_system = get_option('nfaiact_ai_system', '');
    $lang = get_option('nfaiact_lang', 'de');
    $position = get_option('nfaiact_position', 'bottom-right');
    $enabled = get_option('nfaiact_enabled', true);
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('AI Act Transparency Badge', 'neuralflow-ai-act'); ?></h1>
        <p><?php esc_html_e('EU AI Act Article 50 requires AI-generated content to be labeled. This plugin adds a visible badge and machine-readable metadata to your website.', 'neuralflow-ai-act'); ?></p>

        <div style="background:#fff3cd;border:1px solid #ffc107;padding:12px 16px;border-radius:6px;margin:16px 0">
            <strong>⚠️ <?php esc_html_e('Enforcement starts August 2, 2026.', 'neuralflow-ai-act'); ?></strong>
            <?php esc_html_e('Penalty: up to EUR 15 million or 3% of annual global turnover.', 'neuralflow-ai-act'); ?>
        </div>

        <form method="post" action="options.php">
            <?php settings_fields('nfaiact_settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="nfaiact_enabled"><?php esc_html_e('Badge active', 'neuralflow-ai-act'); ?></label></th>
                    <td>
                        <input type="checkbox" id="nfaiact_enabled" name="nfaiact_enabled" value="1" <?php checked($enabled); ?>>
                        <p class="description"><?php esc_html_e('Enable or disable the badge on your website.', 'neuralflow-ai-act'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_operator"><?php esc_html_e('Operator (your company name)', 'neuralflow-ai-act'); ?></label></th>
                    <td>
                        <input type="text" id="nfaiact_operator" name="nfaiact_operator" value="<?php echo esc_attr($operator); ?>" class="regular-text" required>
                        <p class="description"><?php esc_html_e('The organization operating the AI system. Shown in the disclosure.', 'neuralflow-ai-act'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_ai_system"><?php esc_html_e('AI System', 'neuralflow-ai-act'); ?></label></th>
                    <td>
                        <input type="text" id="nfaiact_ai_system" name="nfaiact_ai_system" value="<?php echo esc_attr($ai_system); ?>" class="regular-text" required placeholder="z.B. ChatGPT, Claude, Midjourney">
                        <p class="description"><?php esc_html_e('Name of the AI system used. Multiple systems: separate with comma.', 'neuralflow-ai-act'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_lang"><?php esc_html_e('Language', 'neuralflow-ai-act'); ?></label></th>
                    <td>
                        <select id="nfaiact_lang" name="nfaiact_lang">
                            <option value="de" <?php selected($lang, 'de'); ?>>Deutsch</option>
                            <option value="en" <?php selected($lang, 'en'); ?>>English</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_position"><?php esc_html_e('Badge Position', 'neuralflow-ai-act'); ?></label></th>
                    <td>
                        <select id="nfaiact_position" name="nfaiact_position">
                            <option value="bottom-right" <?php selected($position, 'bottom-right'); ?>>↘ Bottom Right</option>
                            <option value="bottom-left" <?php selected($position, 'bottom-left'); ?>>↙ Bottom Left</option>
                            <option value="top-right" <?php selected($position, 'top-right'); ?>>↗ Top Right</option>
                            <option value="top-left" <?php selected($position, 'top-left'); ?>>↖ Top Left</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(__('Save Settings', 'neuralflow-ai-act')); ?>
        </form>

        <hr>
        <h2><?php esc_html_e('Preview', 'neuralflow-ai-act'); ?></h2>
        <p><?php esc_html_e('The badge will appear on all pages of your website. Click it to see the full disclosure.', 'neuralflow-ai-act'); ?></p>
        <p><strong><?php esc_html_e('What it adds:', 'neuralflow-ai-act'); ?></strong></p>
        <ul style="list-style:disc;padding-left:20px">
            <li><?php esc_html_e('Visible "AI Transparent" / "KI-Transparent" badge', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('Disclosure popup on click', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('JSON-LD metadata (schema.org) in <head>', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('HTML meta tags: ai-generated, ai-system, ai-operator', 'neuralflow-ai-act'); ?></li>
        </ul>
        <p><strong><?php esc_html_e('What it does NOT do:', 'neuralflow-ai-act'); ?></strong></p>
        <ul style="list-style:disc;padding-left:20px">
            <li><?php esc_html_e('No cookies', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('No tracking', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('No external requests (badge is served from jsDelivr CDN)', 'neuralflow-ai-act'); ?></li>
            <li><?php esc_html_e('No personal data collection', 'neuralflow-ai-act'); ?></li>
        </ul>

        <hr>
        <p style="color:#666;font-size:0.9em">
            NeuralFlow AI Act Badge v<?php echo esc_html(NFAIACT_VERSION); ?> ·
            <a href="https://github.com/omergili/neuralflow" target="_blank">GitHub</a> ·
            <a href="https://neuralflow.mylurch.com" target="_blank">Documentation</a> ·
            MIT License ·
            <?php esc_html_e('Built by AI (Claude Opus 4.6). Owner: Olaf Mergili.', 'neuralflow-ai-act'); ?>
        </p>
    </div>
    <?php
}

/**
 * Inject badge script in frontend
 */
function nfaiact_inject_badge() {
    if (is_admin()) {
        return;
    }

    $enabled = get_option('nfaiact_enabled', true);
    if (!$enabled) {
        return;
    }

    $operator = get_option('nfaiact_operator', get_bloginfo('name'));
    $ai_system = get_option('nfaiact_ai_system', '');

    if (empty($operator) || empty($ai_system)) {
        return;
    }

    $lang = get_option('nfaiact_lang', 'de');
    $position = get_option('nfaiact_position', 'bottom-right');

    // Direct script output in footer — avoids WordPress defer/async issues
    // data-no-meta="1" prevents duplicate metadata (already injected server-side in wp_head)
    add_action('wp_footer', function () use ($operator, $ai_system, $lang, $position) {
        printf(
            '<script src="%s" data-operator="%s" data-ai-system="%s" data-lang="%s" data-position="%s" data-no-meta="1"></script>' . "\n",
            'https://cdn.jsdelivr.net/npm/@neuralflow/ai-act/dist/badge.min.js',
            esc_attr($operator),
            esc_attr($ai_system),
            esc_attr($lang),
            esc_attr($position)
        );
    }, 99);
}
add_action('wp_enqueue_scripts', 'nfaiact_inject_badge');

/**
 * Inject JSON-LD and meta tags in <head> (server-side for SEO)
 */
function nfaiact_inject_metadata() {
    if (is_admin()) {
        return;
    }

    $enabled = get_option('nfaiact_enabled', true);
    if (!$enabled) {
        return;
    }

    $operator = get_option('nfaiact_operator', get_bloginfo('name'));
    $ai_system = get_option('nfaiact_ai_system', '');

    if (empty($operator) || empty($ai_system)) {
        return;
    }

    // Meta tags
    echo '<meta name="ai-generated" content="true">' . "\n";
    echo '<meta name="ai-system" content="' . esc_attr($ai_system) . '">' . "\n";
    echo '<meta name="ai-operator" content="' . esc_attr($operator) . '">' . "\n";

    // JSON-LD
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'CreativeWork',
        'publisher' => [
            '@type' => 'Organization',
            'name' => $operator,
        ],
        'instrument' => [
            '@type' => 'SoftwareApplication',
            'name' => $ai_system,
            'applicationCategory' => 'Artificial Intelligence',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'nfaiact_inject_metadata');

/**
 * Add settings link on plugins page
 */
function nfaiact_plugin_action_links($links) {
    $settings_link = '<a href="' . admin_url('options-general.php?page=neuralflow-ai-act') . '">' . __('Settings', 'neuralflow-ai-act') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'nfaiact_plugin_action_links');

/**
 * Set defaults on activation
 */
function nfaiact_activate() {
    if (!get_option('nfaiact_operator')) {
        update_option('nfaiact_operator', get_bloginfo('name'));
    }
    if (!get_option('nfaiact_lang')) {
        update_option('nfaiact_lang', substr(get_locale(), 0, 2) === 'de' ? 'de' : 'en');
    }
}
register_activation_hook(__FILE__, 'nfaiact_activate');
