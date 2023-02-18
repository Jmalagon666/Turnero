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




