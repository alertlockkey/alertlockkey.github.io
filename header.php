<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <!-- SEO META TAGS -->
  <meta name="description" content="Alert Lock & Key – San Antonio’s #1 locksmith and door hardware company since 1976. We offer 24/7 residential, commercial, and automobile locksmith services, smart security systems, and professional door installation.">
  <meta name="keywords" content="San Antonio locksmith, door hardware, key replacement, access control, smart locks, commercial locksmith, residential locksmith, door installation">
  <meta name="author" content="Alert Lock & Key">

  <!-- Open Graph (Facebook, LinkedIn) -->
  <meta property="og:title" content="Alert Lock & Key – San Antonio Locksmith & Security Experts">
  <meta property="og:description" content="24/7 locksmith services, doors, hardware, access control, and security solutions. Family owned since 1976.">
  <meta property="og:url" content="<?php echo home_url(); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/alk_logo_2016.png">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Alert Lock & Key – Locksmith & Security Experts">
  <meta name="twitter:description" content="San Antonio’s trusted locksmith since 1976. Residential, commercial, and vehicle services with 24/7 availability.">
  <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/images/alk_logo_2016.png">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/alk_logo_2016.png">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/alk_logo_2016.png">

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

  <!-- Styles -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Head hooks -->
  <?php wp_head(); ?>
</head>
<body <?php body_class('landing is-preload'); ?>>

<div id="page-wrapper">
  <!-- Header -->
  <header id="header" class="<?php echo is_front_page() ? 'alt' : ''; ?>">
    <h1><a href="<?php echo home_url(); ?>">Alert Lock & Key</a></h1>
	<nav id="nav">
		<ul>
			<li class="special">
				<a href="#menu" class="menuToggle" aria-label="Toggle menu"><span>Menu</span>
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</a>
				<div id="menu">
					<?php
						wp_nav_menu([
							'theme_location' => 'main-menu',
							'container'      => false,
							'menu_class'     => '',
							'fallback_cb'    => 'alk_default_menu'
						]);
					?>
				</div>
			</li>
		</ul>
	</nav>
  </header>
