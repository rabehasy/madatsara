import $ from 'jquery';
import 'parsleyjs'
import 'parsleyjs/dist/i18n/fr'

$(function () {
    $('form[name=form]').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    }) ;
});


