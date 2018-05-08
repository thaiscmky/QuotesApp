// Make sure we wait to attach our handlers until the DOM is fully loaded.
$(function() {
      $('.update-form').on('click',function (e) {
          e.preventDefault();
          //https://api.jquery.com/data/
          var id = $(this).data("id");
          $.ajax({
              url: '/api/quotes/' + id,
              type: 'PUT'
          }).done(function(){
              alert('Update of quote '+id+' successful.');
          });
      });
});
