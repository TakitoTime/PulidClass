var abrir_modal=document.getElementById("modalactive");

if(abrir_modal.dataset.value=="true"){

	showModal();

}

function showModal() {
	$('#noticia-modal').modal('show');
};

