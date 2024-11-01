<p>
    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
        <?php _e('Widget title:', TVA_CORE_NAME); ?>

        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
               name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
               value="<?php echo esc_attr($title); ?>"/>
    </label>
</p>

<br>