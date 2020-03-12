//DESPLEGANDO BITACORA
var btn_next_bitacora = document.getElementById('btn_next_bitacora'),
    btn_previous_bitacora = document.getElementById('btn_previous_bitacora'),
    error_box_bitacora = document.getElementById('error_box_bitacora'),
    tablaBitacora = document.getElementById('tablaBitacora'),
    loader_bitacora = document.getElementById('loader_bitacora');

var inicioBitacora=0, finBitacora=5;

function cargarBitacora(){
    tablaBitacora.innerHTML = '<tr id="header"><th>Id</th><th>Correo</th><th>Accion realizada</th><th>Tabla afectada</th><th>fecha</th></tr>';

    var peticion = new XMLHttpRequest();
    peticion.open('GET', 'leer-bitacora.php');

    loader_bitacora.classList.add('active');

    peticion.onload = function(){
        var datos = JSON.parse(peticion.responseText);

        if(datos.error){
            error_box_bitacora.classList.add('active');
        }else{
            for(let index = inicioBitacora; index<finBitacora; index++){
                const info = datos[index];
                var elemento = document.createElement('tr');
                elemento.innerHTML += "<td>" + info.Id_Bitacora + "</td>";
                elemento.innerHTML += "<td>" + info.Correo + "</td>";
                elemento.innerHTML += "<td>" + info.Accion_Realizada + "</td>";
                elemento.innerHTML += "<td>" + info.TablaAfectada + "</td>";
                elemento.innerHTML += "<td>" + info.Fecha + "</td>";
                tablaBitacora.appendChild(elemento);
            }
        }
    };
    peticion.onreadystatechange = function(){
        if(peticion.readyState == 4 && peticion.status == 200){
            loader_bitacora.classList.remove('active');
        }
    };
    peticion.send();
}

btn_next_bitacora.addEventListener('click', function(){
    inicioBitacora+=5;
    finBitacora+=5;
    cargarBitacora();
});

btn_previous_bitacora.addEventListener('click', function(){
    inicioBitacora = inicioBitacora-5;
    finBitacora = finBitacora-5;
    cargarBitacora();
});

window.onload = function(){
    this.cargarBitacora();
    this.cargarAsesores();
}

//DESPLEGANDO ASESORES
var btn_next_asesores = document.getElementById('btn_next_asesores'),
    btn_previous_asesores = document.getElementById('btn_previous_asesores'),
    error_box_asesores = document.getElementById('error_box_asesores'),
    tablaAsesores = document.getElementById('tablaAsesores'),
    loader_asesores = document.getElementById('loader_asesores');

var inicioAsesores=0, finAsesores=5;

function cargarAsesores(){
    tablaAsesores.innerHTML = '<tr id="header"><th>Id</th><th>Estudios</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Correo</th><th>Telefono</th</tr>';

    var peticion = new XMLHttpRequest();
    peticion.open('GET', 'leer-asesores.php');

    loader_asesores.classList.add('active');

    peticion.onload = function(){
        var datos = JSON.parse(peticion.responseText);

        if(datos.error){
            error_box_asesores.classList.add('active');
        }else{
            for(let index = inicioAsesores; index<finAsesores; index++){
                const info = datos[index];
                var elemento = document.createElement('tr');
                elemento.innerHTML += "<td>" + info.Id_Asesor + "</td>";
                elemento.innerHTML += "<td>" + info.Grado_Estudios + "</td>";
                elemento.innerHTML += "<td>" + info.Nombres + "</td>";
                elemento.innerHTML += "<td>" + info.A_Paterno + "</td>";
                elemento.innerHTML += "<td>" + info.A_Materno + "</td>";
                elemento.innerHTML += "<td>" + info.Correo + "</td>";
                elemento.innerHTML += "<td>" + info.Telefono + "</td>";
                tablaAsesores.appendChild(elemento);
            }
        }
    };
    peticion.onreadystatechange = function(){
        if(peticion.readyState == 4 && peticion.status == 200){
            loader_asesores.classList.remove('active');
        }
    };
    peticion.send();
}

btn_next_asesores.addEventListener('click', function(){
    inicioAsesores+=5;
    finAsesores+=5;
    cargarAsesores();
});

btn_previous_asesores.addEventListener('click', function(){
    inicioAsesores = inicioAsesores-5;
    finAsesores = finAsesores-5;
    cargarAsesores();
});
