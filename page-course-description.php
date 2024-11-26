<?php
/*
Template Name: Course Description
*/
get_header();

// Get the current page and its ancestors
$current_page_id = get_the_ID();
$ancestors = get_post_ancestors($current_page_id);
$semester_page_id = !empty($ancestors) ? end($ancestors) : $current_page_id;

// Function to get courses within the current semester
function get_semester_courses($semester_id) {
    return get_pages(array(
        'child_of' => $semester_id,
        'sort_column' => 'menu_order',
        'parent' => $semester_id, // Only direct children
    ));
}

$semester_courses = get_semester_courses($semester_page_id);
$is_semester_page = ($current_page_id == $semester_page_id);
?>

<div x-data="{ sidebarOpen: false }" @keydown.escape="sidebarOpen = false" class="flex h-full bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed bg-white h-full mb-8">
    <div class="bg-white w-64 fixed inset-y-0 left-0 transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0" 
         :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" >
        <div class="flex flex-col h-full">
            <div class="p-4 bg-pink-600 text-white">
                <h2 class="text-xl font-bold"><?php echo get_the_title($semester_page_id); ?></h2>
                <p class="text-sm"><?php echo get_post_meta($semester_page_id, 'sub2', true); ?></p>
            </div>
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-2 ">
                    <li>
                        <a href="<?php echo home_url(); ?>" class="block hover:underline">ALAIDI.NET</a>
                    </li>
                   
                    <?php
                    $current_url = home_url($_SERVER['REQUEST_URI']);
                    foreach ($semester_courses as $index => $course) {
                        $course_url = get_permalink($course);
                        $is_current = (trailingslashit($current_url) === trailingslashit($course_url)) ? ' font-semibold' : '';
                        echo '<li>';
                        echo '<a href="' . esc_url($course_url) . '" class="block hover:underline' . $is_current . '">' . ($index + 1) . '. ' . esc_html($course->post_title) . '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64">
        <!-- Top bar -->
        <div class="bg-white shadow-sm z-10" :class="{ 'ml-52': sidebarOpen, 'ml-0': !sidebarOpen }">
            <div class="px-4 py-2 flex items-center justify-between">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none focus:text-gray-700 lg:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path 
        x-show="!sidebarOpen" 
        stroke-linecap="round" 
        stroke-linejoin="round" 
        stroke-width="2" 
        d="M4 6h16M4 12h16M4 18h16"
    ></path>
    <path 
        x-show="sidebarOpen" 
        stroke-linecap="round" 
        stroke-linejoin="round" 
        stroke-width="2" 
        d="M6 18L18 6M6 6l12 12"
    ></path>
</svg>
                </button>
                <h1 class="text-2xl font-semibold text-gray-800"><?php echo get_the_title($semester_page_id); ?></h1>
            </div>
        </div>

        <!-- Page content -->
        <div class="flex-1 overflow-auto p-6" >
            <div class=" mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-pink-500 text-white p-4">
                    <h2 class="text-xl font-bold">Course Description</h2>
                </div>
                <div class="p-6">
                    <?php
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                    ?>

                </div>
            </div>
        </div>

        <footer class="bg-white shadow-md mt-8 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-600">
                    alaidi <span>&copy; 2016-<?php echo date('Y'); ?> All Rights Reserved.</span>
                </p>
            </div>
        </footer>
    </div>
</div>

<?php get_footer(); ?>