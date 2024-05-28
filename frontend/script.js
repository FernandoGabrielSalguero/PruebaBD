document.addEventListener('DOMContentLoaded', function() {


    document.getElementById("form").addEventListener("submit", function(event) {
        event.preventDefault();
        let nombre = document.getElementById("nombreInput").value;
    
        fetch('backend.php', {
            method: 'POST',
            body: JSON.stringify({ nombre: nombre }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Actualizar la lista de nombres
        })
        .catch(error => console.error('Error:', error));
    });

    function eliminarNombre(id) {
        fetch(`backend.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Actualizar la lista de nombres
        })
        .catch(error => console.error('Error:', error));
    }

});
