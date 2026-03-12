import './bootstrap.js';
import $ from 'jquery';

window.jQuery = window.$ = $;

console.log("JS cargado");

let debounceTimer;

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

//ACTUALIZAR TABLA
function actualizarTabla(url) {
    const $contenedor = $('.vistaTotal');
    $.ajax({
        url: url,
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function (htmlRecibido) {
            const nuevoContenido = $(htmlRecibido).find('#vistaTotal')
            $contenedor.html(nuevoContenido);
            window.history.pushState({}, '', url);
        },
        error: function (xhr) {
            console.error("Error al paginar:", xhr.statusText);
        }
    });
}

// VISTA DE TABLA Y MOSAICO
$(document).on('click', '.btnToggleVistas', function () {
    const vistaSeleccionada = $(this).data('vista'); //Vista es la vista elegida entre tabla o mosaico
    const entidad = $('.btnMod').first().data('entidad') || '{{ nombre_seccion }}';

    $('.btnToggleVistas').removeClass('active');
    $(this).addClass('active');
    const url = `/dnd/listar/${entidad}?page=1&vista=${vistaSeleccionada}`;

    actualizarTabla(url);
});

//PAGINACIÓN TABLAS
$(document).on('click', '.btnPag', function (e) {
    e.preventDefault();
    const paginaDestino = $(this).data('pagina');
    const entidadActual = $('.btnMod').first().data('entidad');
    const vistaActiva = $('.btnToggleVistas.active').data('vista') || 'tabla';
    const url = `/dnd/listar/${entidadActual}?page=${paginaDestino}&vista=${vistaActiva}`;

    actualizarTabla(url);
});

// ABRIR/CERRAR LUPA
$(document).on('click', '#btnAbrirFiltros', function(e) {
    e.preventDefault();
    $('#checkboxFiltros').stop().fadeToggle(300);
});

//ABRIR FILTRO TABLA
$(document).on('change', '.selectorFiltro', function() {
    const targetId = $(this).data('target');
    const $inputContenedor = $('#' + targetId);
    
    if ($(this).is(':checked')) {
        $inputContenedor.removeClass('hidden');
    } else {
        $inputContenedor.addClass('hidden');
        $inputContenedor.find('.inputFiltroDinamico').val(''); 
        ejecutarFiltro();
    }
});

//FILTRO TABLAS CHECKBOX
    $(document).on('change', '.checkboxIndividual', function () {
    const attr = $(this).data('attr');
    
    if ($(this).is(':checked')) {
        const campoClonado = $(`#plantilla-${attr}`).clone().attr('id', `grupo-${attr}`);
        $('#camposBusqueda').append(campoClonado);
    } else {
        $(`#grupo-${attr}`).remove();
    }
    ejecutarFiltro(); 
});

//EJECUTAR FILTRO TABLAS
function ejecutarFiltro() {
    const entidad = $('.btnMod').first().data('entidad');
    const vista = $('.btnToggleVistas.active').data('vista') || 'tabla';
    let filtros = {};
    $('.inputFiltroDinamico').each(function () {
        const campo = $(this).attr('name');
        const valor = $(this).val();
        if (valor !== "") {
            filtros[campo] = valor;
        }
    });
    const textoQuery = $.param(filtros);
    const url = `/dnd/listar/${entidad}?page=1&vista=${vista}&${textoQuery}`;
    actualizarTabla(url);
}

//DELAY AL ESCRIBIR Y ACTUALIZAR
$(document).on('keyup change', '.inputFiltroDinamico', function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(ejecutarFiltro, 400);
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

//MODIFICAR DATOS TABLA
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

$(document).on('click', '.btnGuardar', function (e) {
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
            if (res.ok) {
                const urlListar = `/dnd/listar/${entidad}`;
                fetch(urlListar, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(r => r.text())
                    .then(html => {
                        contenedorDeEstaTabla.innerHTML = html;
                    });
            }
        });
}



