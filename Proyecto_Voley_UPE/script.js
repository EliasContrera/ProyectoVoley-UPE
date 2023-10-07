/////////////////// Cargar los modales usando modales.html utilizando JavaScript
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
fetch('navbar.html')
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

// Cargar el footer desde footer.html utilizando JavaScript
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
        // Manejar errores si ocurren
        console.error('Error al cargar el footer:', error);
    });



//Comentarios para la seccion comentarios en Noticias.html
document.addEventListener('DOMContentLoaded', function () {
        // ...
    
        // Obtener referencia al formulario y la lista de comentarios
        let commentForm = document.getElementById('comment-form');
        let commentList = document.getElementById('comment-list');
    
        // Agregar un evento de envío de formulario para manejar comentarios
        commentForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita que el formulario se envíe normalmente
    
            // Obtener valores del formulario
            let nombre = document.getElementById('nombre').value;
            let comentario = document.getElementById('comentario').value;
    
            // Crear un nuevo elemento de comentario
            let newComment = document.createElement('li');
            newComment.innerHTML = `<strong>${nombre}:</strong> ${comentario}`;
    
            // Agregar el nuevo comentario a la lista
            commentList.appendChild(newComment);
    
            // Limpiar el formulario después de agregar el comentario
            commentForm.reset();
        });
});   
