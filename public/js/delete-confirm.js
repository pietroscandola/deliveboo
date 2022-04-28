const deleteForms = document.querySelectorAll('.delete_form')
deleteForms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const accept = confirm('Sei sicuro di eliminare questo prodotto?')
        if (accept) e.target.submit();
    })
});