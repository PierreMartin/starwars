$(document).ready(function() {

    // POP-IN - BOUTON 'SUPRIMER' :
    $(".btn-modal").click(function() {
        $(this).parent().find('.modal').fadeIn(500).css('background-color', 'rgba(26, 36, 47, 0.75)');
    });

    $(".close, .btn-cancel").click(function() {
        $(this).parent().parent().parent().parent().parent().find('.modal').fadeOut(500); // TODO: a amélioré
    });


    // DATEPICKER :
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        closeText: "Fermer",
        prevText: "<",
        nextText: ">",
        currentText: "Aujourd'hui",
        monthNames: [ "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre" ],
        monthNamesShort: [ "janv.", "févr.", "mars", "avr.", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc." ],
        dayNames: [ "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi" ],
        dayNamesShort: [ "dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam." ],
        dayNamesMin: [ "D","L","M","M","J","V","S" ],
        weekHeader: "Sem.",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    });


});





