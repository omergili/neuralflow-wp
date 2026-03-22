<?php
/**
 * Plugin Name: NeuralFlow AI Act Badge
 * Plugin URI: https://neuralflow.mylurch.com
 * Description: AI transparency badge for EU AI Act Article 50 compliance. Visible badge, JSON-LD metadata, and meta tags. Zero cookies. Zero tracking.
 * Version: 2.0.0
 * Author: NeuralFlow (Olaf Mergili)
 * Author URI: https://mylurch.com
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: neuralflow-ai-act
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Tested up to: 6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'NFAIACT_VERSION', '2.0.0' );
define( 'NFAIACT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NFAIACT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register settings page.
 */
function nfaiact_admin_menu() {
    add_options_page(
        __( 'AI Act Badge', 'neuralflow-ai-act' ),
        __( 'AI Act Badge', 'neuralflow-ai-act' ),
        'manage_options',
        'neuralflow-ai-act',
        'nfaiact_settings_page'
    );
}
add_action( 'admin_menu', 'nfaiact_admin_menu' );

/**
 * Register settings.
 */
function nfaiact_register_settings() {
    register_setting( 'nfaiact_settings', 'nfaiact_operator', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => get_bloginfo( 'name' ),
    ) );
    register_setting( 'nfaiact_settings', 'nfaiact_ai_system', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
    register_setting( 'nfaiact_settings', 'nfaiact_lang', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'de',
    ) );
    register_setting( 'nfaiact_settings', 'nfaiact_position', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'bottom-right',
    ) );
    register_setting( 'nfaiact_settings', 'nfaiact_enabled', array(
        'type'              => 'boolean',
        'sanitize_callback' => 'rest_sanitize_boolean',
        'default'           => true,
    ) );
}
add_action( 'admin_init', 'nfaiact_register_settings' );

/**
 * Settings page HTML.
 */
