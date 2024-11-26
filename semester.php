<?php
/*
Template Name: Semester Page
*/
get_header();

$current_page_id = get_the_ID();
$semester_courses = get_pages(array(
    'child_of' => $current_page_id,
    'sort_column' => 'menu_order',
    'parent' => $current_page_id,
));
?>

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
    <div class="bg-pink-500 text-white p-4">
        <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
    </div>
    <div class="p-6">
        <?php the_content(); ?>

        <h2 class="text-xl font-semibold mt-6 mb-4">Courses in this semester:</h2>
        <ul class="list-disc pl-6 space-y-2">
            <?php foreach ($semester_courses as $course) : ?>
                <li>
                    <a href="<?php echo get_permalink($course->ID); ?>" class="text-blue-600 hover:underline">
                        <?php echo $course->post_title; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php get_footer(); ?>