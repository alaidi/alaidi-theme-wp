<?php
if (is_active_sidebar('left-sidebar')) :
?>
    <div class="col s12 m3">
        <?php dynamic_sidebar('left-sidebar'); ?>
    </div>
<?php
endif; 