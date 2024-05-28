document.getElementById('createForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;

    fetch('crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `create=1&nombre=${nombre}&email=${email}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        leerUsuarios();
    });
});

function leerUsuarios() {
    fetch('crud.php?read=1')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('usuariosTable').querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach(usuario => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${usuario.id}</td>
                <td>${usuario.nombre}</td>
                <td>${usuario.email}</td>
                <td>
                    <button onclick="eliminarUsuario(${usuario.id})">Eliminar</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    });
}

function eliminarUsuario(id) {
    fetch('crud.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `delete=1&id=${id}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        leerUsuarios();
    });
}
