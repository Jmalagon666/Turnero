function clock (){
    let hora = document.getElementById('hora');
    let minuto = document.getElementById('minuto');
    let segundo = document.getElementById('segundo');
    let ampm = document.getElementById('ampm');

    let h = new Date().getHours();
    let m = new Date().getMinutes();
    let s = new Date().getSeconds();
    var am = 'AM';


    if(h > 12){
        h=h - 12;
        var am ='PM';
    }

   h= (h < 10) ? '0' + h : h;
   m= (m < 10) ? '0' + m : m;
   s= (s < 10) ? '0' + s : s;



    hora.innerHTML=h;
    minuto.innerHTML=m;
    segundo.innerHTML=s;
    ampm.innerHTML=am;
}
var interval = setInterval(clock,1000);





































/* setInterval(() => {   //Ejecutar Fecha
let fecha = new Date();
const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
const dias = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
const mes = meses[fecha.getMonth()];
const dia = dias[fecha.getDay()];
const diaN = fecha.getDate();
const horas = (String(fecha.getHours()).length == 2) ? fecha.getHours() : `0${fecha.getHours()}`;
const minutos = (String(fecha.getMinutes()).length == 2) ? fecha.getMinutes() : `0${fecha.getMinutes()}`;
const segundos = (String(fecha.getSeconds()).length == 2) ? fecha.getSeconds() : `0${fecha.getSeconds()}`;

//Mostrando Fecha
document.getElementById('dia').innerHTML=dia;
/* document.getElementById('mes').innerHTML=`${diaN} ${mes}`; */
/* document.querySelector('#hora p:nth-child(1)').innerHTML = horas;
document.querySelector('#hora p:nth-child(2)').innerHTML = ':';
document.querySelector('#hora p:nth-child(3)').innerHTML = minutos;
document.querySelector('#hora p:nth-child(4)').innerHTML = ':';
document.querySelector('#hora p:nth-child(5)').innerHTML = segundos;
}, 1000); */






























/* const $tiempo = document.querySelector('.tiempo'),
$fecha = document.querySelector('.fecha');


function digitalClock(){
    let f = new Date(),
    dia = f.getDate(),
    mes = f.getMonth() + 1,
    anio = f.getFullYear(),
    diaSemana = f.getDay();

dia = ('0' + dia).slice(-2);
mes = ('0' + mes).slice(-2)
   let timeString = f.toLocaleTimeString();
   $tiempo.innerHTML = timeString;

   let semana =['DOM','LUN','MAR','MIER','JUE','VIE','SAB'];
   let showSemana = (semana[diaSemana]);
   $fecha.innerHTML = `${anio}-${mes}-${dia} ${showSemana}`


}
setInterval(()=> {

  digitalClock()
},1000);
 */
