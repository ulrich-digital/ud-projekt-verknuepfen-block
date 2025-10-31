document.addEventListener('DOMContentLoaded', () => {
  if (!document.body.classList.contains('single-post')) return;

  document.querySelectorAll('.ud-projekt-verknuepfen').forEach((block) => {
    if (block.dataset.moveToHead !== "1") return; // nur wenn erlaubt

    const link = block.querySelector('.projekt_link_in_content');
    if (link) {
      const wrapper = document.querySelector('.link_zum_projekt_im_head');
      if (wrapper) {
        const clone = link.cloneNode(true);
        clone.classList.add('ud-pv-cloned');
        wrapper.appendChild(clone);
      }
    }
  });
});
