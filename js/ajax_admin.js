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
                elemento.innerHTML += "<td>" + info.usuario_Correo + "</td>";
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
    this.cargarNoticias();
    this.cargarMaterial();
}

//DESPLEGANDO ASESORES
var btn_next_asesores = document.getElementById('btn_next_asesores'),
    btn_previous_asesores = document.getElementById('btn_previous_asesores'),
    error_box_asesores = document.getElementById('error_box_asesores'),
    tablaAsesores = document.getElementById('tablaAsesores'),
    loader_asesores = document.getElementById('loader_asesores');

var inicioAsesores=0, finAsesores=5;

function cargarAsesores(){
    tablaAsesores.innerHTML = '<tr id="header"><th>Id</th><th>Estudios</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Correo</th><th>Telefono</th></tr>';

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

//DESPLEGANDO Noticias
var btn_next_noticias = document.getElementById('btn_next_noticias'),
    btn_previous_noticias = document.getElementById('btn_previous_noticias'),
    error_box_noticias = document.getElementById('error_box_noticias'),
    tablaNoticias = document.getElementById('tablaNoticias'),
    loader_noticias = document.getElementById('loader_noticias');

var inicioNoticias=0, finNoticias=5;

function cargarNoticias(){
    tablaNoticias.innerHTML = '<tr id="header"><th>Id</th><th>Administrador</th><th>Titulo</th><th>Subtitulo</th><th>Fecha</th><th>Eliminar</th></tr>';

    var peticion = new XMLHttpRequest();
    peticion.open('GET', 'leer-noticias.php');

    loader_noticias.classList.add('active');

    peticion.onload = function(){
        var datos = JSON.parse(peticion.responseText);

        if(datos.error){
            error_box_noticias.classList.add('active');
        }else{
            for(let index = inicioNoticias; index<finNoticias; index++){
                const info = datos[index];
                var elemento = document.createElement('tr');
                elemento.innerHTML += "<td>" + info.Id_Noticia + "</td>";
                elemento.innerHTML += "<td>" + info.Correo + "</td>";
                elemento.innerHTML += "<td>" + info.Titulo + "</td>";
                elemento.innerHTML += "<td>" + info.Subtitulo + "</td>";
                elemento.innerHTML += "<td>" + info.Fecha + "</td>";
                elemento.innerHTML += "<td><button type='submit' id='delete' name='baja_noticia' value=" + info.Id_Noticia + ">Eliminar</a></td>";
                tablaNoticias.appendChild(elemento);
            }
        }
    };
    peticion.onreadystatechange = function(){
        if(peticion.readyState == 4 && peticion.status == 200){
            loader_noticias.classList.remove('active');
        }
    };
    peticion.send();
}

btn_next_noticias.addEventListener('click', function(){
    inicioNoticias+=5;
    finNoticias+=5;
    cargarNoticias();
});

btn_previous_noticias.addEventListener('click', function(){
    inicioNoticias = inicioNoticias-5;
    finNoticias = finNoticias-5;
    cargarNoticias();
});

//DESPLEGANDO Material
var btn_next_material = document.getElementById('btn_next_material'),
    btn_previous_material = document.getElementById('btn_previous_material'),
    error_box_material = document.getElementById('error_box_material'),
    tablaMaterial = document.getElementById('tablaMaterial'),
    loader_material = document.getElementById('loader_material');

var inicioMaterial=0, finMaterial=5;

function cargarMaterial(){
    tablaMaterial.innerHTML = '<tr id="header"><th>Id</th><th>Administrador</th><th>Titulo</th><th>Materia</th><th>Fecha</th><th>Eliminar</th></tr>';

    var peticion = new XMLHttpRequest();
    peticion.open('GET', 'leer-material.php');

    loader_material.classList.add('active');

    peticion.onload = function(){
        var datos = JSON.parse(peticion.responseText);

        if(datos.error){
            error_box_material.classList.add('active');
        }else{
            for(let index = inicioMaterial; index<finMaterial; index++){
                const info = datos[index];
                var elemento = document.createElement('tr');
                elemento.innerHTML += "<td>" + info.Id_Material + "</td>";
                elemento.innerHTML += "<td>" + info.Correo + "</td>";
                elemento.innerHTML += "<td>" + info.Titulo + "</td>";
                elemento.innerHTML += "<td>" + info.Materia + "</td>";
                elemento.innerHTML += "<td>" + info.Fecha + "</td>";
                elemento.innerHTML += "<td><button type='submit' id='delete' name='baja_material' value=" + info.Id_Material + ">Eliminar</a></td>";
                tablaMaterial.appendChild(elemento);
            }
        }
    };
    peticion.onreadystatechange = function(){
        if(peticion.readyState == 4 && peticion.status == 200){
            loader_material.classList.remove('active');
        }
    };
    peticion.send();
}

btn_next_material.addEventListener('click', function(){
    inicioMaterial+=5;
    finMaterial+=5;
    cargarMaterial();
});

btn_previous_material.addEventListener('click', function(){
    inicioMaterial = inicioMaterial-5;
    finMaterial = finMaterial-5;
    cargarMaterial();
});