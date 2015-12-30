// GESTION DES POP-IN - BOUTON 'SUPRIMER' :
$(".btn-modal").click(function() {
    $(this).parent().find('.modal').fadeIn(500).css('background-color', 'rgba(26, 36, 47, 0.75)');
});

$(".close, .btn-cancel").click(function() {
    $(this).parent().parent().parent().parent().parent().find('.modal').fadeOut(500); // TODO: a amélioré
});