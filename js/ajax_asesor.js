window.onload = function(){
    this.cargarNoticias();
    this.cargarMaterial();
}

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
