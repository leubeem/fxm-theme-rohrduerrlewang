<?php
function fxwp_theme_styles()
{
    wp_enqueue_style('fxwp_theme_style', str_replace('style.css', 'style.min.css', get_stylesheet_uri()));
}

add_action('wp_enqueue_scripts', 'fxwp_theme_styles');

// Registrieren Sie die Menüs
function fxwp_theme_register_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}

add_action('init', 'fxwp_theme_register_menus');

// Kommentare vollständig deaktivieren
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

function fxwp_custom_theme_customizer( $wp_customize ) {
    // Add a new section
    $wp_customize->add_section( 'fxwp_custom_section', array(
        'title'    => __( 'Custom Section', 'fxwp-custom-theme' ),
        'priority' => 160,
    ) );

    // Add settings for columns
    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( 'fxwp_custom_section_column_' . $i, array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fxwp_custom_section_column_' . $i, array(
            'label'       => __( 'Column ' . $i, 'fxwp-custom-theme' ),
            'section'     => 'fxwp_custom_section',
            'settings'    => 'fxwp_custom_section_column_' . $i,
            'type'        => 'textarea',
            'description' => __( 'Column ' . $i . ' content.', 'fxwp-custom-theme' ),
        ) ) );
    }
}
add_action( 'customize_register', 'fxwp_custom_theme_customizer' );


function breadcrumb() {
    // Get the current post/page ID
    $post_id = get_queried_object_id();

    // Initialize an empty breadcrumb string
    $breadcrumb = '';

    // Set the separator character for the breadcrumbs
    $separator = '<span class="breadcrumb-separator"> / </span>';

    // Add the Home link
    $breadcrumb .= '<a href="' . esc_url(home_url('/')) . '">Home</a>' . $separator;

    // Add the parent pages
    $parent_ids = get_post_ancestors($post_id);
    if ($parent_ids) {
        $parent_ids = array_reverse($parent_ids);
        foreach ($parent_ids as $parent_id) {
            $breadcrumb .= '<a href="' . esc_url(get_permalink($parent_id)) . '">' . get_the_title($parent_id) . '</a>' . $separator;
        }
    }

    // Add the current page/post
    $breadcrumb .= '<span class="current">' . get_the_title($post_id) . '</span>';

    // Return the breadcrumb HTML
    echo '<div class="breadcrumb">' . $breadcrumb . '</div>';
}


function update_kirchengruppen_capabilities() {
    // Try to get the role, whether it exists or not.
    $role = get_role('kirchengruppen');

    // If the role doesn't exist, clone it from the editor role.
    if (!$role) {
        $editor_role = get_role('editor');
        $role = add_role('kirchengruppen', 'Kirchengruppen', $editor_role->capabilities);
    }

    // List of capabilities to remove.
    $remove_caps = array(
        'edit_others_pages',
        'edit_others_posts',
        'delete_others_pages',
        'delete_others_posts',
        'delete_pages',
        'delete_posts',
        'delete_published_pages',
        'delete_published_posts',
        // Customizer capabilities
        'customize',
        'edit_theme_options'
    );
    //CF7 caps are restricted via wp-config.php defines

    // Remove each capability from the role.
    foreach ($remove_caps as $cap) {
        $role->remove_cap($cap);
    }
}
add_action('admin_init', 'update_kirchengruppen_capabilities');

// Hide the Contact Form 7 menu for users with the kirchengruppen role
function hide_cf7_menu_for_kirchengruppen() {
    // Check if the current user has the kirchengruppen role.
    $user = wp_get_current_user();
    if ( in_array( 'kirchengruppen', (array) $user->roles ) ) {
        remove_menu_page('wpcf7');
    }
}
add_action('admin_menu', 'hide_cf7_menu_for_kirchengruppen', 999);

// Restrict editing to own pages and prevent deletion
function restrict_page_editing_and_deletion($allcaps, $cap, $args) {
    if (!isset($cap[0]) || !in_array($cap[0], array('edit_page', 'delete_page'))) {
        return $allcaps;
    }

    if (!isset($args[2])) {
        return $allcaps;
    }

    $post_id = $args[2];
    $post = get_post($post_id);

    if ($allcaps['kirchengruppen']) {
        // Allow editing only own pages
        if ($cap[0] === 'edit_page' && $post->post_author != get_current_user_id()) {
            $allcaps[$cap[0]] = false;
        }

        // Prevent deletion of any pages
        if ($cap[0] === 'delete_page') {
            $allcaps[$cap[0]] = false;
        }
    }

    return $allcaps;
}
add_filter('user_has_cap', 'restrict_page_editing_and_deletion', 10, 3);
