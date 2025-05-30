//olhinho
function mostrarSenha() {
    const input = document.getElementById('senha');
    const icone = document.getElementById('icone-senha');

    if (input.type === "password") {
        input.type = "text";
        icone.src = "/livros/assets/olho_aberto.png";
        icone.alt = "Ocultar senha";
    } else {
        input.type = "password";
        icone.src = "/livros/assets/olho_fechado.png";  
        icone.alt = "Mostrar senha";
    }
}
