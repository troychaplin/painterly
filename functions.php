<?php
/**
 * Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme setup
 */
function miles_painterly_blog_portfolio_7e825f33_setup() {
    // Enable editor styles support
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'miles_painterly_blog_portfolio_7e825f33_setup' );

/**
 * Enqueue theme styles in block editor and frontend.
 * Uses enqueue_block_assets to load CSS as <link> tags in the editor iframe,
 * enabling CSS hot-reload when files change.
 */
function miles_painterly_blog_portfolio_7e825f33_enqueue_block_assets() {
    // Use filemtime() for cache busting when CSS files change
    $styles_path = get_template_directory() . '/assets/css/styles.css';
    $styles_version = file_exists( $styles_path ) ? filemtime( $styles_path ) : wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'miles-painterly-blog-portfolio-7e825f33-styles',
        get_template_directory_uri() . '/assets/css/styles.css',
        array(),
        $styles_version
    );

    $editor_path = get_template_directory() . '/assets/css/editor-page.css';
    $editor_version = file_exists( $editor_path ) ? filemtime( $editor_path ) : wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'miles-painterly-blog-portfolio-7e825f33-editor-page-styles',
        get_template_directory_uri() . '/assets/css/editor-page.css',
        array( 'miles-painterly-blog-portfolio-7e825f33-styles' ),
        $editor_version
    );
}
add_action( 'enqueue_block_assets', 'miles_painterly_blog_portfolio_7e825f33_enqueue_block_assets' );

/**
 * Enqueue theme scripts for frontend only
 */
function miles_painterly_blog_portfolio_7e825f33_enqueue_scripts() {
    // Enqueue JavaScript if it exists, use filemtime() for cache busting
    $script_path = get_template_directory() . '/assets/js/script.js';
    $script_version = file_exists( $script_path ) ? filemtime( $script_path ) : wp_get_theme()->get( 'Version' );

    if ( file_exists( $script_path ) ) {
        wp_enqueue_script(
            'miles-painterly-blog-portfolio-7e825f33-script',
            get_template_directory_uri() . '/assets/js/script.js',
            array(),
            $script_version,
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'miles_painterly_blog_portfolio_7e825f33_enqueue_scripts' );

/**
 * Remove title support from pages for cleaner editing experience.
 * The homepage content provides its own visual header.
 */
function miles_painterly_blog_portfolio_7e825f33_customize_pages() {
    remove_post_type_support( 'page', 'title' );
}
add_action( 'init', 'miles_painterly_blog_portfolio_7e825f33_customize_pages' );

/**
 * Add JS class to html element for animation system.
 * Outputs early in head to prevent FOUC on animated elements.
 */
function miles_painterly_blog_portfolio_7e825f33_add_js_class() {
    echo '<script>document.documentElement.classList.add("js");</script>';
}
add_action( 'wp_head', 'miles_painterly_blog_portfolio_7e825f33_add_js_class', 1 );

