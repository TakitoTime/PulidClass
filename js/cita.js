
var abrir_modal=document.getElementById("modalactive");

var confirmar_cita=document.getElementById("confirmar");

var tarjeta=document.getElementById("tarjeta");
var direccion=document.getElementById("direccion");
var fecha=document.getElementById("fecha");
var hora_inicial=document.getElementById("hora_inicial");
var hora_final=document.getElementById("hora_final");

if(abrir_modal.dataset.value=="true"){

	showModal();

}

function showModal() {
	$('#ex1').modal('show');
};

if(confirmar_cita.value=="Confirmar Cita"){
	tarjeta.disabled=true;
	direccion.disabled=true;
	fecha.disabled=true;
	hora_inicial.disabled=true;
	hora_final.disabled=true;
}

function Confirmar_Cita(){
	tarjeta.disabled=false;
	direccion.disabled=false;
	fecha.disabled=false;
	hora_inicial.disabled=false;
	hora_final.disabled=false;
}
