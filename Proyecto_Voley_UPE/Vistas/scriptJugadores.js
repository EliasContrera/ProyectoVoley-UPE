$(document).ready(function() {
    // Cargar opciones de equipos
    $.ajax({
      url: 'obtenerEquipos.php',
      method: 'POST',
      success: function(data) {
        $('#equipos').html(data);
        
        // Cargar jugadores al cambiar el equipo seleccionado
        $('#equipos').change(function() {
          var equipoSeleccionado = $(this).val();
          cargarJugadores(equipoSeleccionado);
        });
      }
    });
    
    function cargarJugadores(equipoId) {
      //alert("ESTAMOS EN LA FUNCION CARGARJUGADORES->>" +equipoId);
      $.ajax({
        url: 'obtenerJugadores.php',
        method: 'POST',
        data: { equipoId: equipoId },
        success: function(data) {
          $('#jugadoresContainer').html(data);
         
        }
      });
    }
  });