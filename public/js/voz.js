 /*console.log("hola desde le evento---")
document.addEventListener("load",function(event){

	document.getElementById('llamar').addEventListener("click",()=>{
		console.log("hola desde le evento")
		decir(document.getElementById("texto").value)

	});
 fun
	function decir(texto) {

		speechSynthesis.speak(new SpeechSynthesisUtterance(texto));
	}

});

*/

function leerTexto(texto){
    const speech = new SpeechSynthesisUtterance();
    speech.continuous = false;
    speech.interimResults = false;
    speech.text = texto;
    speech.volume = 5;
    speech.rate = 0.6;
    speech.pitch = 1;
    speech.lang= "es-ES";
    window.speechSynthesis.speak(speech);
}
playText.addEventListener('click', () =>{
    leerTexto(texto.value);
});




