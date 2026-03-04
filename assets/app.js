import './bootstrap.js';
import $ from 'jquery';

window.jQuery = window.$ = $;

console.log("JS cargado");

//AJAX PARA EL NAV
$(document).on('click', '.bannerMenu a', function (e) {
    e.preventDefault();

    const urlDestino = $(this).attr('href'); // Cogemos la URL del enlace
    const $contenedor = $('.contenidoPrincipal'); // Guardamos la variable donde vamos a meter el contenido

    // Cambiar activo e inactivo en las clases de CSS
    $('.bannerMenu a').removeClass('active');
    $(this).addClass('active');

    // AJAX CON JQUERY
    $.ajax({
        url: urlDestino,
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function (htmlRecibido) {
            $contenedor.html(htmlRecibido);
            //Esto cambia la URL sin actualizar
            window.history.pushState({}, '', urlDestino);
            //Añadir info a los logs para test
            console.log("Carga de sección completada: " + urlDestino);
        },
        error: function (xhr) {
            console.error("Error al cargar la sección:", xhr.statusText);
            $contenedor.html('<p>Error al cargar el contenido.</p>');
        }
    });
});

// FILTRO DE BÚSQUEDA
$(document).on('keyup', '#busquedaTabla', function(){
    let valorBusqueda = $(this).val().toLowerCase();
    
    //TABLA
    $("#vistaTabla tbody tr").each(function(){
        let fila = $(this);
        let textoFila = "";
        textoFila += $(this).text().toLowerCase() + " ";
        fila.toggle(textoFila.indexOf(valorBusqueda) > -1);
    });
    
    //TOKENS
    $("#vistaMosaico .token").each(function(){
        let imagen = $(this);
        let textoImagen = imagen.text().toLowerCase();
        imagen.toggle(textoImagen.indexOf(valorBusqueda) > -1);
    });
})

// VISTA DE TABLA Y MOSAICO
$(document).on('click', '#btnVistaTabla', function () {
    console.log("Cambiando a vista tabla...");

    $('#vistaMosaico').hide();
    $('#vistaTabla').fadeIn(300);

    $(this).addClass('active');
    $('#btnVistaMosaico').removeClass('active');
});
$(document).on('click', '#btnVistaMosaico', function () {
    console.log("Cambiando a vista mosaico...");

    $('#vistaTabla').hide();
    $('#vistaMosaico').fadeIn(300);

    $(this).addClass('active');
    $('#btnVistaTabla').removeClass('active');
});

// BOTON DE MODIFICAR DATOS TABLA
$(document).on('click', function(e){
    const btnEditar = e.target.closest('.btnMod');
    if(btnEditar){
        e.preventDefault();
        const idEntidad = btnEditar.getAttribute('data-id');
        abrirEdicion(idEntidad);
    }
});

function abrirEdicion(id){
    const btn = document.querySelector(`.btnMod[data-id="${id}"]`);
    const fila = btn.closest('tr');
    const celdas = fila.querySelectorAll('td');
    for (let i = 1; i < celdas.length - 1; i++){
        const valorActual = celdas[i].innerText.trim();
        const ancho = celdas[i].offsetWidth;
        celdas[i].innerHTML = `<input type="text" class="editTabla" value="${valorActual}" style="width: ${ancho - 20}px">`;
    }
    btn.innerHTML = '💾';
    btn.classList.remove('btnMod');
    btn.classList.add('btnGuardarMod');
    btn.onclick = function() {guardarCambios(id); };
}

function guardarCambios(id){

}


//Listar (Usando fetch)
document.addEventListener('change', function(e) {
    if (e.target && e.target.id === 'selectorListar') {
        const clase = e.target.value;
        const url = `/dnd/listar/${clase}`;
        window.history.pushState({}, '', url);
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const contenedor = document.getElementById('contenedorTablaListar');
            if (contenedor) {
                contenedor.innerHTML = html;
            }
        })
        .catch(error => console.error('Error en la carga:', error));
    }
});


