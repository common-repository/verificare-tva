(function ($) {
    'use strict';


    // ----------------------------------------------------------------------------
    function checkVat() {
        var companyCui  = $('#verificare-tva-cui').val();
        var companyDate = $('#verificare-tva-data').val();

        if (companyCui === '') {
            $('#verificare-tva-response').html('<span class="vat-false">Vă rugăm să introduceți un cod CUI!</span>');
            $('#verificare-tva-loader').hide();
            toggleVerificareTvaFormState(false);

            return;
        }

        $.post(vat_ajax.url, {
            action: vat_ajax.action,
            type  : vat_ajax.type,
            data  : {cui: companyCui, date: companyDate},
            _nonce: vat_ajax.nonce
        }, function (response) {

            console.log(response);

            $('#verificare-tva-response').html(response);

            $('#verificare-tva-loader').hide();

            toggleVerificareTvaFormState(false);
        });
    }

    // ----------------------------------------------------------------------------

    // ----------------------------------------------------------------------------
    function toggleVerificareTvaFormState(state) {
        $('#verificare-tva-submit').prop('disabled', state);
        $('#verificare-tva-cui').prop('disabled', state);
        $('#verificare-tva-data').prop('disabled', state);
    }

    // ----------------------------------------------------------------------------

    // ----------------------------------------------------------------------------
    $('#verificare-tva-submit').live('click', function (e) {
        e.preventDefault();

        $('#verificare-tva-response').html('');

        toggleVerificareTvaFormState(true);

        $('#verificare-tva-loader').show();

        checkVat();
    });
    // ----------------------------------------------------------------------------

})(jQuery);
