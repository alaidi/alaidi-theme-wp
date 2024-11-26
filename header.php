<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full bg-gray-100">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body <?php body_class('h-full'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site flex h-full" x-data="{ sidebarOpen: false }">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'your-theme-textdomain'); ?></a>
    <div class="flex-1 flex flex-col overflow-hidden">
        <main id="content" class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
