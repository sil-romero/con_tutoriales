
$(document).ready(function(){

    //--punto a parte-- creamos una variable editar para realizar las ediciones de las tareas
    let editar = false;

// console.log ('jquery funcionando');
 // antes de que empiece la aplicacion ocultamos el cuadro en blanco de busqueda.
  $('#tarea-resultado').hide();
/*  capturamos el input a travez de su id con el evento 'keyup'. ejecutamos una funcion que recibe informacion */ 
// ejecutamos la funcion de mostrar todas las tareas
fetchTareas();

/* armamos el codigo de busqueda */
$('#busqueda').keyup(function(e) {
    //preguntamos si hay algun valor en el elemento 'busqueda'.
    if ($('#busqueda').val()) {
        // obtenemos el valor del input y lo guardamos en la variable 'busqueda'
    let busqueda = $('#busqueda').val();
    $.ajax({
        url: 'busqueda_tarea.php',
        type: 'POST', 
        // con data enviamos el valor del input al servidor
        data: { busqueda },
        // cuando el servidor nos responde algo lo manejamos con la funcion 'success'.
        success: function(response) {
            let tareas = JSON.parse(response);
            //console.log(tareas);
            // llenamos la variable 'template' con string.
            let template = '';
            tareas.forEach(tarea => {    
                template += `<li>
                ${tarea.nombre}
                </li>`
            });
            $('#container').html(template);
            $('#tarea-resultado').show();
            // mostramos la caja blanca que se oculto en un principio
        }

    });
        
    }
});

/* armamos el codigo para que mande la tarea */
 $('#formulario_de_tareas').submit(function(e) {
     //console.log('enviando');
        // creamos un obj que se encargue de almacenar los valores de los input
     const postDatos = {
        nombre: $('#nombre_tarea').val(),
        descripcion: $('#descripcion_tarea').val(),
        id: $('#idTarea').val()
     };

     /* agregamos código para la edicion de tareas */
     //creamos una variable url para enviar datos segun sea editar verdadero o falso
     // realizaremos una validacion. si edit es V ejucuta tal cosa y si es F ejecuta otra cosa.
     // si el formulario no se esta editando se envia los datos agregar-tarea.php sino se envia a editar-tarea.php
     let url = editar === false ? 'agregar-tarea.php' : 'editar-tarea.php';
     console.log(url);

     //con el metodo post aclaramos, la url donde queremos mandar los datos 
     // los datos a enviar, y lo que haremos cuando recivamos una respuesta.  
     $.post(url, postDatos, function (response) {
         // cambiamos la direccion del post de agregar-tarea.php por url.
            console.log(response);
            // obtenemos nuevamente las tareas
            fetchTareas();
            // cuando el formulario esta recibiendo la respuesta del servidor ejecuta nuevamente la funcion

            //con este metodo reseteamos el formulrio cada vez que envia datos.
            $('#formulario_de_tareas').trigger('reset');
     });

     //con este metodo evitamos que la página se refresque. 
     e.preventDefault();
 });


 /* armamos el codigo para que muetre en forma de tabla las tareas */
    function fetchTareas() { 
        $.ajax({
            url: 'listar-tarea.php',
            type: 'GET',
            success: function (response) {
                //console.log(response);
                // como el servidor le retorna el arreglo en formato de string
                // utilizamos el json para convertirlo en arreglo de objs. le damos como parametro la respuesta del servidor.
                let tareas = JSON.parse(response);
                // a esta variable lo manipulamos como queramos
                // recorremos la variable tareas y por cada una de ellas retornamos algo
                let template = ''; // es un string. y por cada recorrido llenamos la plantilla
                tareas.forEach(tarea => {
                    //las tildes dobladas permiten ingresar un string en multiples lineas.
                    // la plantilla tendra un tr, una fila por cada tarea. adentro estaran las celdas
                   template += `
                   <tr idTarea="${tarea.id}">
                       <td>${tarea.id}</td>
                       <td>
                            <a href='#' class="tarea-item">${tarea.nombre}</a>
                       </td>
                       <td>${tarea.descripcion}</td>
                       <td>
                        <button class="eliminar-tareas btn btn-danger">
                            eliminar 
                        </button>
                       </td>
                   </tr>
                   `
                });
                // ahora lo mostraremos por pantalla. seleccionamos el elemento del tbody su id=tareas.
                // adentro le insertamos la plantilla con el metodo html.
                $('#tareas').html(template);
         
            }
           });

     }

     /* armamos el codigo para que elimine la tarea */
    // escuchamos el evento click pero de la clase elimar tareas y cuando lo escuches ejucata una funcion. 
    $(document).on('click', '.eliminar-tareas', function () { 
        //ejecutamos la funcion solo si le damos ok en eliminar 
        if (confirm('¿Estas seguro de eliminar la tarea?')) {
         
        //console.log('clikeado');
        // hay que tener en cuenta que el boton tiene un padre que es el 'td' y a su vez el td tiene un padre que es 'tr'
        // y la fila es el que tiene el id. la propiedad parentElement me permite acceder.
        let elemento = $(this)[0].parentElement.parentElement;
        //buscamos el atributo 'idTarea' cuando damos click en el button, y seleccionamos el valor del atrubuto.
        let id = $(elemento).attr('idTarea');
        //console.log(id);
        // enviamos el id al bakend, para que tome el id y lo elimine. utilizaremos el elemento post de jquery.
        $.post('eliminar-tarea.php', {id}, function (response) { 
            fetchTareas();
            
         })

        }

      });

      /* armamos el codigo para editar tareas */
      // aremos algo parecido al delete, mandaremos el id al bakend 
      $(document).on('click', '.tarea-item', function () {  
        let elemento = $(this)[0].parentElement.parentElement; 
        // creamos una variable solo para guardar el id y no todo lo del 'tr'
        let id = $(elemento).attr('idTarea');
        // enviamos los datos al servidor con el metodo post de jquery
        $.post('unica-tarea.php', {id}, function (response) {  
           //console.log(response);
            const tarea = JSON.parse(response);
            $('#nombre_tarea').val(tarea.nombre);
            $('#descripcion_tarea').val(tarea.descripcion);
            $('#idTarea').val(tarea.id);
            // cambiamos el valor de verdad de la variable editar
            editar = true;

        })
        
      });

});