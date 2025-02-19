<?php

get_header();


while (have_posts()) : the_post();

?>

<main role="main">
  
    <div class="white" style="background-color: #<?php background_color(); ?>!important; background-image: url(<?php background_image(); ?>); background-size: cover;">
        <div class="row container">
	        <?php get_sidebar('left-sidebar'); ?>
            <div class="col s12 ">
                <h2 class="header"><?php the_title(); ?></h2>

                <?php the_content(); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
                ?>
            </div>
	        <?php get_sidebar('right-sidebar'); ?>
        </div>
    </div>
</main>

<?php endwhile; ?>

<?php get_footer(); ?>