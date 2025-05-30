//Registrar usuario
function validarSenha() {
    const senha = document.getElementById("senha").value;

    const regras = [
      { id: "regra1", valid: senha.length >= 8 },
      { id: "regra2", valid: /[A-Z]/.test(senha) },
      { id: "regra3", valid: /[a-z]/.test(senha) },
      { id: "regra4", valid: /[0-9]/.test(senha) },
      { id: "regra5", valid: /[\W_]/.test(senha) }
    ];

    regras.forEach(regra => {
      const item = document.getElementById(regra.id);
      if (regra.valid) {
        item.innerHTML = `✅ ${item.textContent.slice(2)}`;
        item.style.color = "green";
      } else {
        item.innerHTML = `🔴 ${item.textContent.slice(2)}`;
        item.style.color = "red";
      }
    });
  }

  function validarConfirmacao() {
    const senha = document.getElementById("senha").value;
    const confirma = document.getElementById("confirma_senha").value;
    const feedback = document.getElementById("feedback-confirma");

    if (senha !== confirma) {
      feedback.textContent = "As senhas não coincidem.";
      return false;
    }

    feedback.textContent = "";
    return true;
  }