function nfaiact_settings_page() {
    $operator  = get_option( 'nfaiact_operator', get_bloginfo( 'name' ) );
    $ai_system = get_option( 'nfaiact_ai_system', '' );
    $lang      = get_option( 'nfaiact_lang', 'de' );
    $position  = get_option( 'nfaiact_position', 'bottom-right' );
    $enabled   = get_option( 'nfaiact_enabled', true );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'AI Act Transparency Badge', 'neuralflow-ai-act' ); ?></h1>
        <p><?php esc_html_e( 'EU AI Act Article 50 requires AI-generated content to be labeled. This plugin adds a visible badge and machine-readable metadata to your website.', 'neuralflow-ai-act' ); ?></p>

        <div style="background:#fff3cd;border:1px solid #ffc107;padding:12px 16px;border-radius:6px;margin:16px 0">
            <strong><?php esc_html_e( 'Enforcement starts August 2, 2026.', 'neuralflow-ai-act' ); ?></strong>
            <?php esc_html_e( 'Penalty: up to EUR 15 million or 3% of annual global turnover.', 'neuralflow-ai-act' ); ?>
        </div>

        <form method="post" action="options.php">
            <?php settings_fields( 'nfaiact_settings' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="nfaiact_enabled"><?php esc_html_e( 'Badge active', 'neuralflow-ai-act' ); ?></label></th>
                    <td>
                        <input type="checkbox" id="nfaiact_enabled" name="nfaiact_enabled" value="1" <?php checked( $enabled ); ?>>
                        <p class="description"><?php esc_html_e( 'Enable or disable the badge on your website.', 'neuralflow-ai-act' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_operator"><?php esc_html_e( 'Operator (your company name)', 'neuralflow-ai-act' ); ?></label></th>
                    <td>
                        <input type="text" id="nfaiact_operator" name="nfaiact_operator" value="<?php echo esc_attr( $operator ); ?>" class="regular-text">
                        <p class="description"><?php esc_html_e( 'The organization operating the AI system. Shown in the disclosure.', 'neuralflow-ai-act' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_ai_system"><?php esc_html_e( 'AI System', 'neuralflow-ai-act' ); ?></label></th>
                    <td>
                        <input type="text" id="nfaiact_ai_system" name="nfaiact_ai_system" value="<?php echo esc_attr( $ai_system ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. ChatGPT, Claude, Midjourney', 'neuralflow-ai-act' ); ?>">
                        <p class="description"><?php esc_html_e( 'Name of the AI system used. Multiple systems: separate with comma.', 'neuralflow-ai-act' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_lang"><?php esc_html_e( 'Language', 'neuralflow-ai-act' ); ?></label></th>
                    <td>
                        <select id="nfaiact_lang" name="nfaiact_lang">
                            <option value="de" <?php selected( $lang, 'de' ); ?>>Deutsch</option>
                            <option value="en" <?php selected( $lang, 'en' ); ?>>English</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="nfaiact_position"><?php esc_html_e( 'Badge Position', 'neuralflow-ai-act' ); ?></label></th>
                    <td>
                        <select id="nfaiact_position" name="nfaiact_position">
                            <option value="bottom-right" <?php selected( $position, 'bottom-right' ); ?>>Bottom Right</option>
                            <option value="bottom-left" <?php selected( $position, 'bottom-left' ); ?>>Bottom Left</option>
                            <option value="top-right" <?php selected( $position, 'top-right' ); ?>>Top Right</option>
                            <option value="top-left" <?php selected( $position, 'top-left' ); ?>>Top Left</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button( __( 'Save Settings', 'neuralflow-ai-act' ) ); ?>
        </form>

        <hr>
        <p style="color:#666;font-size:0.9em">
            NeuralFlow AI Act Badge v<?php echo esc_html( NFAIACT_VERSION ); ?> &middot;
            <a href="https://github.com/omergili/neuralflow" target="_blank" rel="noopener">GitHub</a> &middot;
            <a href="https://neuralflow.mylurch.com" target="_blank" rel="noopener"><?php esc_html_e( 'Documentation', 'neuralflow-ai-act' ); ?></a> &middot;
            GPL-2.0-or-later
        </p>
    </div>
    <?php
}

/**
 * Enqueue badge script in frontend.
 */
function nfaiact_enqueue_badge() {
    if ( is_admin() ) {
        return;
    }

    $enabled = get_option( 'nfaiact_enabled', true );
    if ( ! $enabled ) {
        return;
    }

    $operator  = get_option( 'nfaiact_operator', get_bloginfo( 'name' ) );
    $ai_system = get_option( 'nfaiact_ai_system', '' );

    if ( empty( $operator ) || empty( $ai_system ) ) {
        return;
    }

    $lang     = get_option( 'nfaiact_lang', 'de' );
    $position = get_option( 'nfaiact_position', 'bottom-right' );

    // Enqueue local badge script (no external CDN requests).
    wp_enqueue_script(
        'nfaiact-badge',
        NFAIACT_PLUGIN_URL . 'js/badge.min.js',
        array(),
        NFAIACT_VERSION,
        true
    );

    // Pass config via data attributes on the script tag.
    add_filter( 'script_loader_tag', function ( $tag, $handle ) use ( $operator, $ai_system, $lang, $position ) {
        if ( 'nfaiact-badge' !== $handle ) {
            return $tag;
        }
        // Add data attributes and cache-plugin exclusion attributes.
        $attrs = sprintf(
            ' data-operator="%s" data-ai-system="%s" data-lang="%s" data-position="%s" data-no-meta="1" data-no-optimize="1" data-cfasync="false"',
            esc_attr( $operator ),
            esc_attr( $ai_system ),
            esc_attr( $lang ),
            esc_attr( $position )
        );
        return str_replace( ' src=', $attrs . ' src=', $tag );
    }, 10, 2 );

    // Exclude from WP Rocket JS combine/defer.
    add_filter( 'rocket_exclude_defer_js', 'nfaiact_exclude_js' );
    add_filter( 'rocket_exclude_js', 'nfaiact_exclude_js' );
    // Exclude from LiteSpeed Cache JS combine.
    add_filter( 'litespeed_optimize_js_excludes', 'nfaiact_exclude_js' );
}
add_action( 'wp_enqueue_scripts', 'nfaiact_enqueue_badge' );

/**
 * Exclude badge script from cache plugin optimization.
 *
 * @param array $excluded List of excluded scripts.
 * @return array Modified list.
 */
function nfaiact_exclude_js( $excluded ) {
    $excluded[] = 'badge.min.js';
    return $excluded;
}

/**
 * Inject JSON-LD and meta tags in head (server-side for SEO).
 */
function nfaiact_inject_metadata() {
    if ( is_admin() ) {
        return;
    }

    $enabled = get_option( 'nfaiact_enabled', true );
    if ( ! $enabled ) {
        return;
    }

    $operator  = get_option( 'nfaiact_operator', get_bloginfo( 'name' ) );
    $ai_system = get_option( 'nfaiact_ai_system', '' );

    if ( empty( $operator ) || empty( $ai_system ) ) {
        return;
    }

    echo '<meta name="ai-generated" content="true">' . "\n";
    echo '<meta name="ai-system" content="' . esc_attr( $ai_system ) . '">' . "\n";
    echo '<meta name="ai-operator" content="' . esc_attr( $operator ) . '">' . "\n";

    $jsonld = array(
        '@context'  => 'https://schema.org',
        '@type'     => 'CreativeWork',
        'publisher' => array(
            '@type' => 'Organization',
            'name'  => $operator,
        ),
        'instrument' => array(
            '@type'               => 'SoftwareApplication',
            'name'                => $ai_system,
            'applicationCategory' => 'Artificial Intelligence',
        ),
    );
    echo '<script type="application/ld+json">' . wp_json_encode( $jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'nfaiact_inject_metadata' );

/**
 * Add settings link on plugins page.
 *
 * @param array $links Plugin action links.
 * @return array Modified links.
 */
function nfaiact_plugin_action_links( $links ) {
    $settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=neuralflow-ai-act' ) ) . '">' . esc_html__( 'Settings', 'neuralflow-ai-act' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nfaiact_plugin_action_links' );

/**
 * Set defaults on activation.
 */
function nfaiact_activate() {
    if ( ! get_option( 'nfaiact_operator' ) ) {
        update_option( 'nfaiact_operator', get_bloginfo( 'name' ) );
    }
    if ( ! get_option( 'nfaiact_lang' ) ) {
        $locale = substr( get_locale(), 0, 2 );
        update_option( 'nfaiact_lang', 'de' === $locale ? 'de' : 'en' );
    }
}
register_activation_hook( __FILE__, 'nfaiact_activate' );

/**
 * Clean up options on uninstall.
 */
function nfaiact_uninstall() {
    delete_option( 'nfaiact_operator' );
    delete_option( 'nfaiact_ai_system' );
    delete_option( 'nfaiact_lang' );
    delete_option( 'nfaiact_position' );
    delete_option( 'nfaiact_enabled' );
}
register_uninstall_hook( __FILE__, 'nfaiact_uninstall' );
