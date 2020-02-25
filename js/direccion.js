var id1=document.getElementById("id1");
var pais1=document.getElementById("pais1");
var estado1=document.getElementById("estado1");
var ciudad1=document.getElementById("ciudad1");
var colonia1=document.getElementById("colonia1");
var calle1=document.getElementById("calle1");
var numero1=document.getElementById("numero1");
var codigo_postal1=document.getElementById("codigo_postal1");
var descripcion1=document.getElementById("descripcion1");

var id2=document.getElementById("id2");
var pais2=document.getElementById("pais2");
var estado2=document.getElementById("estado2");
var ciudad2=document.getElementById("ciudad2");
var colonia2=document.getElementById("colonia2");
var calle2=document.getElementById("calle2");
var numero2=document.getElementById("numero2");
var codigo_postal2=document.getElementById("codigo_postal2");
var descripcion2=document.getElementById("descripcion2");

var id3=document.getElementById("id3");
var pais3=document.getElementById("pais3");
var estado3=document.getElementById("estado3");
var ciudad3=document.getElementById("ciudad3");
var colonia3=document.getElementById("colonia3");
var calle3=document.getElementById("calle3");
var numero3=document.getElementById("numero3");
var codigo_postal3=document.getElementById("codigo_postal3");
var descripcion3=document.getElementById("descripcion3");

var eliminar1=document.getElementById("eliminar1");
var eliminar2=document.getElementById("eliminar2");
var eliminar3=document.getElementById("eliminar3");

var guardar_d1=document.getElementById("guardar_d1");
var guardar_d2=document.getElementById("guardar_d2");
var guardar_d3=document.getElementById("guardar_d3");

var titulo1=document.getElementById("titulo1");
var titulo2=document.getElementById("titulo2");
var titulo3=document.getElementById("titulo3");



function Modificar_Datos_Direccion(id){
    if(id==1){
        guardar1.disabled=false;
        pais1.disabled=false;
        estado1.disabled=false;
        ciudad1.disabled=false;
        colonia1.disabled=false;
        calle1.disabled=false;
        numero1.disabled=false;
        codigo_postal1.disabled=false;
        descripcion1.disabled=false;
    }
    else{
        if(id==2){
            guardar2.disabled=false;
            pais2.disabled=false;
            estado2.disabled=false;
            ciudad2.disabled=false;
            colonia2.disabled=false;
            calle2.disabled=false;
            numero2.disabled=false;
            codigo_postal2.disabled=false;
            descripcion2.disabled=false;
        }
        else{
            guardar3.disabled=false;
            pais3.disabled=false;
            estado3.disabled=false;
            ciudad3.disabled=false;
            colonia3.disabled=false;
            calle3.disabled=false;
            numero3.disabled=false;
            codigo_postal3.disabled=false;
            descripcion3.disabled=false;
        }
    }
}

function Habilitar_ID(id){
    if(id==1){
        id1.disabled=false;
    }
    else{
        if(id==2){
            id2.disabled=false;
        }
        else{
            id3.disabled=false;
        }
    }
}

function Agregar_Direccion(id_agregar){
    if(id_agregar==1){
        guardar1.disabled=false;
        pais1.disabled=false;
        estado1.disabled=false;
        ciudad1.disabled=false;
        colonia1.disabled=false;
        calle1.disabled=false;
        numero1.disabled=false;
        codigo_postal1.disabled=false;
        descripcion1.disabled=false;
        $( ".direcciones" ).accordion( {
            active: 0
        }  );
    }
    else{
        if(id_agregar==2){
            guardar2.disabled=false;
            pais2.disabled=false;
            estado2.disabled=false;
            ciudad2.disabled=false;
            colonia2.disabled=false;
            calle2.disabled=false;
            numero2.disabled=false;
            codigo_postal2.disabled=false;
            descripcion2.disabled=false;
            $( ".direcciones" ).accordion( {
                active: 1
            }  );
        }
        else{
            guardar3.disabled=false;
            pais3.disabled=false;
            estado3.disabled=false;
            ciudad3.disabled=false;
            colonia3.disabled=false;
            calle3.disabled=false;
            numero3.disabled=false;
            codigo_postal3.disabled=false;
            descripcion3.disabled=false;
            $( ".direcciones" ).accordion( {
                active: 2
            }  );
        }
    }
}

function Habilitar_Boton(){
    eliminar1.disabled=false;
    eliminar2.disabled=false;
    eliminar3.disabled=false;
}

$( function() {
    $( ".direcciones" ).accordion();
  } );
