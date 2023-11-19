$(document).ready(function() {

      $.ajax({
        url: 'obtenerPartidos.php',
        method: 'POST',
        success: function(data) {
          $('#PartidosContainer').html(data); 
        }
      });
    });


   