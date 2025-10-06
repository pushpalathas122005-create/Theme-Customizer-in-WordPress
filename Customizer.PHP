1. style.css
/*
Theme Name: My Custom Theme
Author: Your Name
Description: A simple theme with WordPress Customizer
Version: 1.0
*/
body {
  background-color: #f0f0f0;
  font-family: Arial, sans-serif;
  color: #333;
}
2. index.php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header>
    <h1 style="color: <?php echo get_theme_mod('header_color', '#333'); ?>">
      <?php bloginfo('name'); ?>
    </h1>
    <p><?php bloginfo('description'); ?></p>
  </header>

  <main>
    <p>Welcome to the customizable WordPress theme!</p>
  </main>

  <?php wp_footer(); ?>
</body>
</html>
3. functions.php
<?php
// Enqueue styles
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

// Theme Customizer
function mytheme_customize_register( $wp_customize ) {

    // Add a section
    $wp_customize->add_section( 'mytheme_colors', array(
        'title'    => __( 'Theme Colors', 'mytheme' ),
        'priority' => 30,
    ));

    // Add setting for header color
    $wp_customize->add_setting( 'header_color', array(
        'default'   => '#333',
        'transport' => 'refresh',
    ));

    // Add color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color_control', array(
        'label'    => __( 'Header Text Color', 'mytheme' ),
        'section'  => 'mytheme_colors',
        'settings' => 'header_color',
    )));
}
add_action( 'customize_register', 'mytheme_customize_register' );

