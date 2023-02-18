var doc="";
function TomarDatos(value){
    var val = "n"+value;
    console.log(val+"---");
    var datos=document.getElementById(val).value.trim();
    doc = doc+''+datos;
    console.log(val+"---");
    console.log(doc+"*");
    document.getElementById("doc").value=doc;
}

function Tomarturno(value){
    var val = value;
    console.log(val);
    document.getElementById("turno").value=val;
    /*var datos=document.getElementById(val).value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;*/
}





/*
function TomarDatos2(value){

    var datos=document.getElementById("n2").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos3(value){

    var datos=document.getElementById("n3").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos4(value){

    var datos=document.getElementById("n4").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos5(value){

    var datos=document.getElementById("n5").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos6(value){

    var datos=document.getElementById("n6").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos7(value){

    var datos=document.getElementById("n7").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos8(value){

    var datos=document.getElementById("n8").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}

function TomarDatos9(value){

    var datos=document.getElementById("n9").value;
    doc = doc+""+datos;
    console.log(doc);
    document.getElementById("doc").value=doc;
}
*/

