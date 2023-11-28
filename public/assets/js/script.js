document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.ajax-form');
    const ajaxMessages = document.getElementById('ajax-messages');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const opinion = formData.get('opinion'); 
        const note = formData.get('note'); 

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Utilisez les valeurs récupérées ici
            console.log('opinion:', opinion);
            console.log('note:', note);
            document.getElementById('ajax-messages').innerHTML = data.message;
        })
        .catch(error => {
            console.error('Erreur lors de la soumission du formulaire:', error);
            // Gérer les erreurs ici
        });
    });
});
