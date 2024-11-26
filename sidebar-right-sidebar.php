<?php
if (is_active_sidebar('right-sidebar')) :
?>
    <div class="col s12 m3">
        <?php dynamic_sidebar('right-sidebar'); ?>
    </div>
<?php
endif; 