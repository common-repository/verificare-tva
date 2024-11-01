<?php echo $args['before_widget']; ?>
    <!-- Widget -->
    <div class="qn-press-release--widget">
        <?php if ($title) : ?>
            <?php echo $args['before_title'] . $title . $args['after_title']; ?>
        <?php endif; ?>

        <form>
            <section id="verificare-tva" class="widget widget_search">
                <p>
                    <label for="verificare-tva-cui">
                        <span class="screen-reader-text"><?php _e('CUI:', TVA_CORE_NAME); ?></span>
                        <input type="text" id="verificare-tva-cui" class="search-field" placeholder="CUI" required>
                    </label>
                </p>

                <p>
                    <label for="verificare-tva-data">
                        <span class="screen-reader-text"><?php _e('Data:', TVA_CORE_NAME); ?></span>
                        <input type="date" id="verificare-tva-data" class="date-field" value="<?php echo date('Y-m-d');
                        ?>" required>
                    </label>
                </p>

                <p>
                    <button type="button" id="verificare-tva-submit" class="submit">
                        <?php _e('Verifică', TVA_CORE_NAME); ?>
                    </button>
                </p>

                <div id="verificare-tva-loader"></div>
                <div id="verificare-tva-response"></div>
            </section>
        </form>
    </div>
    <!-- /End Widget -->
<?php echo $args['after_widget'];
