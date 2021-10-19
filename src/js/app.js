document.addEventListener('DOMContentLoaded', function () {
    crearSelectMes();
    crearSelectDia();
    crearSelectAnio();
});

document.querySelector('#cp').addEventListener('click', function () {
    codigoPostal();
});

function codigoPostal() {
    let codigoPost;
    const codigoPostal = document.querySelector("#codigoP");
    codigoPost = codigoPostal.value;

    let url = "https://api.copomex.com/query/info_cp/"+ codigoPost+"?token=bf981306-769c-4916-865c-6c37d3f5b0e8";
    //let url ="https://apisgratis.com/api/codigospostales/v2/colonias/cp/?valor="+codigoPost;
    const api = new XMLHttpRequest();
    api.open('GET', url, true);
    api.send();
    api.onreadystatechange =function(){
        if(this.status == 200 && this.readyState == 4){
            let ciudad = document.querySelector('#ciudad');
            let estado = document.querySelector('#estado');
            let colonia = document.querySelector('#colonia');
            let datos = JSON.parse(this.responseText);
            console.log(datos);
            for(x of datos ){   
                if (x.error == false) {
                    ciudad.value= x.response.ciudad;
                    estado.value= x.response.estado;
                    colonia.value=x.response.asentamiento; 
                    break;
                }
            }
        }else if (this.status == 400) {
            Swal.fire({
                icon: 'error',
                title: 'Codigo Postal no Encontrado',
                text: 'No se encontro el codigo postal',
              });
        }
    }
}


function crearSelectDia() {
    const select = document.querySelector('#dia');
    const inp = document.querySelector('#diaR');
    for (let i = 1; i < 32; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        if (inp.value == i) {
            option.selected=true;
        }
        select.appendChild(option);
    }
}

function crearSelectMes(){
    const select = document.querySelector('#mes');
    const mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const inp = document.querySelector('#mesR');
    for (let i = 0; i < 12; i++) {
        const option = document.createElement('option');
        option.value = i+1;
        option.text = mes[i];
        if (inp.value == (i+1)) {
            option.selected=true;
        }
        select.appendChild(option);
    }
}

function crearSelectAnio(){
    const select = document.querySelector('#anio');
    const inp = document.querySelector('#anioR');
    for (let i = 1940; i < 2025; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        if (inp.value == i) {
            option.selected=true;
        }
        select.appendChild(option);
    }
}
function confirmarEliminacion(formulario){
    const result = Swal.fire({
        title: 'Esta seguro de Eliminar?',
        text: "No se puede Revertir esta accion",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'Cancelar',
        confirmButtonText: 'Si Eliminar'
    }).then((result) => {
    if (result.isConfirmed) {
          const form = document.querySelector(formulario);
          console.log(form);
          form.submit();
        }});
}

function checkLetters(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) {
        return true;
    }
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checkNumber(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}



$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();