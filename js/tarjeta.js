var nombre1=document.getElementById("nombre1");
var numero_t1=document.getElementById("numero_t1");
var mes1=document.getElementById("mes1");
var año1=document.getElementById("año1");
var codigo1=document.getElementById("codigo1");

var nombre2=document.getElementById("nombre2");
var numero_t2=document.getElementById("numero_t2");
var mes2=document.getElementById("mes2");
var año2=document.getElementById("año2");
var codigo2=document.getElementById("codigo2");

var guardar_t1=document.getElementById("guardar_t1");
var guardar_t2=document.getElementById("guardar_t2");

var eliminar1=document.getElementById("eliminar_t1");
var eliminar2=document.getElementById("eliminar_t2");

function Agregar_Tarjeta(id_agregar){
    if(id_agregar==1){
        guardar_t1.disabled=false;
        nombre1.disabled=false;
        numero_t1.disabled=false;
        mes1.disabled=false;
        año1.disabled=false;
        codigo1.disabled=false;
        $( ".tarjetas" ).tabs( {
            active: 0
        }  );
    }
    else{
        if(id_agregar==2){
            guardar_t2.disabled=false;
            nombre2.disabled=false;
            numero_t2.disabled=false;
            mes2.disabled=false;
            año2.disabled=false;
            codigo2.disabled=false;
            $( ".tarjetas" ).tabs( {
                active: 1
            }  );
        }
    }
}

function Habilitar_Boton_Tarjeta(){
    eliminar1.disabled=false;
    eliminar2.disabled=false;
}

$( function() {
    $( ".tarjetas" ).tabs();
  } );
