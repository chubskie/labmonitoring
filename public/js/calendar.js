$(function() {
  $('#schedules').addClass('is-active').removeAttr('href');

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
  

  
  $('#allday').click(function() {
    $("#reccuring_toggle").toggle();
  });

  $('#recurring').click(function() {
    $("#recurring_form").toggle(this.checked);
  });


});


