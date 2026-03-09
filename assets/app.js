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
$(document).on('keyup', '#busquedaTabla', function () {
    let valorBusqueda = $(this).val().toLowerCase();

    //TABLA
    $("#vistaTabla tbody tr").each(function () {
        let fila = $(this);
        let textoFila = "";
        textoFila += $(this).text().toLowerCase() + " ";
        fila.toggle(textoFila.indexOf(valorBusqueda) > -1);
    });

    //TOKENS
    $("#vistaMosaico .token").each(function () {
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

//LISTAR (Usando fetch)
document.addEventListener('change', function (e) {
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

// BOTON DE MODIFICAR DATOS TABLA
$(document).on('click', '.btnMod', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    const entidad = $(this).data('entidad');
    abrirEdicion(id, entidad);
});

function abrirEdicion(id, entidad) {
    const btn = document.querySelector(`.btnMod[data-id="${id}"]`);
    const fila = btn.closest('tr');
    const url = `/dnd/editar/${entidad}/${id}`;
    console.log(id);

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => {
            if (!response.ok) throw new Error('Error al cargar la edición');
            return response.text();
        })
        .then(htmlFilaEdicion => {
            // 'outerHTML' sustituye el <tr> viejo por el nuevo <tr> con inputs/selects
            fila.outerHTML = htmlFilaEdicion;
        })
        .catch(err => console.error(err));
}

$(document).on('click', '.btnGuardar', function(e) {
    const id = $(this).data('id');
    const entidad = $(this).data('entidad');
    guardarCambios(id, entidad);
});

function guardarCambios(id, entidad) {
    const fila = document.querySelector(`tr[data-id="${id}"]`);
    const contenedorDeEstaTabla = fila.closest('.cajaTabla').parentNode;
    const inputs = fila.querySelectorAll('.editInput');
    const datos = new URLSearchParams();

    inputs.forEach(input => {
        datos.append(input.name, input.value);
    });

    fetch(`/dnd/guardar/${entidad}/${id}`, {
        method: 'POST',
        body: datos,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(res => {
            if(res.ok){
                const urlListar = `/dnd/listar/${entidad}`;
                fetch(urlListar, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    contenedorDeEstaTabla.innerHTML = html;
                });
            }
        });
}

//PAGINACIÓN TABLAS
$(document).on('click', '.btnPag', function (e) {
    e.preventDefault();
    const paginaDestino = $(this).data('pagina');
    const textoBusqueda = $('#busquedaTabla').val();
    const entidadActual = $('.btnMod').first().data('entidad');

    const url = `/dnd/listar/${entidadActual}?page=${paginaDestino}&q=${encodeURIComponent(textoBusqueda)}`;

    actualizarTabla(url);
});

function actualizarTabla(url) {
    const $contenedor = $('.contenidoPrincipal');

    $.ajax({
        url: url,
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function (htmlRecibido) {
            $contenedor.html(htmlRecibido);
            window.history.pushState({}, '', url);
        },
        error: function (xhr) {
            console.error("Error al paginar:", xhr.statusText);
        }
    });
}

let debounceTimer;

// Mostrar/Ocultar controles
$(document).on('click', '#btnAbrirFiltro', function() {
    $('#controlesFiltro').fadeToggle(200);
});

// Evento al escribir o cambiar el select
$(document).on('keyup change', '#busquedaTabla, #filtroCampo', function() {
    clearTimeout(debounceTimer);
    
    debounceTimer = setTimeout(() => {
        const texto = $('#busquedaTabla').val();
        const campo = $('#filtroCampo').val();
        const entidad = $('.btnMod').first().data('entidad');

        // Construimos la URL con el nuevo parámetro 'campo'
        const url = `/dnd/listar/${entidad}?page=1&q=${encodeURIComponent(texto)}&campo=${campo}`;
        
        actualizarTabla(url);
    }, 300); // 300ms de espera
});



