// Make sure we wait to attach our handlers until the DOM is fully loaded.
$(function() {
      $('.update-form').on('submit',function (e) {
          e.preventDefault();
          //https://api.jquery.com/data/
          var id = $(this).data("id");
          $.ajax({
              url: '/api/quotes/' + id,
              type: 'PUT',
              data: $('form').serializeArray()
          }).done(function(data){
              alert(data);
              location.assign('/');
          });
      });

    $('.delquote').on('click',function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: '/api/quotes/' + id,
            type: 'DELETE',
        }).done(function(data){
            alert(data);
            location.assign('/');
        });
    })

    $('.create-form').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            url: '/api/quotes/',
            type: 'POST',
            data: $('form').serializeArray()
        }).done(function(data){
            alert('New post added. Id: '+data);
            location.assign('/');
        });
    });
});
