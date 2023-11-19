window.onload = function () {
    let url = '../controlador/ObtenerComentarios.php';
    fetch(url)
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Error en la llamada a la API. Estado: ' + response.status);
            }
            return response.json();
        })
        .then(function (comentariosxd) {
            let listaComentarios = document.querySelector("#lista-comentarios");

            if (comentariosxd.length === 0) {
                console.log('No se encontraron comentarios.');
                return;
            }

            comentariosxd.forEach(function (comentario) { //Agrego los comentarios a la pagina dinamicamente trayendolos desde la base de datos
                let articulo = document.createElement("li");

                let nombreElemento = document.createElement("strong");
                nombreElemento.innerText = comentario.nombre + ': ';

                let descripcionElemento = document.createElement("span");
                descripcionElemento.innerText = comentario.Descripcion;

                articulo.appendChild(nombreElemento);
                articulo.appendChild(descripcionElemento);

                listaComentarios.appendChild(articulo);
            });
        })
        .catch(function (error) {
            console.error('Error en la llamada AJAX:', error);
        });
};
