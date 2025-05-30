//foto
document.addEventListener("DOMContentLoaded", function () {
  const inputArquivo = document.getElementById("arquivo");
  const nomeArquivo = document.getElementById("nomeArquivo");

  console.log("inputArquivo:", inputArquivo);
  console.log("nomeArquivo:", nomeArquivo);

  if (inputArquivo && nomeArquivo) {
    inputArquivo.addEventListener("change", function () {
      if (inputArquivo.files.length > 0) {
        nomeArquivo.textContent = inputArquivo.files[0].name;
      } else {
        nomeArquivo.textContent = "Nenhum arquivo escolhido";
      }
    });
  }
});
