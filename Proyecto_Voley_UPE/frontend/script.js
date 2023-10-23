/////////////////// Cargar los modales desde modales.html utilizando JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Obtener el contenedor de modales
    let modalContainer = document.getElementById('modal-container');

    // Realizar una solicitud GET a 'modales.html'
    fetch('modales.html')
        .then(response => {
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('La solicitud no se pudo completar correctamente.');
            }
            // Convertir la respuesta a texto
            return response.text();
        })
        .then(data => {
            // Insertar el contenido de 'modales.html' en el contenedor
            modalContainer.innerHTML = data;
        })
        .catch(error => {
            // Manejar errores si ocurren
            console.error('Error al cargar los modales:', error);
        });
});

/////////////////// Cargar la barra de navegacion desde navbar.html utilizando JavaScript
let navbarContainer = document.getElementById('navbar-container');
fetch('navbar.php')
    .then(response => {
        // Verificar si la respuesta es exitosa
        if (!response.ok) {
            throw new Error('La solicitud no se pudo completar correctamente.');
        }
        // Convertir la respuesta a texto
        return response.text();
    })
    .then(data => {
        // Insertar el contenido de 'navbar.html' en el contenedor
        navbarContainer.innerHTML = data;
    })
    .catch(error => {
        // Manejar errores si ocurren
        console.error('Error al cargar la barra de navegación:', error);
    });
/////////////////////////

    
/////////////////// Cargar el pie de pagina desde footer.html utilizando JavaScript
let footerContainer = document.getElementById('footer-container');
fetch('footer.html')
    .then(response => {
        // Verificar si la respuesta es exitosa
        if (!response.ok) {
            throw new Error('La solicitud no se pudo completar correctamente.');
        }
        // Convertir la respuesta a texto
        return response.text();
    })
    .then(data => {
        // Insertar el contenido de 'footer.html' en el contenedor
        footerContainer.innerHTML = data;
    })
    .catch(error => {
        // Manejar errores si es que ocurren
        console.error('Error al cargar el footer:', error);
    });



//Comentarios para la seccion comentarios en Noticias.html
//Nota a Futuro: Realizar validaciones para la seccion de formulario*

document.addEventListener('DOMContentLoaded', function () {
    
        // Obtengo referencia al formulario y la lista de comentarios
        let comentarioForm = document.getElementById('comentarios-form');
        let comentarioLista = document.getElementById('lista-comentarios');
    
        // Agregar un evento de envío de formulario para manejar comentarios
        comentarioForm.addEventListener('submit', function (evento) {
            evento.preventDefault(); // Evita que el formulario se envíe por default
    
            // Obtengo valores del formulario
            let nombre = document.getElementById('nombre').value;
            let comentario = document.getElementById('comentario').value;
    
            // Crear un nuevo elemento de comentario
            let NuevoComentario = document.createElement('li');
            NuevoComentario.innerHTML = `<strong>${nombre}:</strong> ${comentario}`;
    
            // Agregar el nuevo comentario a la lista
            comentarioLista.appendChild(NuevoComentario);
    
            // Limpiar el formulario después de agregar el comentario
            comentarioForm.reset();
        });
});  



// Filtrar las filas de la tabla según la competencia seleccionada

mostrarRanking(); //Llamo a la funcion para que se ejecute


function mostrarRanking(){
    function filtrarPorTipoCompetencia(tipoCompetencia) {
        let filas = document.querySelectorAll('#MiTabla tbody tr');
    
        filas.forEach(fila => {
            let tipo = fila.getAttribute('data-tipo-competencia');
    
            if (tipoCompetencia === 'todas' || tipo === tipoCompetencia) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }
    
    // Obtener el elemento select para el filtro de tipo de competencia
    let filtroTipoCompetencia = document.getElementById('tipoCompetencia');
    
    // Agregar un evento de cambio al select
    filtroTipoCompetencia.addEventListener('change', () => {
        let tipoSeleccionado = filtroTipoCompetencia.value;
        filtrarPorTipoCompetencia(tipoSeleccionado);
    });
    
    // Inicializar el filtro mostrando todos los tipos de competencia
    filtrarPorTipoCompetencia('todas');
}

//////////////////////////////////////
//Logica Validacion usuario

