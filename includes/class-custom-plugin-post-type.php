<?php

/**
 *
 * @link       https://websweetstudio.com
 * @since      1.0.0
 *
 * @package    Custom_Plugin
 * @subpackage Custom_Plugin/includes
 */

class Custom_Plugin_Post_Types
{
    public function __construct()
    {
        // Hook into the 'init' action
        add_action('init', array($this, 'register_post_types'));
    }

    /**
     * Register custom post types
     */
    public function register_post_types()
    {
        // Register Blog Post Type
        register_post_type(
            'cekresi',
            array(
                'labels' => array(
                    'name' => ('Cek Resi'),
                    'singular_name' => ('Cek Resi')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'cekresi'),
                'supports' => array('title', 'editor', 'thumbnail'),
                'show_in_rest' => true
            )
        );

        register_post_type(
            'ongkir',
            array(
                'labels' => array(
                    'name' => ('Ongkir'),
                    'singular_name' => ('Ongkir')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'ongkir'),
                'supports' => array('title'),
                'show_in_rest' => false,
            )
        );

        register_post_type(
            'absensi',
            array(
                'labels' => array(
                    'name' => ('Absensi'),
                    'singular_name' => ('Absensi')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'absensi'),
                'supports' => array('title', 'editor', 'thumbnail'),
                'menu_icon'   => 'dashicons-groups',
                'show_in_rest' => true,
                'menu_icon'   => 'dashicons-groups',
            )
        );
    }
}

// membuat taxonomy kategori demo untuk post type demo
function create_taxonomy_kategori_demo_web()
{
    register_taxonomy(
        'kategori_paket',
        'cekresi',
        array(
            'label' => __('Kategori Paket'),
            'rewrite' => array('slug' => 'kategori-paket'),
            'hierarchical' => true,
            'show_in_rest' => true
        )
    );
}
add_action('init', 'create_taxonomy_kategori_demo_web');

// Inisialisasi class Custom_Post_Types_Register
$custom_post_types_register = new Custom_Plugin_Post_Types();
