document.addEventListener("DOMContentLoaded", () => {
    fetch('scripts/HomeAdmin.php')
        .then(response => response.json())
        .then(data => {
            if (data.nome) {
                document.getElementById('nome-admin').textContent = data.nome;
                document.getElementById('nome-admin-title').textContent = data.nome;
            } else {
                document.getElementById('nome-admin').textContent = 'Administrador';
                document.getElementById('nome-admin-title').textContent = 'Administrador';
            }
        })
        .catch(() => {
            document.getElementById('nome-admin').textContent = 'Administrador';
            document.getElementById('nome-admin-title').textContent = 'Administrador';
});
