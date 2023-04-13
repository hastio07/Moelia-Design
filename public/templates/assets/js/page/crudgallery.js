const deleteModal = document.getElementById('DeleteModal');
deleteModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    const route = button.getAttribute('data-bs-route');
    deleteModal.querySelector('.modal-content .modal-footer > form').setAttribute('action', route);
});
