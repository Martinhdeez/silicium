document.getElementById('NoteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('../api/notes.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: formData.get('id'),
            title: formData.get('title'),
            note: formData.get('note')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.error);
        } else {
            alert('Note updated successfully!');
            location.reload(); // Recarga la página para mostrar los cambios
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});