<?php
/*
Template Name: Course Home
*/
get_header();
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
    $semesters = get_pages(array(
        'sort_column' => 'menu_order',
        'parent' => 0,
    ));
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