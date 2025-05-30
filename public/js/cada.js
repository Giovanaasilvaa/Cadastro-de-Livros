//detalhes
const detalhes = document.getElementById('detalhesLivro');

document.querySelector('.carousel-container').addEventListener('mouseenter', (e) => {
  const item = e.target.closest('.item');
  if (!item) return;

  const { titulo, autor, descricao, status, id } = item.dataset;
  const statusTexto = status === 'lido' ? '✔️ Lido' : '⏳ Pendente';
  const classeStatus = status === 'lido' ? 'btn-status lido' : 'btn-status pendente';

  detalhes.innerHTML = `
    <h2>${titulo}</h2>
    <p><strong>Autor:</strong> ${autor}</p>
    <p><strong>Descrição:</strong> ${descricao || '-'}</p>
    <form action="atualizar_status.php" method="POST">
      <input type="hidden" name="id_livro" value="${id}">
      <input type="hidden" name="status_atual" value="${status}">
      <button type="submit" class="${classeStatus}">
        ${statusTexto}
      </button>
    </form>
    <div style="margin-top: 15px;">
      <a href="update.php?id=${id}" class="btn-warning">✏️ Editar</a>
      <a href="delete.php?id=${id}" class="btn-warning" style="margin-left: 10px;">🗑️ Deletar</a>
    </div>
  `;

  detalhes.classList.add('ativo');
}, true);


// Manipulador de clique para as estrelas
document.querySelectorAll('.rating .star').forEach(star => {
  star.addEventListener('click', e => {
    const container = star.closest('.rating');
    const form = container.closest('form'); 
    const val  = star.dataset.value;

    form.querySelector('input[name="rating"]').value = val;
    form.submit(); 
  });
});

//loops
document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.querySelector(".carousel-wrapper");
  const container = document.querySelector(".carousel-container");

  const items = Array.from(container.children);
  items.forEach(item => {
    const clone = item.cloneNode(true);
    container.appendChild(clone);
  });

  let scrollSpeed = 0.7;

  function autoScroll() {
    wrapper.scrollLeft += scrollSpeed;

    if (wrapper.scrollLeft >= container.scrollWidth / 2) {
      wrapper.scrollLeft = 0; 
    }

    requestAnimationFrame(autoScroll);
  }

  autoScroll();
});