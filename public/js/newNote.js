  // Función para manejar el clic en el botón
  document.getElementById('createNoteBtn').addEventListener('click', function() {
    // Datos de la nueva nota
    const data = {
        title: 'Untitled',
        note: ''
    };

    // Realizar la solicitud POST para crear la nota
    fetch('http://localhost/silicium/api/notes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        location.reload();
        
    })
});