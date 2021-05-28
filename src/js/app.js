document.addEventListener('DOMContentLoaded', function () {
    crearSelectMes();
    crearSelectDia();
    crearSelectAnio();
});


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
