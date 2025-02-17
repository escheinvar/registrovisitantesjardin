function VerNoVer(prod,tipo) {
    // Muestra y oculta ventanas
    var x = document.getElementById('sale_'+prod+tipo);
    if (x.style.display == "none") {
        x.style.display = "block";
    } else   {
        x.style.display = "none";
    }
}

function VerNoVerIcon(Idprod,Idtipo,icono1,icono2,block) {
    // Muestra u oculta el elemento id="sale_IdprodIdtipo"
    // Y modifica el ícono de <i id=saleicon_IdprodIdtipo> alternando icono1 e icono2
    if(icono1==''){icono1='bi bi-eye';}
    if(icono2==''){icono2='bi bi-eye-slash';}
    if(block==''){block='block';}else{block='inline-block';}
    var icono=document.getElementById('saleicon_'+Idprod+Idtipo);

    // Muestra y oculta ventanas
    var x = document.getElementById('sale_'+Idprod+Idtipo);
    if (x.style.display == "none") {
        //x.style.display = "block";
        x.style.display = block;
        icono.className = icono1 //'far fa-eye'
    } else   {
        x.style.display = "none";
        icono.className = icono2 //'far fa-eye-slash'
    }
}

function VerNoVerPass(CampoPass,CampoIcono, iconoText, iconoPass){
    if(iconoText==''){icono1='bi bi-eye';}
    if(iconoPass==''){icono2='bi bi-eye-slash';}
    icono=document.getElementById(CampoIcono);
    pass=document.getElementById(CampoPass);
    if (pass.type == "password") {
        pass.type = 'text';
        icono.className = iconoText; //'far fa-eye'
    } else   {
        pass.type = 'password';
        icono.className = iconoPass;
    }
}


///// Sólo permitir números
function SoloNums (e){
    key = e.keyCode ? e.keyCode : e.which;
    if  ( key < 48 || key > 57){
        return true;
    }
}

//Inhabilitar tecla de espacio
//function NoEspacio(e, campo){
//		key = e.keyCode ? e.keyCode : e.which;
//		if (key == 32) {return false;}
//}
//onkeypress="javascript: return ValidarNumero(event,this)"
/*
Livewire.on('alerta',function(titulo, texto){
    //Muestra ventanita de alerta con SweetAlert en Livewire
    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'success',
        confirmButtonText: 'Continuar'
    })
})
*/

/*
Livewire.on('alertaConfirma',function(titulo1, texto1){
    Swal.fire({
        title: titulo1,
        text: texto1,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Se confirma',
            'hecho',
            'success'
          )
        }
      })
})
*/
