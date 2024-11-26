<div 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-pink-500 transform transition-transform duration-300 ease-in-out"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
    @click.away="sidebarOpen = false"
    x-cloak
>
    <div class="flex flex-col h-full">
        <div class="flex items-center justify-between h-16 px-4 bg-pink-600 text-white">
            <div class="text-xl font-bold">
                <?php echo get_bloginfo('name'); ?>
            </div>
            <button @click="sidebarOpen = false" class="text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 overflow-y-auto bg-pink-500 text-white">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'sidebar-menu',
                    'menu_id'        => 'sidebar-menu',
                    'container'      => false,
                    'menu_class'     => 'space-y-2',
                    'fallback_cb'    => false,
                )
            );
            ?>
        </nav>
    </div>
</div>