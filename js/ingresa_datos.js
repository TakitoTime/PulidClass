var nombre=document.getElementById("nombre");
var edad=document.getElementById("edad");
var paterno=document.getElementById("paterno");
var materno=document.getElementById("materno");
var telefono=document.getElementById("telefono");
var correo=document.getElementById("correo");
var foto=document.getElementById("foto");

var btn_guardarUsuario=document.getElementById("guardar_usuario");
var btn_modificarUsuario=document.getElementById("modificar_usuario");

function Modificar_Datos_Usuario(){
    nombre.disabled=false;
    edad.disabled=false;
    paterno.disabled=false;
    materno.disabled=false;
    telefono.disabled=false;
    foto.disabled=false;
    btn_guardarUsuario.style.display="block";
    btn_modificarUsuario.style.display="none";
}

function Habilitar_Correo(){
    correo.disabled=false;
}
