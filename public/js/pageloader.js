$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  $(window).on('load', function() {
    $('.pageloader .title').text('');
    $('.pageloader').removeClass('is-active');
  });
  
  $(function() {
    $('#logout form').submit(function() {
      $('.pageloader .title').text('Logging Out');
      $('.pageloader').addClass('is-active');
    });
  
    $('#sidebar a').click(function() {
      if ($(this).attr('id') == 'freelab')
        $('.pageloader .title').text('Loading Free Lab Form');
      else
        $('.pageloader .title').text('Loading ' + $(this).attr('id').charAt(0).toUpperCase() + $(this).attr('id').slice(1));
      $('.pageloader').addClass('is-active');
    });
  });