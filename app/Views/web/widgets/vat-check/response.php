<?php if (!empty($response) && !empty($response->denumire)) : ?>
    <h3><?php _e('Stare TVA la', TVA_CORE_NAME); ?> <?php echo date('d/m/Y', strtotime($response->data)); ?></h3>
    <ul>
        <li>
            <span class="vat-label"><?php _e('Denumire', TVA_CORE_NAME); ?></span>
            <span class="vat-result"><?php echo $response->denumire; ?></span>
        </li>

        <li>
            <span class="vat-label"><?php _e('Adresa', TVA_CORE_NAME); ?></span>
            <span class="vat-result"><?php echo $response->adresa; ?></span>
        </li>

        <li>
            <span class="vat-label"><?php _e('Plătitor TVA', TVA_CORE_NAME); ?></span>
            <span class="vat-result">
                <?php echo ($response->scpTVA) ? '<span class="vat-true">' . __('DA', TVA_CORE_NAME) . '</span>'
                    : '<span class="vat-false">' . __('NU', TVA_CORE_NAME) . '</span>';
                ?>
            </span>
            <?php if (!empty(trim($response->data_inceput_ScpTVA))) : ?>
                <span class="vat-result-date">
                    <?php _e('De la:', TVA_CORE_NAME); ?>
                    <?php echo date('d/m/Y', strtotime($response->data_inceput_ScpTVA)); ?>

                    <?php if (!empty(trim($response->data_sfarsit_ScpTVA))) : ?>
                        <br>
                        <?php _e('Până la:', TVA_CORE_NAME); ?>
                        <?php echo date('d/m/Y', strtotime($response->data_sfarsit_ScpTVA)); ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </li>

        <li>
            <span class="vat-label"><?php _e('TVA la încasare', TVA_CORE_NAME); ?></span>
            <span class="vat-result">
                <?php echo ($response->statusTvaIncasare) ? '<span class="vat-true">' . __('DA', TVA_CORE_NAME) . '</span>'
                    : '<span class="vat-false">' . __('NU', TVA_CORE_NAME) . '</span>'; ?>
            </span>
            <?php if (!empty(trim($response->dataInceputTvaInc))) : ?>
                <span class="vat-result-date">
                    <?php _e('De la:', TVA_CORE_NAME); ?>
                    <?php echo date('d/m/Y', strtotime($response->dataInceputTvaInc)); ?>

                    <?php if (!empty(trim($response->dataSfarsitTvaInc))) : ?>
                        <br>
                        <?php _e('Până la:', TVA_CORE_NAME); ?>
                        <?php echo date('d/m/Y', strtotime($response->dataSfarsitTvaInc)); ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </li>

        <li>
            <span class="vat-label"><?php _e('Split TVA', TVA_CORE_NAME); ?></span>
            <span class="vat-result">
                <?php echo ($response->statusSplitTVA) ? '<span class="vat-true">' . __('DA', TVA_CORE_NAME) . '</span>'
                    : '<span class="vat-false">' . __('NU', TVA_CORE_NAME) . '</span>'; ?>
            </span>
            <?php if (!empty(trim($response->dataInceputSplitTVA))) : ?>
                <span class="vat-result-date">
                    <?php _e('De la:', TVA_CORE_NAME); ?>
                    <?php echo date('d/m/Y', strtotime($response->dataInceputSplitTVA)); ?>

                    <?php if (!empty(trim($response->dataAnulareSplitTVA))) : ?>
                        <br>
                        <?php _e('Până la:', TVA_CORE_NAME); ?>
                        <?php echo date('d/m/Y', strtotime($response->dataAnulareSplitTVA)); ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </li>
    </ul>
<?php endif; ?>
