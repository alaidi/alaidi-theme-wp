<?php
/*
Template Name: Course Home
*/
get_header();

// Function to extract year and semester from page title
function extract_semester_info($title) {
    $matches = [];
    preg_match('/(\w+)\s*(\d{4})/', $title, $matches);
    
    if (count($matches) === 3) {
        $semester = strtolower($matches[1]);
        $year = intval($matches[2]);
        
        // Convert semesters to numeric for sorting
        $semester_order = [
        'spring' => 1,
        'fall' => 2,
        '' => 3  // For years without a specific semester
        ];
        
        return [
            'semester' => $semester,
            'year' => $year,
        'sort_value' => ($year * 10) + ($semester_order[$semester] ?? 3)
        ];
    }
    
    // Fallback for pages without clear semester/year
    return [
        'semester' => '',
        'year' => 0,
        'sort_value' => 0
    ];
}

// Fetch and sort semesters
$semesters = get_pages(array(
    'sort_column' => 'menu_order',
    'parent' => 0,
));

// Sort semesters by year and semester
usort($semesters, function($a, $b) {
    $a_info = extract_semester_info($a->post_title);
    $b_info = extract_semester_info($b->post_title);
    return $b_info['sort_value'] - $a_info['sort_value'];
});
?>

<div class="max-w-7xl mx-auto">
    <header class="text-center mb-12">
        <h1 class="text-4xl font-bold text-pink-500"><?php the_title(); ?></h1>
        <?php
        if (has_excerpt()) {
            echo '<p class="mt-4 text-lg text-gray-500">' . get_the_excerpt() . '</p>';
        }
        ?>
    </header>
    <?php
    foreach ($semesters as $semester) :
        $courses = get_pages(array(
            'child_of' => $semester->ID,
            'sort_column' => 'menu_order',
        ));
        if (!empty($courses)) :
    ?>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4"><?php echo $semester->post_title; ?></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($courses as $course) :
                    $subtitle = get_post_meta($course->ID, 'sub2', true);
                ?>
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                    <a href="<?php echo get_permalink($course->ID); ?>" class="block">
                        <div class="aspect-w-16 aspect-h-9">
                            <?php
                            if (has_post_thumbnail($course->ID)) {
                                echo get_the_post_thumbnail($course->ID, 'medium', ['class' => 'w-full h-full object-cover']);
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/default-course.jpg" alt="Default Course Image" class="w-full h-full object-cover">';
                            }
                            ?>
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo $course->post_title; ?></h3>
                            <?php if ($subtitle) : ?>
                                <p class="mt-2 text-gray-500"><?php echo $subtitle; ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php
        endif;
    endforeach;
    ?>
</div>
<?php get_footer(); ?>
