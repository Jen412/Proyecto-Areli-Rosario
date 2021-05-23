document.addEventListener('DOMContentLoaded', function () {
    crearSelectMes();
    crearSelectDia();
    crearSelectAnio();
});


function crearSelectDia() {
    const select = document.querySelector('#dia');
    for (let i = 1; i < 32; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        select.appendChild(option);
    }
}

function crearSelectMes(){
    const select = document.querySelector('#mes');
    const mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    for (let i = 0; i < 12; i++) {
        const option = document.createElement('option');
        option.value = i+1;
        option.text = mes[i];
        select.appendChild(option);
    }
}

function crearSelectAnio(){
    const select = document.querySelector('#anio');
    for (let i = 1940; i < 2021; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        select.appendChild(option);
    }
}
