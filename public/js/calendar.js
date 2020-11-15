$(function() {
    $('#freelab').click(function() {
        $('#add-card-freelab').slideDown();
        $('#add-card-new-sched').slideUp();
        $('#newsched').removeClass('is-hidden');
		$(this).addClass('is-hidden');
    });

    $('#newsched').click(function() {
        $('#add-card-new-sched').slideDown();
        $('#add-card-freelab').slideUp();
        $('#freelab').removeClass('is-hidden');
		$(this).addClass('is-hidden');
    });
    
    $('.cancel').click(function() {
		$(this).parents('.card').slideUp();
        $('#newsched').removeClass('is-hidden');
        $('#freelab').removeClass('is-hidden');

	});
});