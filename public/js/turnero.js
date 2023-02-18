function relojt(){
    var today = new Date();
    var hora = today.getHours();
    var minuto = today.getMinutes();
    var segundo = today.getSeconds();

    ap = (hora < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hor=12-hora;
    hora = (hora == 00) ? hor : hora;

    hora = chekTime(hora);
    minuto = chekTime(minuto);
    segundo = chekTime(segundo);

    document.getElementById("hora").innerHTML = hora;
    document.getElementById("minuto").innerHTML = minuto;
    document.getElementById("segundo").innerHTML = segundo;
    document.getElementById("ampm").innerHTML = ap;

    var tiempo = setTimeout(function(){relojt()},500);
}

function chekTime(i){
    if(i<10){
        i="0"+i;
    }

    return i;
}


